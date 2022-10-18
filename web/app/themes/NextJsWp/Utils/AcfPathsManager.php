<?php

namespace Atlantic\Themes\NextJsWp\Utils;

/**
 * This class is the site's entry point
 */
class AcfPathsManager
{
    public $currentGroupBeingSaved = "";

    /**
     * Constructor
     */
    public function __construct()
    {

        // Tells ACF to look into any folder under Components and Templates for its json files
        add_filter('acf/settings/load_json', array($this, 'acfPaths'));

        // this action is called by ACF before saving a field group
        // the priority is set to 1 so that it runs before the internal ACF action
        add_action('acf/update_field_group', array($this, 'updateFieldGroup'), 1, 1);
    }

    /**
     * Tells ACF to look into any folder under Components and Templates for its json files
     *
     * @param [array] $paths
     * @return array The modified array of paths
     */
    public function acfPaths($paths)
    {
        // remove original path (optional)
        // unset($paths[0]);

        $themePath = get_stylesheet_directory();

        $blocksPaths = array_filter(glob($themePath . '/Blocks/*'), 'is_dir');
        $componentsPaths = array_filter(glob($themePath . '/Components/*'), 'is_dir');
        $templatesPaths = array_filter(glob($themePath . '/Templates/*'), 'is_dir');

        if (!is_array($paths)) {
            $paths = array($paths);
        }

        $paths[] = $themePath . '/AcfFieldGroups';

        // return
        return array_merge($paths, $blocksPaths, $componentsPaths, $templatesPaths);
    }


    /**
     * Stores the group name being saved
     *
     * @param [object] $group The group being saved
     * @return object The group being saved
     */
    public function updateFieldGroup($group)
    {
        // store the group key and add action
        $this->currentGroupBeingSaved = $group['key'] . ".json";
        add_action('acf/settings/save_json', array($this, 'alterJsonLocation'), 9999);

        return $group;
    }

    /**
     * Sets the path where ACF saves the JSON file according
     * to files already existing under Templates/ and Components/
     *
     * Looks under Templates/ and Components/ in search for the JSON file of the group being saved
     * If it finds it then it will save the group there, otherwise it uses the [theme]/AcfFieldGroups/ location
     *
     * @param [string] $path The location where to save
     * @return string The altered path to the location where to save
     */
    public function alterJsonLocation($path)
    {
        $themePath = get_stylesheet_directory();

        $filesPaths = glob($themePath . '/{Templates,Components,Blocks}/*/*.json', GLOB_BRACE);

        foreach ($filesPaths as $filePath) {
            $fileName = basename($filePath);
            if ($fileName == $this->currentGroupBeingSaved) {
                return dirname($filePath);
            }
        }

        // Default
        return $themePath . '/AcfFieldGroups';
    }
}
