<?php

namespace Atlantic\Themes\_NAMESPACE_;

use Timber\Timber;

// Load the context
$context = Timber::get_context();

// Breadcrumbs
$context["breadcrumbs_items"] = array(
    array('text' => 'Home', 'link' => '/'),
    array('text' => 'Reviews', 'link' => '/reviews'),
    array('text' => $post->post_title, 'current' => true )
);

// Render the appropriate template
Timber::render(array("Templates/SingleReview/SingleReview.twig"), $context, TEMPLATE_CACHE_DURATION, TEMPLATE_CACHE_MODE);
