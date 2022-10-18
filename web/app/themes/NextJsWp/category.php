<?php

/**
 * The category template
 */

namespace Atlantic\Themes\NextJsWp;

use Timber\Timber;
use Atlantic\Themes\NextJsWp\Components\LoadMorePagination\LoadMorePagination;

global $wp_query;

// Load the context
$context = Timber::get_context();

// Retrieve page title for category archive.
$context["title"] = single_cat_title("Category: ", false);

// LoadMorePagination
if (isset($context['pagination_is_load_more']) && $context['pagination_is_load_more']) {
    LoadMorePagination::doLoadMorePagination($context);
}

// Render the appropriate template
Timber::render(array("Templates/Category/Category.twig"), $context, TEMPLATE_CACHE_DURATION, TEMPLATE_CACHE_MODE);
