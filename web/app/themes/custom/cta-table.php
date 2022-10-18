<?php

/**
 * This file has to be at the root of the theme for the Gambling Ads plugin to detect it.
 * This file is called when the shortcode of the table is used.
 *
 * The [get_cta id="123] shortcode is calling this file from the plugin or from the theme if it exists,
 * and loads the CtaMaker class before so we can use it here.
 *
 * (Note: There is another shortcode, [gambling_ads id="123], which outputs a hardcoded html that we
 * cannot customize from the theme, so don't try to use that one).
 *
 * So this file should act as the controller for the table, this is the place to pull extra data
 * from the database or alter the data provided by the get_cta_data() method,
 * and then render the appropriate Twig file.
 *
 * There should not be any HTML/Twig directly in here.
 *
 * This file should return the rendered HTML.
 */

use Atlantic\Themes\_NAMESPACE_\Utils\ResourcesManager;

// Instanciate the GamblingAds plugin's CtaMaker class that fetch and format
// the data for the CTA Table being called in the shortcode
$cta = new CtaMaker($args);
$cta_data = $cta->get_cta_data();

// Print a link to the CTA styles
echo '<link rel="stylesheet" id="GamblingTableSection-style-css" href="' . ResourcesManager::getFileUrlByManifest("GamblingTableSection.css") . '?ver=' . filemtime(ResourcesManager::getFilePathByManifest("GamblingTableSection.css")) . '" type="text/css" media="all">';

// Render the GamblingTable component
$output = Timber::compile_string(
    "
    {% from '@Components/GamblingTable/GamblingTable.twig' import GamblingTable %}
    {{ 
        GamblingTable(ctaData)
    }}
    ",
    ['ctaData' => $cta_data]
);
echo $output;
