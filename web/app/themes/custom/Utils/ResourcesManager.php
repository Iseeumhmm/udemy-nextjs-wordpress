<?php

namespace Atlantic\Themes\_NAMESPACE_\Utils;

/**
 * This class is used to manipulate and load a manifest.json file
 */
class ResourcesManager
{
    /**
     * 
     * @static 
     * @var array<string, string> Array containing in key the name of the file with its extension and as value the folder of the file with the name of the file and the extension.
     * @exemple 
     * [
     *   "Archive.css": "css/Archive.d933d6626d83431f35b33a84069898a6.css",
     * ]
     */
    protected static $manifestData = null;

    /**
     * Allows to retrieve the manifest.json in an array and to store it in the static variable of the class
     * 
     * @return void
     */
    public static function initManifestData()
    {
        if (null === self::$manifestData) {
            self::$manifestData = (array)json_decode(file_get_contents(PUBLIC_PATH . '/manifest.json'));
        }
    }
    
    /**
     * Retrieve the relative path of the file in the manifest using the file name with extension as value 
     * 
     * @param string name of the file with the extension used as a key in the manifest
     * 
     * @return string relative path of the file
     */
    public static function getFilePathByManifest($fileName)
    {
        self::initManifestData();

        if (!isset(self::$manifestData[$fileName])) {
            return $fileName;
        }

        return  PUBLIC_PATH . self::$manifestData[$fileName];
    }
    
    /**
     * Retrieve the relative url of the file in the manifest using the file name with extension as value 
     * 
     * @param string name of the file with the extension used as a key in the manifest
     * 
     * @return string relative url of the file
     */
    public static function getFileUrlByManifest($fileName)
    {
        self::initManifestData();

        if (!isset(self::$manifestData[$fileName])) {
            return $fileName;
        }
        
        return PUBLIC_URL . "/" . self::$manifestData[$fileName];
    }
}
