<?php

namespace Atlantic\Themes\_NAMESPACE_\Utils;

/**
 * Handle anything related to embeds
 */
class Embeds
{
    public function __construct()
    {
        add_filter('embed_thumbnail_image_size', array($this, 'customEmbedImageSize'), 10, 2);
    }

    // Fixing the oEmbed image size to 'medium'
    public function customEmbedImageSize($image_size, $thumbnail_id)
    {
        $image_size = 'medium';

        return $image_size;
    }
}
