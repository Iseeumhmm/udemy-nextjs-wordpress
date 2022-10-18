<?php

/* Template Name: Example Template */

namespace Atlantic\Themes\_NAMESPACE_;

use Timber\Timber;

// Load the context
$context = Timber::get_context();

$context['content_section'] = [
    "title" => 'Some hardcoded section',
    "content" => 'Pepper jack smelly cheese cheddar. Cream cheese cauliflower cheese fondue mozzarella melted cheese cauliflower cheese monterey jack roquefort. Cheese slices cottage cheese gouda blue castello croque monsieur smelly cheese cheesy grin mascarpone. Danish fontina brie halloumi.'
];

// Retrieving one gabling_ads to display
$gabling_ads = get_posts([
    'numberposts' => 1,
    'post_type'   => 'gabling_ads']);

$context['cta_section'] = [
    "title" => 'Some CTA Table',
    "content" => 'Pepper jack smelly cheese cheddar. Cream cheese cauliflower cheese fondue mozzarella melted cheese cauliflower cheese monterey jack roquefort. Cheese slices cottage cheese gouda blue castello croque monsieur smelly cheese cheesy grin mascarpone. Danish fontina brie halloumi.',
    "cta_shortcode" => '[get_cta id="' . ($gabling_ads && $gabling_ads[0] ? $gabling_ads[0]->ID : 0) . '"]'
];

// Render the appropriate template
Timber::render(array("Templates/TemplateExample/TemplateExample.twig"), $context, TEMPLATE_CACHE_DURATION, TEMPLATE_CACHE_MODE);
