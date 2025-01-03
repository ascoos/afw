<?php 
/**
 *   __ _  ___  ___ ___   ___   ___     ____ _ __ ___   ___
 *  / _` |/  / / __/ _ \ / _ \ /  /    / __/| '_ ` _ \ /  /
 * | (_| |\  \| (_| (_) | (_) |\  \   | (__ | | | | | |\  \
 *  \__,_|/__/ \___\___/ \___/ /__/    \___\|_| |_| |_|/__/
 * 
 * 
 ************************************************************************************
 * @ASCOOS-NAME        	: ASCOOS CMS 25'                                            *
 * @ASCOOS-VERSION     	: 25.0.0                                                    *
 * @ASCOOS-CATEGORY    	: Framework (Frontend and Administrator Side)               *
 * @ASCOOS-CREATOR     	: Drogidis Christos                                         *
 * @ASCOOS-SITE        	: www.ascoos.com                                            *
 * @ASCOOS-LICENSE     	: [Commercial] http://docs.ascoos.com/lics/ascoos/AGL.html  *
 * @ASCOOS-COPYRIGHT   	: Copyright (c) 2007 - 2025, AlexSoft Software.             *
 ************************************************************************************
 *
 * @package            	: ASCOOS FRAMEWORK 25'
 * @subpackage         	: Handles Opcache-based Cache.
 * @source             	: afw/kernel/handlers/cache/opcache.php
 * @fileNo             	: 
 * @version            	: 25.0.0
 * @build               : 10829
 * @created            	: 2024-07-01 20:00:00 UTC+2
 * @updated            	: 2025-01-01 07:00:00 UTC+2 
 * @author             	: Drogidis Christos
 * @authorSite         	: www.alexsoft.gr
 * @license 			: AGL-F
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);
namespace ASCOOS\FRAMEWORK\Kernel\Cache\Opcache;
defined ("ALEXSOFT_RUN_CMS") or die("Prohibition of Access.");
defined ("ASCOOS_FRAMEWORK_RUN") or die("Prohibition of Access.");


use ASCOOS\FRAMEWORK\Kernel\Cache\TCacheHandler;
use Exception;



/******************************************************************************
 * @startcode TCacheOpcacheHandler
 *****************************************************************************/
/**
 * @class   TCacheOpcacheHandler
 * @extends TCacheHandler
 * 
 * @summary Handles Opcache-based Cache.
 * 
 * [ METHODS ]
 * @method void __construct(int $cacheTime = 3600, array $properties = [])  Initialize the TCacheOpcacheHandler class with the cache time and properties.
 * @method mixed checkCache(string $cacheKey)                               Checks for cached data.
 * @method void clearCache(?string $cacheKey = null)                        Clears cache, optionally for a specific key.
 * @method array getStats()                                                 Get statistics from Opcache.
 * @method void saveCache(string $cacheKey, array $data)                    Saves data to cache.
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
class TCacheOpcacheHandler extends TCacheHandler
{
    /**
     * Constructor.
     * 
     * @desc <English> Initialize the TCacheOpcacheHandler class with the cache time and properties.
     * @desc <Greek> Αρχικοποιεί την κλάση TCacheOpcacheHandler με τον χρόνο cache και τις ιδιότητες.
     * 
     * @param int $cacheTime    <English> The time in seconds for cache validity. 
     *                          <Greek> Ο χρόνος σε δευτερόλεπτα για την εγκυρότητα της cache.
     * @param array $properties     <English> Additional properties for the class.
     *                              <Greek> Επιπρόσθετες ιδιότητες για την κλάση.
     */
    public function __construct(int $cacheTime = 3600, array $properties = [])
    {
        parent::__construct('opcache', $cacheTime, $properties);

        // Check if the Opcache extension is loaded
        if (!function_exists('opcache_get_status')) {
            throw new Exception('The Opcache PHP extension is not enabled.');
        }
    }

    
    /**
     * Check for cached data in Opcache.
     * 
     * @desc <English> Checks for cached data in Opcache.
     * @desc <Greek> Ελέγχει για δεδομένα cache στο Opcache.
     * 
     * @param string $cacheKey  <English> The key for the cache. 
     *                          <Greek> Το κλειδί για το cache.
     * @return mixed    <English> Cached data if available, false otherwise. 
     *                  <Greek> Τα δεδομένα cache εάν είναι διαθέσιμα, αλλιώς false.
     */ 
    public function checkCache(string $cacheKey): mixed
    {
        // Note: Opcache is not a general-purpose cache; it is used for PHP code optimization.
        return false; // Opcache does not support key-value cache lookup
    }


    /**
     * Clear cache.
     * 
     * @desc <English> Clears cache, optionally for a specific key.
     * @desc <Greek> Καθαρίζει την cache, προαιρετικά για ένα συγκεκριμένο κλειδί.
     * 
     * @param ?string $cacheKey     <English> The key for the cache (optional). 
     *                              <Greek> Το κλειδί για την cache (προαιρετικό).
     */
    public function clearCache(?string $cacheKey = null): void
    {
        if ($cacheKey === null) {
            opcache_reset();
        } else {
            // Note: Opcache does not support key-based cache clearing
            throw new Exception('Opcache does not support key-based cache clearing.');
        }
    }


    /**
     * Get statistics from Opcache.
     * 
     * @desc <English> Returns statistics from the Opcache cache.
     * @desc <Greek> Επιστρέφει στατιστικά από την cache Opcache.
     * 
     * @return array    <English> Array containing Opcache statistics.
     *                  <Greek> Πίνακας που περιέχει στατιστικά του Opcache.
     * 
     * @version 24.0.0
     */
    public function getStats(): array
    {
        return opcache_get_status();
    }


    /**
     * Saves data to Opcache.
     * 
     * @desc <English> Saves data to Opcache (Not applicable).
     * @desc <Greek> Αποθηκεύει δεδομένα στο Opcache (Δεν εφαρμόζεται).
     * 
     * @param string $cacheKey  <English> The key for the cache. 
     *                          <Greek> Το κλειδί για την cache.
     * @param array $data   <English> The data to cache. 
     *                      <Greek> Τα δεδομένα για αποθήκευση στο cache.
     */    
    public function saveCache(string $cacheKey, array $data): void
    {
        // Note: Opcache does not support key-value cache storage
        throw new Exception('Opcache does not support key-value cache storage.');
    }
    
    // ________________________________________________________________________________________________
    // ............... Others methods and properties of TCacheOpcacheHandler Class  .................
    // ________________________________________________________________________________________________    
}
/******************************************************************************
 * @endtcode TCacheOpcacheHandler
 *****************************************************************************/
?>