<?php

/**
 * The archive template
 */

namespace Atlantic\Themes\NextJsWp;

use Timber\Timber;
use Atlantic\Themes\NextJsWp\Components\LoadMorePagination\LoadMorePagination;

global $wp_query;

// Loading the context
$context = Timber::get_context();

// Retrieve the archive title based on the queried object.
$context["title"] = get_the_archive_title();

// Pagination
if (isset($context['pagination_is_load_more']) && $context['pagination_is_load_more']) {
    LoadMorePagination::doLoadMorePagination($context);
}

// Render the appropriate template
Timber::render(array("Templates/Archive/Archive.twig"), $context, TEMPLATE_CACHE_DURATION, TEMPLATE_CACHE_MODE);
