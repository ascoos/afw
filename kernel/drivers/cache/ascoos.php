<?php 
/**
 *   __ _  ___  ___ ___   ___   ___     ____ _ __ ___   ___
 *  / _` |/  / / __/ _ \ / _ \ /  /    / __/| '_ ` _ \ /  /
 * | (_| |\  \| (_| (_) | (_) |\  \   | (__ | | | | | |\  \
 *  \__,_|/__/ \___\___/ \___/ /__/    \___\|_| |_| |_|/__/
 * 
 * 
 ************************************************************************************
 * @ASCOOS-NAME        	: ASCOOS CMS 24'                                            *
 * @ASCOOS-VERSION     	: 24.0.0                                                    *
 * @ASCOOS-CATEGORY    	: Framework (Frontend and Administrator Side)               *
 * @ASCOOS-CREATOR     	: Drogidis Christos                                         *
 * @ASCOOS-SITE        	: www.ascoos.com                                            *
 * @ASCOOS-LICENSE     	: [Commercial] http://docs.ascoos.com/lics/ascoos/AGL.html  *
 * @ASCOOS-COPYRIGHT   	: Copyright (c) 2007 - 2024, AlexSoft Software.             *
 ************************************************************************************
 *
 * @package            	: ASCOOS FRAMEWORK 24'
 * @subpackage         	: Handles Ascoos Cache Files.
 * @source             	: afw/kernel/drivers/cache/ascoos.php
 * @fileNo             	: 
 * @version            	: 24.0.7
 * @created            	: 2024-07-01 20:00:00 UTC+3 
 * @updated            	: 2024-12-18 07:00:00 UTC+3 
 * @author             	: Drogidis Christos
 * @authorSite         	: www.alexsoft.gr
 * @license 			: AGL-F
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);
namespace ASCOOS\FRAMEWORK\Kernel\Cache\Ascoos;
defined ("ALEXSOFT_RUN_CMS") or die("Prohibition of Access.");
defined ("ASCOOS_FRAMEWORK_RUN") or die("Prohibition of Access.");

use ASCOOS\FRAMEWORK\Kernel\{
    Cache\TCacheHandler
};

global $cms_cache_path;

/******************************************************************************
 * @startcode TAscoosCacheHandler
 *****************************************************************************/
/**
 * @class   TAscoosCacheHandler
 * @extends TCacheHandler
 * 
 * @summary Handles File-based Cache.
 * 
 * [ PROPERTIES ]
 * @property string $cachePath          Path for the cache files.
 * @property bool $useCompression       Whether to use compression for cache files.
 * 
 * [ METHODS ]
 * @method void __construct(string $cachePath = './cache/', int $cacheTime = 3600, array $properties = [])  Initialize the TCacheFileHandler class with the cache path, cache time, and properties.
 * @method void clearCache(?string $cacheKey = null)                       Clears cache files, optionally for a specific key.
 * @method string compressData(array $data)                                Compresses data before saving to cache.
 * @method mixed checkCache(string $cacheKey)                              Checks for cached data in files.
 * @method array decompressData(string $data)                              Decompresses data after reading from cache.
 * @method void invalidateCache(string $cacheKey)                          Invalidates the cache for a specific key.
 * @method void saveCache(string $cacheKey, array $data)                   Saves data to cache files.
 * 
 * 
 * [ INHERITANCE METHODS ]
 * @method int getCacheTime()                                              Returns the cache time.
 * @method string getCacheType()                                           Returns the cache type.
 * @method void setCacheTime(int $cacheTime)                               Sets the cache time.
 * @method void setCacheType(string $cacheType)                            Sets the cache type.

 * @method string __toString()                                             Returns a string containing the name of this class.
 * @method bool Free(object $object)                                       Frees the memory of the Object or its clone.
 * @method bool FreeProperties(object $object)                             Delete and Frees up memory for all class properties.
 * @method bool getClassDeprecated()                                       Returns true if class is deprecated, otherwise false.
 * @method int getClassVersion()                                           We get the version of the class.
 * @method mixed getDeepProperty(array $keys, ?array $array = null)        Gets a property at any depth within the properties array.
 * @method array getProperties()                                           Returns the table of class properties.
 * @method mixed getProperty(string $property)                             Returns the content of the requested property.
 * @method ?array getPublicProperties()                                    Returns an array of the public properties of the class.
 * @method int|false getVersion(string $property)                          Get the version as an integer.       
 * @method string|false getVersionStr(string $property)                    Get the version as a formatted string.
 * @method bool isExecutable(int $currentVersion, int $currentPHPVersion)  Checks whether the current version of the class is executable according to the minimum and maximum versions you specify.
 * @method void setDeepProperty(array $keys, mixed $value, ?array &$array = null)                       Sets a property at any depth within the properties array.
 * @method void setProjectVersion(int|string $version = -1)                                             Sets the project version.
 * @method bool setProperties(array $properties, string|int|null $property_key = null)                  Recursively sets properties of the class, merging sub-arrays without overwriting other data.
 * @method bool setProperty(string|int $property, mixed $value, string|int|null $property_key = null)   Set a single property of the class.
 */
class TAscoosCacheHandler extends TCacheHandler {

    // [ PROPERTIES ]
    protected string $cachePath;
    protected bool $useCompression;



    // [ METHODS ]

    /**
     * Constructor.
     * 
     * @desc <English> Initialize the TCacheFileHandler class with the cache path, cache time, and properties.
     * @desc <Greek> Αρχικοποιεί την κλάση TCacheFileHandler με το μονοπάτι για την cache, τον χρόνο cache, και τις ιδιότητες.
     * 
     * @param string $cachePath     <English> Path for the cache files. 
     *                              <Greek> Μονοπάτι για τα αρχεία cache.
     * @param int $cacheTime    <English> The time in seconds for cache validity. 
     *                          <Greek> Ο χρόνος σε δευτερόλεπτα για την εγκυρότητα της cache.
     * @param array $properties     <English> Additional properties for the class. 
     *                              <Greek> Επιπρόσθετες ιδιότητες για την κλάση.
     */
    public function __construct(string $cachePath = './cache/', int $cacheTime = 3600, array $properties = [])
    {
        parent::__construct('ascoos', $cacheTime, $properties);
        $this->cachePath = $cachePath;
        $this->useCompression = $properties['useCompression'] ?? false;

        // ........ Other codes ................
    }    

    // _____________________________________________________________________________
    // ............... Others TAscoosCacheHandler Classes and data .................
    // _____________________________________________________________________________    
}
/******************************************************************************
 * @endcode TAscoosCacheHandler
 *****************************************************************************/


?>