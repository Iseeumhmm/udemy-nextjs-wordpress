<?php

/**
 * This is the Wordpress entry point
 */

namespace Atlantic\Themes\NextJsWp;

use Timber\Timber;
use Atlantic\Themes\NextJsWp\Utils\Site;

// Some useful constants, use them instead of calling the functions again
define('PUBLIC_PATH', get_template_directory() . '/public/');
define('PUBLIC_URL', WP_HOME . '/app/public');

// Template cache
// If development environment then no caching is performed
define('TEMPLATE_CACHE_DURATION', WP_ENV === 'development' ? 0 : 600);
define('TEMPLATE_CACHE_MODE', WP_ENV === 'development' ? \Timber\Loader::CACHE_NONE : \Timber\Loader::CACHE_OBJECT);

// Init Timber
new Timber();

// Init the site
new Site();
