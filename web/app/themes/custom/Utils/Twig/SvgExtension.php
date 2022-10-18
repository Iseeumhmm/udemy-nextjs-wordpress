<?php

namespace Atlantic\Themes\_NAMESPACE_\Utils\Twig;

use Twig\TwigFunction;

/**
 * A Twig extension to help with SVG
 *
 * @package Atlantic\Themes\_NAMESPACE_
 */
class SvgExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     * This function must return the name of the extension. It must be unique.
     */
    public function getName()
    {
        return 'svg';
    }

    /**
     * {@inheritdoc}
     * In this function we can declare the extension function
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('inlineSvg', [$this, 'inlineSvgFunction'], ['needs_environment' => true]),
        ];
    }

    public function inlineSvgFunction(Environment $env, $svg_filename)
    {
        return $this->inlineSvg($svg_filename);
    }

    public function inlineSvg($svg_filename)
    {
        $svg = null;

        if ($svg_filename) {
            $svg_url = strpos($svg_filename, '/uploads/') ? $svg_filename : realpath($_SERVER["DOCUMENT_ROOT"]) . '/app/public/images/' . $svg_filename . '.svg';

            if (file_exists($svg_url)) {
                $svg = file_get_contents($svg_url);
            }
        }
        return $svg;
    }
}
