<?php

/**
 * The blog template
 */

namespace Atlantic\Themes\NextJsWp;

use Timber\Timber;
use Atlantic\Themes\NextJsWp\Components\LoadMorePagination\LoadMorePagination;

global $wp_query;

// Load the context
$context = Timber::get_context();

// The title of the page
$context['title'] = sprintf(
    __('Search Results for &#8220;%s&#8221;'),
    get_search_query()
);

// LoadMorePagination
if (isset($context['pagination_is_load_more']) && $context['pagination_is_load_more']) {
    LoadMorePagination::doLoadMorePagination($context);
}

// Render the appropriate template
Timber::render(array("Templates/Search/Search.twig"), $context, TEMPLATE_CACHE_DURATION, TEMPLATE_CACHE_MODE);
