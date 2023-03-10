<?php

namespace Atlantic\Themes\NextJsWp\Utils;

use Timber;
use Atlantic\Themes\NextJsWp\Utils\ThemeBase;
use Atlantic\Themes\NextJsWp\Utils\Embeds;
use Atlantic\Themes\NextJsWp\Utils\ResourcesOptimizer;
use Atlantic\Themes\NextJsWp\Utils\SEO;
use Atlantic\Themes\NextJsWp\Utils\EnqueueManager;
use Atlantic\Themes\NextJsWp\Utils\PostTypes\ReviewPostType;
use Atlantic\Themes\NextJsWp\Utils\AcfPathsManager;
use Atlantic\Themes\NextJsWp\Utils\Admin\Admin;
use Atlantic\Themes\NextJsWp\Utils\Commands\WpCliCommandsRegister;

/**
 * This class is the site's entry point
 */
class Site extends Timber\Site
{

    /**
     * Constructor
     */
    public function __construct()
    {
        /**
         * Allow WordPress to detect HTTPS when used behind a reverse proxy or a load balancer
         * See https://codex.wordpress.org/Function_Reference/is_ssl#Notes
         */
        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
            $_SERVER['HTTPS'] = 'on';
        }

        // Registering twig namespaces
        // Namespaces in Twig are like Aliases in JS
        add_filter('timber/loader/loader', array($this, 'twigAliases'));


        // Theme basics
        new ThemeBase();

        // SEO things
        new SEO();

        // Embeds
        new Embeds();

        // Resources Optimizer
        new ResourcesOptimizer();

        // Resources Optimizer
        new EnqueueManager();

        // Post types
        new ReviewPostType();

        // Handles ACF read/write paths
        new AcfPathsManager();

        // Adds all necessary functionality in the admin only
        new Admin();

        // Register all commands wp-cli if the mode is development
        new WpCliCommandsRegister();

        // Calling Timber\Site's constructor
        parent::__construct();
    }

    /**
     * Registering twig namespaces
     * Namespaces in Twig are like Aliases in JS
     *
     * @param [object] $loader
     * @return object The Twig loader
     */
    public function twigAliases($loader)
    {
        $loader->addPath(get_stylesheet_directory() . "/Components", "Components");
        $loader->addPath(get_stylesheet_directory() . "/Templates", "Templates");
        $loader->addPath(get_stylesheet_directory() . "/Blocks", "Blocks");
        return $loader;
    }
}
