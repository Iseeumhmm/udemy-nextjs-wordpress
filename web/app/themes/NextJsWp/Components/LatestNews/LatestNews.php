<?php

namespace Atlantic\Themes\NextJsWp\Components\LatestNews;

use Timber\Timber;

class LatestNews
{
    public static function getPosts($args = [])
    {
        global $post;

        $defaults = array(
            'posts_per_page' => 3,
            'post__not_in' => array( $post->ID )
        );

        $args = wp_parse_args($args, $defaults);

        return Timber::get_posts($args);
    }
}
