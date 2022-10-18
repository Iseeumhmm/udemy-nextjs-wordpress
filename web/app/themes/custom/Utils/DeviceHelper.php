<?php

namespace Atlantic\Themes\_NAMESPACE_\Utils;

/**
 * A class to help with the type of device
 *
 * NOTE: CloudFront must be configured with the viewers
 */
class DeviceHelper
{
    /**
     * Is the user on mobile?
     */
    public static function isMobile()
    {
        $is_mobile = function_exists('wp_is_mobile') && wp_is_mobile();

        // returns true if the CloudFront assumes the browser is  smartphone
        if (isset($_SERVER['HTTP_CLOUDFRONT_IS_MOBILE_VIEWER']) && "true" === $_SERVER['HTTP_CLOUDFRONT_IS_MOBILE_VIEWER']) {
            $is_mobile = true;
        }

        // returns true if the CloudFront assumes the browser is a tablet.
        // remove the following three lines to assume table as PC.
        if (isset($_SERVER['HTTP_CLOUDFRONT_IS_TABLET_VIEWER']) && "true" === $_SERVER['HTTP_CLOUDFRONT_IS_TABLET_VIEWER']) {
            $is_mobile = true;
        }

        return $is_mobile;
    }

    /**
     * Is the user on tablet?
     */
    public static function isTablet()
    {
        if (
            isset($_SERVER['HTTP_CLOUDFRONT_IS_TABLET_VIEWER']) && "true" === $_SERVER['HTTP_CLOUDFRONT_IS_TABLET_VIEWER']
            || !empty($_SERVER['HTTP_USER_AGENT']) && (preg_match('/(ipad|tablet|xoom|playbook|kindle)/i', $_SERVER['HTTP_USER_AGENT']) == 1 || (strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') === false))
        ) {
                return true;
        }

        return false;
    }
}
