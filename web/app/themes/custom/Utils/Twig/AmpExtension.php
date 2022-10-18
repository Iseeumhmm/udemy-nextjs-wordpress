<?php

namespace Atlantic\Themes\_NAMESPACE_\Utils\Twig;

use Twig\TwigFunction;
use Twig\Environment;
use Twig\Extension\GlobalsInterface;

/**
 * Twig Extension to provide AMP functions
 *
 * @package Atlantic\Themes\_NAMESPACE_
 */
class AmpExtension extends \Twig_Extension implements GlobalsInterface
{

    /**
     * {@inheritdoc}
     * This function must return the name of the extension. It must be unique.
     */
    public function getName()
    {
        return 'resulta_amp_extension';
    }

    /**
     * {@inheritdoc}
     * In this function we can declare the extension function
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('isAmpEndpoint', [$this, 'isAmpEndpoint'], ['needs_environment' => true]),
        ];
    }

    public function isAmpEndpointFunction(Environment $env)
    {
        return $this->isAmpEndpoint();
    }

    /**
     * @see https://amp-wp.org/reference/function/is_amp_endpoint/
     *
     * Determine whether the current response being served as AMP.
     *
     * This function cannot be called before the parse_query action because it needs to be able to determine the queried
     * object is able to be served as AMP. If 'amp' theme support is not present, this function returns true just if the
     * query var is present. If theme support is present, then it returns true in transitional mode if an AMP template is
     * available and the query var is present, or else in standard mode if just the template is available.
     *
     * @return (bool) Whether it is the AMP endpoint.
     */
    public function isAmpEndpoint()
    {
        return function_exists('is_amp_endpoint') ? is_amp_endpoint() : false;
    }

    /**
     * @deprecated since 1.23 (to be removed in 2.0), implement \Twig_Extension_GlobalsInterface instead
     *
     * Allows to store the value in the global variables of the views to avoid calling the function in all components (for performance)
     **/
    public function getGlobals()
    {
        return [
            'isAmpEndpoint' => $this->isAmpEndpoint(),
        ];
    }
}
