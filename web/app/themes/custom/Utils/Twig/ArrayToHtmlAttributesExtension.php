<?php

namespace Atlantic\Themes\_NAMESPACE_\Utils\Twig;

use Timber\Twig_Filter;
use Twig\TwigFunction;
use Twig\Environment;

/**
 * Twig extension to provide a function to convert arrays to HTML attributes
 *
 * @package Atlantic\Themes\_NAMESPACE_
 */
class ArrayToHtmlAttributesExtension extends \Twig_Extension
{

    /**
     * {@inheritdoc}
     * This function must return the name of the extension. It must be unique.
     */
    public function getName()
    {
        return 'array_to_html_attributes';
    }

    /**
     * {@inheritdoc}
     * In this function we can declare the extension function
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('arrayToAttributesHTML', [$this, 'arrayToAttributesHTMLFunction'], ['needs_environment' => true]),
        ];
    }

    /**
     * {@inheritdoc}
     * In this function we can declare the extension filters
     */
    public function getFilters()
    {
        return [
            new Twig_Filter('arrayToAttributesHTML', [$this, 'arrayToAttributesHTMLFilter']),
        ];
    }

    public function arrayToAttributesHTMLFilter($attributes, $extra_attributes = [])
    {
        return $this->arrayToAttributesHTML($attributes, $extra_attributes);
    }

    public function arrayToAttributesHTMLFunction(Environment $env, $attributes, $extra_attributes = [])
    {
        return $this->arrayToAttributesHTML($attributes, $extra_attributes);
    }

    /**
     * Allows to transform an array into a string for HTML attributes
     *
     * @param {Array} $array Table containing the name of the attribute and its value
     *      if the array is a multi-dimensional array,
     *      we transform it into a one-dimensional array.
     *
     * @exemple multi-dimensional Array:
     *     From : [
     *         [0] => [
     *             'name' => id,
     *             'value' => theID,
     *         ],
     *         [1] => [
     *             'name' => class,
     *             'value' => the-class,
     *         ],
     *          etc...
     *     ]
     *
     *     To : [
     *          'id' => theID,
     *          'class' => the-class,
     *          etc...
     *     ]
     *
     * @exemple simple Array:
     *     From : [
     *         ['id'] => theID,
     *         ['class'] => the-class,
     *          etc...
     *     ]
     *
     *     To : [
     *          'id' => theID,
     *          'class' => the-class,
     *          etc...
     *     ]
     * @param {Array} $extra_attributes Allows you to add a new attribute or marge the value to an existing attribute.
     *
     * @return {String} HTML attribute spaced by a space
     *      @exemple :
     *          id="theId" class="the-class"
     */
    public function arrayToAttributesHTML($attributes, $extra_attributes = [])
    {
        if (!is_array($attributes)) {
            return '';
        }

        if (empty($attributes) && empty($extra_attributes)) {
            return '';
        }

        $isMulti = !empty(array_filter($attributes, function ($e) {
            return is_array($e);
        }));
        /**
         * Convert multidimentionnal array to simple array
         */
        if ($isMulti) {
            foreach ($attributes as $key => $values) {
                if (isset($values['name'])) {
                    $attributes[$values['name']] = $values['value'];
                    unset($attributes[$key]);
                }
            }
        }
        /**
         * Add or merged attribute
         */
        if (!empty($extra_attributes)) {
            foreach ($extra_attributes as $attribute_name => $attribute_value) {
                if ($attribute_name == "class") {
                    if (!isset($attributes['class'])) {
                        $attributes['class'] = '';
                    }
                    $attribute_value = (is_array($attribute_value)) ? implode(' ', $attribute_value) : $attribute_value;
                    $attribute_value = $attributes[$attribute_name] . ' ' . $attribute_value;
                }

                $attributes[$attribute_name] = $attribute_value;
            }
        }

        /**
         * Convert array to string html
         */
        $attribute_string = '';
        foreach ($attributes as $key => $value) {
            if (empty($value) || null === $value) {
                continue;
            }

            $value = (is_array($value)) ? implode(' ', $value) : $value;
            $attribute_string .= $key . '="' . htmlspecialchars($value) . '" ';
        }

        return $attribute_string;
    }
}
