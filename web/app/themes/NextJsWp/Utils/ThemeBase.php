<?php

namespace Atlantic\Themes\NextJsWp\Utils;

use Atlantic\Themes\NextJsWp\Utils\Twig\SvgExtension;
use Atlantic\Themes\NextJsWp\Utils\Twig\AmpExtension;
use Atlantic\Themes\NextJsWp\Utils\Twig\ArrayToHtmlAttributesExtension;
use Atlantic\Themes\NextJsWp\Utils\Twig\StarRatingExtension;
use Timber\Post as TimberPost;

/**
 * Theme Basics
 */
class ThemeBase
{
    public function __construct()
    {
        // Theme support options
        add_action('after_setup_theme', array( $this, 'themeSupport' ));

        // Adding to Twig's context
        add_filter('timber/context', array( $this, 'addToContext' ));

        // Adding Twig extensions
        add_filter('timber/twig', array($this, 'addToTwig'));

        // TODO: UNCOMMENT THIS IF NEEDED
        // Adding extra size to the defaults
        // add_image_size( 'fullhd', 1920, 1080 );

        //Remove the REST API endpoint.
        remove_action('rest_api_init', 'wp_oembed_register_route');

        //Remove oEmbed discovery links.
        remove_action('wp_head', 'wp_oembed_add_discovery_links');

        // Wraps YouTube videos to better styling them
        add_filter('sanitize_content', array($this, 'wrapYoutube'), 90);
        add_filter('the_content', array($this, 'wrapYoutube'), 90);

        // Disable emoji support
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');

        // Only display custom fields menu option for Admin accounts
        // TODO: UNCOMMENT AS NEEDED
        // add_filter('acf/settings/show_admin', array($this, 'restrictCustomFields'));

        // Remove /play/ from quicklink pre-fetch
        // TODO: UNCOMMENT AS NEEDED
        // add_filter('quicklink_options', array($this, 'ignoreQuicklinks'));

        // Disable Jquery 👋
        add_action('wp_enqueue_scripts', array($this, 'disableJquery'));

        // Disable Gutenburg Block Editor
        add_action('wp_enqueue_scripts', array($this, 'removeBlockLibrary'));

        // Move head scripts to footer
        add_action('wp_enqueue_scripts', array($this, 'moveHeadScriptsToFooter'));

        // Add preconnect tag for third party scripts
        add_action('wp_head', array($this, 'thirdPartyPreconnect'));

        // TODO: UNCOMMENT THIS FOR MULTILINGUAL SITES
        // $this->multilingual();

        // add option page ACF
        $this->addACFOptions();
    }

    /**
     * Configure the theme support options
     *
     * @return void
     */
    public function themeSupport()
    {
        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        /**
         * Enable support for a stupid logo.
         *
         * @link https://developer.wordpress.org/themes/functionality/custom-logo/
         */
        $defaults = array(
            'height'      => 100,
            'width'       => 400,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => array('site-title', 'site-description'),
        );
        add_theme_support('custom-logo', $defaults);


        /**
         * Enable support for menus.
         * This creates 2 menu locations to set menus to.
         *
         * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
         */
        register_nav_menus(array(
            'primary_menu' => __('Primary Menu', 'text_domain'),
            'footer_menu'  => __('Footer Menu', 'text_domain'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');
    }

    /**
     * Add variables to the context for every page
     *
     * Available fields:
     * - post
     * - options
     * - fields
     * - mainMenu
     * - (footerMenu)
     * - logo
     *
     * @param  array $context The context
     * @return void
     */
    public function addToContext($context)
    {
        // Body Class
        $context['body_class'] = $this->bodyClass();

        /**
         * Current post
         */
        $context['post'] = new TimberPost();

        /**
         * Retrieve the general options and cache them for some time
         * TODO: COMMENT THIS IF YOU ARE NOT USING OPTIONS IN EVERY PAGES
         */
        $acfOptionsCacheKey = 'acf_options';
        $cache = wp_cache_get($acfOptionsCacheKey, 'custom');
        if (!$cache) {
            $cache = get_fields("options");
            wp_cache_set($acfOptionsCacheKey, $cache, 'custom', 600); // 10 mins
        }
        $context["options"] = $cache;

        /**
         * Retrieve the post's fields and cache them for some time
         */
        $post_id = (int) get_the_ID();
        $acfFieldsCacheKey = 'acf_fields_' . $post_id;
        $cache = wp_cache_get($acfFieldsCacheKey, 'custom');

        if (!$cache) {
            $cache = get_fields($post_id);
            wp_cache_set($acfFieldsCacheKey, $cache, 'custom', 300);
        }
        $context['fields'] = $cache;

        /**
         * Menus
         */
        // Primary menu
        $primaryMenuCacheKey = 'primary_menu';
        $cache = wp_cache_get($primaryMenuCacheKey, 'custom');
        if (!$cache) {
            $cache = new \Timber\Menu('primary_menu');
            wp_cache_set($primaryMenuCacheKey, $cache, 'custom', 300); // 5 mins
        }
        $context['primary_menu'] = $cache;

        // Footer menu
        // TODO: COMMENT THIS IF YOU ARE NOT USING A FOOTER MENU
        $footerMenuCacheKey = 'footer_menu';
        $cache = wp_cache_get($footerMenuCacheKey, 'custom');
        if (!$cache) {
            $cache = new \Timber\Menu('footer_menu');
            wp_cache_set($footerMenuCacheKey, $cache, 'custom', 300); // 5 mins
        }
        $context['footer_menu'] = $cache;

        // Set default pagination style to 'Load More'. 'False' will set to classical pagination.
        // This can also be set separately in the desired template
        // TODO: UNCOMMENT AS NEEDED
        // $context['pagination_is_load_more'] = true;

        // Adding the logo url to the context in every page
        if (has_custom_logo()) {
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            $alt = get_post_meta($custom_logo_id, '_wp_attachment_image_alt', true);
            $context['logo'] = esc_url($logo[0]);
            $context['logo_alt_text'] = $alt;
        }

        // DTI-751
        // TODO: Uncomment to use Yoast for breadcrumb handling
        // Use Yoast for breadcrumbs
        // if (function_exists('yoast_breadcrumb') && ! is_front_page()) {
        //     $context['yoast_breadcrumbs'] = yoast_breadcrumb('<p id="breadcrumbs">', '</p>', false);
        // }

        return $context;
    }

    /**
     * Only display custom fields menu option for Admin accounts
     *
     * @param [boolean] $show Should the option page be visible
     * @return boolean Should the option page be visible
     */
    public function restrictCustomFields($show)
    {
        return current_user_can('manage_options');
    }

    /**
     * Remove /play/ from quicklink pre-fetch
     *
     * @param [array] $options The options to modify
     * @return array The modified options
     */
    public function ignoreQuicklinks($options)
    {
        $options['ignores'][] = '\/play/';
        return $options;
    }

    /**
     * Replace all YouTube iFrames in content with class for lazy loading
     * and a data-src attribute containin the given url.
     * Will lazy load [embed][/embed]s, normal YouTube links, and fully added <iframe url="youtube.com"> embeds.
     *
     * @param [type] $content
     * @return string Updated content string, or just return.
     */
    public function wrapYoutube($content)
    {
        // Check content for multiple instances of hardcoded YouTube iframes
        $iframes = preg_match_all(
            '/<iframe[^>]*src\s*=\s*"?https?:\/\/[^\s"\/]*youtube.com(?:\/[^\s"]*)?"?[^>]*>.*?<\/iframe>/i',
            $content,
            $matches,
            PREG_OFFSET_CAPTURE
        );

        // Search if content has a YouTube iframe
        if (false !== $iframes) {
            // Loop starts with the last match. Since we're adding characters the original search
            // values will invalidate our preg match positions.
            $i = count($matches[0]) - 1;
            while ($i >= 0) {
                $match = $matches[0][$i] ;

                // Only proceed if iframe doesn't already have lazy loading
                if (false === strpos($match[0], "lazy")) {
                    $iframe_html = $match[0];
                    $content_iframe_pos = $match[1];

                    // Calculate src position
                    $src_pos = strpos($iframe_html, 'src');

                    // Replace src with lazy class and data-src attribute
                    $content_src_pos = $content_iframe_pos + $src_pos;
                    $content = substr_replace($content, 'class="lazy" data-src', $content_src_pos, 3);
                }
                $i--;
            }
            return $content;
        }

        return;
    }

    /**
     * Disable JQuery
     *
     * @return void
     */
    public function disableJquery()
    {
        if (is_user_logged_in()) {
            return;
        }
        wp_deregister_script('jquery');
        wp_deregister_script('jquery-core');
        wp_deregister_script('jquery-migrate');
    }

    /**
     * Disable Gutenburg CSS
     */
    public function removeBlockLibrary()
    {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
    }

    /**
     * Move JS from head to footer
     */
    public function moveHeadScriptsToFooter()
    {
        // TODO: CONFIRM WE NEED THIS?
        remove_action('wp_head', 'wp_print_scripts');
        remove_action('wp_head', 'wp_print_head_scripts', 9);
        remove_action('wp_head', 'wp_enqueue_scripts', 1);

        add_action('wp_footer', 'wp_print_scripts', 5);
        add_action('wp_footer', 'wp_enqueue_scripts', 5);
        add_action('wp_footer', 'wp_print_head_scripts', 5);
    }

    /**
     * Add preconnect tag for third party scripts
     */
    public function thirdPartyPreconnect()
    {
        // TODO: UNCOMMENT THESE AND ADD AS NEEDED
        // echo '<link rel="preconnect" href="https://www.google-analytics.com/">';
        // echo '<link rel="preconnect" href="https://www.googletagmanager.com/">';
        // echo '<link rel="preconnect" href="https://stats.g.doubleclick.net">';
    }

    /**
     * Extend Twig
     *
     * @param [type] $twig
     * @return void
     */
    public function addToTwig($twig)
    {
        // Gives a way to inline svg from a file
        $twig->addExtension(new SvgExtension());

        // Gives a way to convert an array to HTML attributes
        $twig->addExtension(new ArrayToHtmlAttributesExtension());

        // Gives a way to check for amp from Twig
        // TODO: UNCOMMENT THIS AS NEEDED
        // $twig->addExtension(new AmpExtension());


        // Gives a way to convert a rating out of 5 to a percentage
        $twig->addExtension(new StarRatingExtension());

        return $twig;
    }

    /**
     * Multilingual
     *
     * @return void
     */
    public function multilingual()
    {
        // Add x-default hreflang for SEO purposes
        add_filter('wpml_alternate_hreflang', array($this, 'addXdefaultHreflang'), 10, 2);
        add_filter('wpml_hreflangs', array($this, 'hrefsManipulatorCallback'));

        // Prevents WPML from enqueuing its lang selector css
        define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
    }

    /**
     * If The plugin acf is present and enabled, we add the Options page in admin
     *
     * @see https://www.advancedcustomfields.com/resources/acf_add_options_page/
     *
     * @return void
     */
    public function addACFOptions()
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page();
        }
    }

    /**
     * Function to replace body_class of WP to avoid having all classes added by wp unnecessarily.
     *
     * @return string $body_class All necessary classes
     */
    public function bodyClass()
    {
        $body_classes = [];

        if (is_admin_bar_showing()) {
            $body_classes[] = 'admin-bar';
        }

        return $body_classes;
    }
}
