<?php

namespace Atlantic\Themes\_NAMESPACE_\Utils;

/**
 * Handles anything SEO related
 */
class SEO
{

    /**
     * Constructor
     */
    public function __construct()
    {
        // Moves Yoast metabox to the bottom
        add_filter('wpseo_metabox_prio', array($this, 'yoastToBottom'));

        // Disabling WP sitemaps to let Yoast do it
        add_filter('wp_sitemaps_enabled', '__return_false');

        // TODO: UNCOMMENT THIS IF NEEDED
        // Remove Yoast Canonical from all Pages/Posts
        // add_filter('wpseo_canonical', '__return_false');
    }

    /**
     * Move Yoast to bottom
     *
     * @return string The priority
     */
    public function yoastToBottom()
    {
        return 'low';
    }
}
