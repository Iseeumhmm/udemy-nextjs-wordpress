<?php

namespace Atlantic\Themes\NextJsWp\Components\LoadMorePagination;

use Timber\Timber;
use Timber\PostQuery;

class LoadMorePagination
{
    /**
     * Render the posts loop with appropriate posts when the request
     * comes from ajax after a click on the load more button
     *
     * If $onLoadFirstPage is set to true then when loading a page from a pagination greater than 1,
     * it will render the page starting with the posts of page 1, and then call the next pages with ajax.
     *
     * If $onLoadFirstPage is set to false, then when loading a page from a pagination greater than 1,
     * it will render the page starting with the posts of that requested page.
     *
     * @param [array] $context The Twig context
     * @param [boolean] $onLoadFirstPage On load does it start from page 1. Default true.
     */
    public static function doLoadMorePagination(&$context, $onLoadFirstPage = true)
    {
        global $wp_query;

        // Retrieve the requested page number
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        if ($onLoadFirstPage) {
            $context['targeted_page'] = $paged;
            $context['current_page'] = 1;
        }

        // The POST loadMore param is set when we do an ajax call clicking on the Load More button
        // In this case we want to only render the posts loop macro, which will be the response to the JS call,
        // and will be appended to the HTML then
        if (isset($_POST["loadMore"])) {
            $context['current_page'] = $paged;
            echo Timber::compile_string(
                "
            {% from '@Components/PostsLoop/PostsLoop.twig' import PostsLoop %}
            {{
                PostsLoop({
                    posts: posts,
                    post_preview_length: post_preview_length,
                    pagination_is_load_more: pagination_is_load_more,
                    targeted_page: targeted_page,
                    current_page: current_page,
                    wrap_cards: false
                })
            }}
            ",
                $context
            );
            die();
        }

        if ($onLoadFirstPage) {
            $args = array_merge($wp_query->query_vars, array( 'paged' => '1'));
            $context['posts'] = new PostQuery($args);
        }
    }
}
