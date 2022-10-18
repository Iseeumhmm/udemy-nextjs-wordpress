<?php

/* Template Name: Styleguide */

namespace Atlantic\Themes\NextJsWp;

use Timber\Timber;
use Timber\Post as TimberPost;

// Load the context
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

// Breadcrumbs
$context["breadcrumbs_items"] = array(
    array('text' => 'Home', 'link' => '/'),
    array('text' => $post->post_title, 'current' => true )
);

// AuthorCard
$context["author_info"] = array(
    'name' => 'John Doe',
    'description' => 'Pepper jack smelly cheese cheddar. Cream cheese cauliflower cheese fondue mozzarella melted cheese cauliflower cheese monterey jack roquefort. Cheese slices cottage cheese gouda blue castello croque monsieur smelly cheese cheesy grin mascarpone. Danish fontina brie halloumi.',
    'picture' => null,
    'link' => '/'
);

// AuthorCard
$context["byline"] = [
    'post' => $post,
    "dateformat" => 'F d, Y',
    "features" =>  [
      "published" => false,
      "updated" => [
        "label" => 'Updated'
      ]
    ]
];

// Button
$context["button"] = array(
    'text' => 'CTA Button'
);

// Card
$context["card_content"] = array(
    'content' => 'This is a card'
);

// CTA Table
// Retrieving one gabling_ads to display
$gabling_ads = get_posts([
  'numberposts' => 1,
  'post_type'   => 'gabling_ads']);

$context["ctatable"] = array(
  'shortcode'  => '[get_cta id="' . ($gabling_ads && $gabling_ads[0] ? $gabling_ads[0]->ID : 0) . '"]'
);

// Icon
$context["icon_items"] = array(
    'icon' => 'arrow-up-primary'
);

// Link
$context["link_items"] = array(
    'href' => 'https://www.npmjs.com/package/isitfriday',
    'content' => 'Is it Friday?'
);

// News Card
$context['news_card_items'] = array(
    'title' => 'Hi',
    'link' => '/hi',
    'thumbnail' => null,
    'text' => 'Hi diddly ho neighborinos!',
    'author' => 'Flanders',
    'date' => null
);

// Pagination
$context['pagination_items'] = array(
    'pages' => [
        [
          'link' => '',
          'title' => '1',
          'current' => true
        ],
        [
          'link' => '/page-2',
          'title' => '2'
        ],
        [
          'link' => '/page-3',
          'title' => '3'
        ]
    ],
    'next' => [
      'link' => '/page-2'
    ]
);

// Picture
$context['picture_items'] = array(
    'sources' => [
        [
          'url' => 'https://www.fillmurray.com/200/300'
        ]
    ],
    'width' => null,
    'height' => null,
    'alt' => null
);

// Slider
$context['slider_items'] = array(
    'slides' => [
      [
        'content' => 'Would'
      ],
      [
        'content' => 'You'
      ],
      [
        'content' => 'Eat'
      ],
      [
        'content' => 'Cheese'
      ]
    ]
);

// Sticky Footer
$context['sticky_footer'] = array(
    'content' => 'This footer sticks'
);

// Sticky Footer
$context['text_input'] = array(
    'name' => 's',
    'placeholder' => 'Type something here'
);

// ContentSection
$context["content_section"] = array(
    'title' => 'Some hardcoded section',
    'content' => 'Pepper jack smelly cheese cheddar. Cream cheese cauliflower cheese fondue mozzarella melted cheese cauliflower cheese monterey jack roquefort. Cheese slices cottage cheese gouda blue castello croque monsieur smelly cheese cheesy grin mascarpone. Danish fontina brie halloumi.'
);

// GamblingTableSection
$context['cta_section'] = [
  "title" => 'Some CTA Table',
  "content" => 'Pepper jack smelly cheese cheddar. Cream cheese cauliflower cheese fondue mozzarella melted cheese cauliflower cheese monterey jack roquefort. Cheese slices cottage cheese gouda blue castello croque monsieur smelly cheese cheesy grin mascarpone. Danish fontina brie halloumi.',
  "cta_shortcode" => '[get_cta id="' . ($gabling_ads && $gabling_ads[0] ? $gabling_ads[0]->ID : 0) . '"]'
];

// Render the appropriate template
Timber::render(array("Templates/TemplateStyleguide/TemplateStyleguide.twig"), $context, TEMPLATE_CACHE_DURATION, TEMPLATE_CACHE_MODE);
