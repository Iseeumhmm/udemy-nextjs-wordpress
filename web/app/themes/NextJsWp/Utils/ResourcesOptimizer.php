<?php

namespace Atlantic\Themes\NextJsWp\Utils;

/**
 * Inspired by
 *      - https://github.com/alexmacarthur/wp-better-resource-hints
 *      - https://macarthur.me/posts/preloading-javascript-in-wordpress
 *
 */
class ResourcesOptimizer
{
    /**
     * @private
     *
     * @var Array Array containing all the hosts you want to set for preConnect
     *
     * @example : [ '//use.typekit.net' ]
     */
    private $_hostsToPreconnect = [
        // TODO: SET AS NEEDED
        // '//use.typekit.net'
    ];

    /**
     * @private
     *
     * @var Array Array containing all the hosts you want to set for dns-prefetch.
     *
     * @example : [ 'use.typekit.net' ]
     */
    private $_hostsToDnsPrefetch = [
        // TODO: SET AS NEEDED
        // 'use.typekit.net'
    ];

    /**
     * @private
     *
     * @var Array Multi Array containing all informations for preload
     *
     * Mainly used to include fonts that are in scss and not in wordpress.
     *
     * The second array contain :
     *      - string src The full url
     *      - string type The singular type
     *      - string|int The number version (optional)
     *
     * @example : [
     *      [
     *          'src'=> 'https://fonts.googleapis.com/css2?family=Merriweather&display=swap',
     *          'type'=> style,
     *      ],
     *      [
     *          'src'=> 'https://hotspawn.localdev.chalk.bet/app/public/css/Layout.css?ver=1611167784',
     *          'type'=> 'style',
     *          'ver'=> 1611167784,
     *      ],
     *      [
     *          'src'=> 'https://hotspawn.localdev.chalk.bet/app/public/js/Layout.js?ver=1611167784',
     *          'type'=> 'script',
     *          'ver'=> 1611167784,
     *      ],
     * ]
     */
    private $_fullUrlsToPreload = [
        // TODO: SET AS NEEDED
        // [
        //     'src' => "https://p.typekit.net/p.css?s=1&k=lpq7kfy&ht=tk&f=26034.26053.26060.26062.26063.28982.28986.28991.28992&a=6212911&app=typekit&e=css",
        //     'type' => "style",
        // ],
        // [
        //     'src' => "https://use.typekit.net/af/ac1071/00000000000000003b9acafe/27/l?primer=7cdcb44be4a7db8877ffa5c0007b8dd865b3bbc383831fe2ea177f62257a9191&fvd=n8&v=3",
        //     'type' => "font",
        // ],
        // ...
    ];

    public function __construct()
    {
        add_filter('wp_resource_hints', array($this, 'optimizeResourcesHints'), 11, 2);
        add_action('wp_head', array($this, 'generatePreload'), 1);
    }

    /**
     * Function to optimise resources
     *
     */
    public function optimizeResourcesHints($urls, $relation_type)
    {
        switch ($relation_type) {
            case 'preconnect':
                $this->preConnect($urls, $relation_type);
                break;
            case 'dns-prefetch':
                $this->dnsPrefetch($urls, $relation_type);
                break;
            case 'prefetch':
                // @todo : add functionnality here
                break;
            case 'prerender':
                // @todo : add functionnality here
                break;
            default:
                break;
        }

        return $urls;
    }

    /**
     *
     * Allows you to add the dns-prefetch tag and if the link is already saved by wordpress it will be deleted.
     *
     * @param Array $urls Array contain all urls registered in wordpress
     *
     * @return void
     */
    public function dnsPrefetch(&$urls)
    {
        if (!empty($this->_hostsToDnsPrefetch)) {
            foreach ($this->_hostsToDnsPrefetch as $url) {
                if (($key = array_search($url, $urls)) !== false) {
                    unset($urls[$key]);
                }

                return "<link rel='dns-prefetch' href='{$url}'/>\n";
            }
        }
    }

    /**
     * If enabled, generate a preconnect tag for each asset that's dns-prefetched.
     *
     * @param array $urls
     * @param string $type
     * @return array
     */
    public function preConnect(&$urls, $relation_type)
    {

        if (!empty($this->_hostsToPreconnect)) {
            foreach ($this->_hostsToPreconnect as $host) {
                $urls[] = $host;
            }
        }

        foreach ($urls as $url) {
            if (!is_string($url)) {
                continue;
            }

            if (($key = array_search($url, $urls)) !== false) {
                unset($urls[$key]);
            }

            $parsedURL = wp_parse_url($url);
            unset($parsedURL["scheme"]);

            $reconstructedURL = isset($parsedURL['host'])
            ? '//' . $parsedURL['host']
            : '//' . join("", $parsedURL);

            echo "<link rel='preconnect' href='{$reconstructedURL}'/>\n";
        }
    }

    /**
     *
     * this function browses all the scripts and styles recorded in wordpress
     * and then generates the preload link tag with the resource url and type.
     *
     * It also generates the llink tag of the custom url in the "$_fullUrlsToPreload"
     * property of this class.
     */
    public function generatePreload()
    {
        global $wp_scripts, $wp_styles;
        $handlesToPreload = [];

        $resources_types = [
            'styles',
            'scripts',
        ];

        // Generate preload for all script registered in wp
        foreach ($resources_types as $type) {
            $resources = ${'wp_' . $type};

            //-- Gather all enqueued scripts and dependencies.
            foreach ($resources->queue as $handle) {
                $handlesToPreload[] = $handle;
            }

            $unique_resources = array_unique($handlesToPreload);

            //-- Loop through and print preload tags.
            foreach ($unique_resources as $handle) {
                if (!isset($resources->registered[$handle])) {
                    continue;
                }

                $resource = $resources->registered[$handle];

                $url = wp_parse_url($resource->src);
                if (empty($resource->src) || (isset($url['host']) && $url['host'] == $_SERVER['HTTP_HOST'])) {
                    continue;
                }

                if (isset($resource->extra['group']) && $resource->extra['group'] === 1) {
                    echo $this->makePreloadLink($resource->src, substr_replace($type, "", -1), $resource->ver);
                }
            }
        }

        //-- Loop through and print custom preload tags.
        foreach ($this->_fullUrlsToPreload as $resource) {
            if (empty($resource['src']) || (empty($resource['type']) || ($resource['type'] != 'style' and $resource['type'] != 'script'))) {
                continue;
            }

            $version = (isset($resource['ver'])) ? $resource['ver'] : "";

            echo $this->makePreloadLink($resource['src'], $resource['type'], $version);
        }
    }

    /**
     *
     * Generates the preload tag with source and type
     *
     * @param String $source url of the resource
     * @param String $type type of the resource (style or script)
     * @param String $version version of the resource (optional)
     *
     * @return String Link Tag
     */
    private function makePreloadLink($source, $type, $version = "")
    {
        $source = $source . ($version ? "?ver={$version}" : "");

        return "<link rel='preload' href='{$source}' as='{$type}'/>\n";
    }
}
