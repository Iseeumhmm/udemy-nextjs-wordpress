<?php

/**
 * The 404 template
 */

namespace Atlantic\Themes\NextJsWp;

use Timber\Timber;

// Load the context
$context = Timber::get_context();

// Render the appropriate template
Timber::render(array("Templates/404/404.twig"), $context, TEMPLATE_CACHE_DURATION, TEMPLATE_CACHE_MODE);
