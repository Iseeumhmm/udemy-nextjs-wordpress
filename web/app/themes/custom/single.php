<?php

namespace Atlantic\Themes\_NAMESPACE_;

use Timber\Timber;
use Atlantic\Themes\_NAMESPACE_\Components\LatestNews\LatestNews;

// Load the context
$context = Timber::get_context();

// Breadcrumbs
$context["breadcrumbs_items"] = array(
    array('text' => 'Home', 'link' => '/')
);
$newsPage = get_option('page_for_posts');
if (! empty($newsPage)) {
    array_push($context["breadcrumbs_items"], array('text' => "News", 'link' => get_permalink($newsPage) ));
}
array_push($context["breadcrumbs_items"], array('text' => $post->post_title, 'current' => true ));

// Get the Latest News posts
$context["latest_news"] = LatestNews::getPosts();

// Render the appropriate template
Timber::render(array("Templates/Single/Single.twig"), $context, TEMPLATE_CACHE_DURATION, TEMPLATE_CACHE_MODE);
