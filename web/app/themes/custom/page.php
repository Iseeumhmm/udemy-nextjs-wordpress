<?php

/**
 * The page template
 */

namespace Atlantic\Themes\_NAMESPACE_;

use Timber\Timber;

// Load the context
$context = Timber::get_context();

// Render the appropriate template
Timber::render(array("Templates/Page/Page.twig"), $context, TEMPLATE_CACHE_DURATION, TEMPLATE_CACHE_MODE);
