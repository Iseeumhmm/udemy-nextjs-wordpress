<?php

namespace Atlantic\Themes\NextJsWp\Utils\Twig;

use Timber\Twig_Filter;

/**
 * A Twig extension to provide a filter to help with star rating
 *
 * @package Atlantic\Themes\NextJsWp
 */
class StarRatingExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     * This function must return the name of the extension. It must be unique.
     */
    public function getName()
    {
        return 'star_rating';
    }

    /**
     * {@inheritdoc}
     * In this function we can declare the extension filters
     */
    public function getFilters()
    {
        return [
            new Twig_Filter('formatStarRating', [$this, 'formatStarRating']),
        ];
    }

    /**
     * Format Star Rating
     *
     * @param [int] $rating The rating out of 5
     * @return string The rating as a percentage
     */
    public function formatStarRating($rating)
    {

        if (!empty($rating) && is_numeric($rating)) {
            $percentage = $rating / 5;
            $percentage = $percentage * 100;
            $rating = $percentage . '% ';
        }
        return $rating;
    }
}
