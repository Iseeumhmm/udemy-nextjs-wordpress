<?php

namespace Atlantic\Themes\NextJsWp\Utils;

use Atlantic\Themes\NextJsWp\Utils\ResourcesManager;

/**
 * Handles JS and CSS enqueue
 */
class EnqueueManager
{
    /**
     * Allows to store the site url
     *
     * @var string $site_url
     */
    private $site_url;

    public function __construct()
    {
        /**
         * This filter is called before rendering
         */
        if (!is_admin()) {
            add_filter('timber_render_file', array($this, 'autoEnqueueTemplate'));
            add_filter('timber_context', array($this, 'autoEnqueueBlocks'), 999);
            add_filter('timber_context', array($this, 'autoLoadBlocks'));
            // Layout above the fold
            add_filter('timber_context', array($this, 'enqueueLayoutCritical'), -1);
            add_filter('script_loader_tag', array($this, 'scriptLoaderTagFilter'), 10, 2);
        }
    }

    /**
     * Automatically enqueue js and css files named after the current twig template if possible
     *
     * @param  [type] $file
     * @return void
     */
    public function autoEnqueueTemplate($file)
    {
        $fileName = basename(str_replace(".twig", "", $file));
        $criticalFileName = $fileName . "Critical";

        // TODO: UNCOMMENT THIS IF YOU WANT TO DEFAULT TO PAGE.CSS and PAGE.JS
        // If the CSS file named like the template doesn't exist then try with Page
        // if (!file_exists(ResourcesManager::getFilePathByManifest("$fileName.css"))) {
        //     $fileName = "Page";
        // }
        // If the JS file named like the template doesn't exist then try with Page
        // if (!file_exists(ResourcesManager::getFilePathByManifest("$fileName.js"))) {
        //     $fileName = "Page";
        // }

        // General styles in header
        if (function_exists('is_amp_endpoint') && is_amp_endpoint()) {
            if (file_exists(ResourcesManager::getFilePathByManifest("LayoutAMP.css"))) {
                wp_enqueue_style("Layout-style", ResourcesManager::getFileUrlByManifest("LayoutAMP.css"), array(), false, 'all');
            }
        } else {
            // Layout beyond the fold
            add_filter(
                'wp_footer',
                function () {
                    wp_enqueue_style("Layout-style", ResourcesManager::getFileUrlByManifest("Layout.css"), array(), false, 'all');
                }
            );
        }

        // Enqueue any template-specific critical styles. The 5th parameter is 'in_footer', which will enqueue in the head when false
        if (file_exists(ResourcesManager::getFilePathByManifest("$criticalFileName.css"))) {
            wp_enqueue_style("$criticalFileName-style", ResourcesManager::getFileUrlByManifest("$criticalFileName.css"), array(), false, false);
        }

        // Enqueue any template-specific critical scripts. The 5th parameter is 'in_footer', which will enqueue in the head when false
        if (file_exists(ResourcesManager::getFilePathByManifest("$criticalFileName.js"))) {
            wp_enqueue_script("$criticalFileName-js", ResourcesManager::getFileUrlByManifest("$criticalFileName.js"), array(), false, false);
        }

        // Pages styles in footer
        if (file_exists(ResourcesManager::getFilePathByManifest("$fileName.css"))) {
            add_filter(
                'wp_footer',
                function () use ($fileName) {
                    wp_enqueue_style("$fileName-style", ResourcesManager::getFileUrlByManifest("$fileName.css"), array(), false, 'all');
                }
            );

            add_filter('style_loader_tag', array($this, 'styleLoaderTagFilter'), 10, 2);
        }

        // Scripts
        $isAmpFunc = function_exists('is_amp_endpoint');
        if (!$isAmpFunc || ($isAmpFunc && !is_amp_endpoint())) {
            // Runtime is the script that makes it possible for the templates to be aware of the Blocks
            // TODO: WILL DEPEND ON THE FOLDER STRUCTURE AND ON WHAT WE DECIDE TO BUILD
            if (file_exists(ResourcesManager::getFilePathByManifest("runtime.js"))) {
                wp_enqueue_script("runtime-js", ResourcesManager::getFileUrlByManifest("runtime.js"), array(), false, false);
            }

            // Layout JS will be placed in the footer.
            if (file_exists(ResourcesManager::getFilePathByManifest("Layout.js"))) {
                wp_enqueue_script("Layout-js", ResourcesManager::getFileUrlByManifest("Layout.js"), array(), false, true);
            }

            // The template's script
            if (file_exists(ResourcesManager::getFilePathByManifest("$fileName.js"))) {
                wp_enqueue_script("$fileName-js", ResourcesManager::getFileUrlByManifest("$fileName.js"), array(), false, true);
            }
        }

        return $file;
    }

    /**
    *  Allows you to put the LayoutCritical file first.
    *
    * @hook timber_context
    * @param array $context The global context
    *
    * @see \Timber\Timber::context()
    **/
    public function enqueueLayoutCritical($context)
    {
        wp_enqueue_style("LayoutCritical-style", ResourcesManager::getFileUrlByManifest("LayoutCritical.css"), array(), false, 'all');

        return $context;
    }

    /**
     * Automatically enqueue Blocks that are in the page_sections array
     * TODO: WILL DEPEND ON THE FOLDER STRUCTURE AND ON WHAT WE DECIDE TO BUILD
     * @param [array] $context
     * @return array The context unmodified
     */
    public function autoEnqueueBlocks($context)
    {
        global $post;

        if (isset($post) && isset($post->custom) && isset($post->custom['page_sections']) && is_array($post->custom['page_sections'])) {
            $sectionIndex = 0;
            $prioritySectionStyles = [];
            foreach ($post->custom['page_sections'] as $section) {
                if (file_exists(ResourcesManager::getFilePathByManifest("$section.css"))) {
                    if ($sectionIndex < 3) {
                        // Section is above the fold most likely, we load the css in the head
                        // Set the media to screen to avoid the auto replace that we implemented because we want this to be loaded from the begining to avoid CLS
                        wp_enqueue_style("$section-style", ResourcesManager::getFileUrlByManifest("$section.css"), array(), false, 'screen');

                        // This is to prevent having the same style enqueued in the head and footer
                        // this would happen in the same section is multiple times within the firsts section and after
                        $prioritySectionStyles[] = $section;
                    } elseif (!in_array($section, $prioritySectionStyles)) {
                        // Section is below the fold most likely, we load the css in the footer
                        add_filter(
                            'wp_footer',
                            function () use ($section) {
                                wp_enqueue_style("$section-style", ResourcesManager::getFileUrlByManifest("$section.css"), array(), false, 'all');
                            }
                        );
                    }
                }

                $isAmpFunc = function_exists('is_amp_endpoint');
                if (file_exists(ResourcesManager::getFilePathByManifest("$section.js")) && (!$isAmpFunc || ($isAmpFunc && !is_amp_endpoint()))) {
                        wp_enqueue_script("$section-js", ResourcesManager::getFileUrlByManifest("$section.js"), array(), false, true);
                }

                $sectionIndex++;
            }
        }

        return $context;
    }

    /**
     * Modify the html tag value for selected CSS files, in order to prevent render-blocking
     *
     * @param  string $tag    The html tag contents
     * @param  string $handle The handle (ex. Page-style) for the given file
     * @return string           Returns the modified $html tag value
     */
    public function styleLoaderTagFilter($tag, $handle)
    {
        if (function_exists('is_amp_endpoint') && !is_amp_endpoint() || !function_exists('is_amp_endpoint')) {
            if (
                !strpos($tag, 'Layout')
                && !strpos($tag, 'Critical')
                && !strpos($tag, 'GamblingTableSection')
                && !is_admin()
            ) {
                $tag = str_replace("media='all'", "media='print' onload=this.media='all'", $tag);
            }
        }

        return $tag;
    }

    /**
     * Modify the html tag value for selected JS files, in order to prevent render-blocking
     *
     * @param  string $tag    The html tag contents
     * @param  string $handle The handle (ex. Page-style) for the given file
     * @return string           Returns the modified $html tag value
     */
    public function scriptLoaderTagFilter($tag, $handle)
    {
        if (function_exists('is_amp_endpoint')) {
            if (!is_amp_endpoint()) {
                if (!strpos($handle, 'LayoutCritical') && !is_admin()) {
                    $tag = str_replace("data-handle", "defer data-handle", $tag);
                }
            }
        } else {
            if (!strpos($handle, 'LayoutCritical') && !is_admin()) {
                $tag = str_replace("data-handle", "defer data-handle", $tag);
            }
        }

        return $tag;
    }

    /**
     * Auto load a PHP file for an ACF group
     * Used for ACF sections.
     * The ACF layout name has to match the component name.
     *
     * @param [type] $context
     * @return void
     */
    public function autoLoadBlocks($context)
    {
        global $post;

        if (isset($post) && isset($post->custom) && isset($post->custom['page_sections']) && is_array($post->custom['page_sections'])) {
            foreach ($post->custom['page_sections'] as $index => $section) {
                $className = "Atlantic\Themes\NextJsWp\Blocks\\$section\\$section";

                // Checking if the class named after the section exists
                if (class_exists($className)) {
                    new $className($context, $index);
                }
            }
        }

        return $context;
    }
}
