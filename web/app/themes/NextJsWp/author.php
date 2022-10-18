<?php

/**
 * The author template
 */

namespace Atlantic\Themes\NextJsWp;

use Timber\Timber;
use Timber\User as TimberUser;
use Atlantic\Themes\NextJsWp\Components\LoadMorePagination\LoadMorePagination;

global $wp_query;

// Load the context
$context = Timber::get_context();

if (isset($wp_query->query_vars['author'])) {
    // Retrieve the Timber\User object corresponding to this author
    $author = new TimberUser($wp_query->query_vars['author']);
    $context['author'] = $author;
}

// Pagination
if (isset($context['pagination_is_load_more']) && $context['pagination_is_load_more']) {
    LoadMorePagination::doLoadMorePagination($context);
}

// Render the appropriate template
Timber::render(array("Templates/Author/Author.twig"), $context, TEMPLATE_CACHE_DURATION, TEMPLATE_CACHE_MODE);
