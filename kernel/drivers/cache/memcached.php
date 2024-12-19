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
 * @subpackage         	: Handles Cache Memcached Files.
 * @source             	: afw/kernel/drivers/cache/memcached.php
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
namespace ASCOOS\FRAMEWORK\Kernel\Cache\Memcached;
defined ("ALEXSOFT_RUN_CMS") or die("Prohibition of Access.");
defined ("ASCOOS_FRAMEWORK_RUN") or die("Prohibition of Access.");


use ASCOOS\FRAMEWORK\Kernel\Cache\TCacheHandler;
use Memcached;
use Exception;

/******************************************************************************
 * @startcode TCacheMemcachedHandler
 *****************************************************************************/
/**
 * @class   TCacheMemcachedHandler
 * @extends TCacheHandler
 * 
 * @summary Handles Memcached-based Cache.
 * 
 * [ PROPERTIES ]
 * @property $memcached      Protected Property for Memcached object.
 * 
 * [ METHODS ]
 * @method void __construct(int $cacheTime = 3600, array $properties = [])  Initialize the TCacheFileHandler class with the cache path, cache time, and properties.
 * @method mixed checkCache(string $cacheKey)                               Checks for cached data.
 * @method void clearCache(?string $cacheKey = null)                        Clears cache, optionally for a specific key.
 * @method array getStats()                                                 Get statistics from Memcached.
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
class TCacheMemcachedHandler extends TCacheHandler
{
    protected $memcached;

    /**
     * Constructor.
     * 
     * @desc <English> Initialize the TCacheFileHandler class with the cache path, cache time, and properties.
     * @desc <Greek> Αρχικοποιεί την κλάση TCacheFileHandler με το μονοπάτι για την cache, τον χρόνο cache, και τις ιδιότητες.
     * 
     * @param int $cacheTime    <English> The time in seconds for cache validity. 
     *                          <Greek> Ο χρόνος σε δευτερόλεπτα για την εγκυρότητα της cache.
     * @param array $properties     <English> Additional properties for the class.
     *                              <Greek> Επιπρόσθετες ιδιότητες για την κλάση.
     */
    public function __construct(int $cacheTime = 3600, array $properties = [])
    {
        parent::__construct('memcached', $cacheTime, $properties);

        // Check if the memcached extension is loaded
        if (!extension_loaded('memcached')) {
            throw new Exception('The memcached PHP extension is not loaded.');
        }

        // Initialize memcached with properties
        $this->memcached = new Memcached();
        $host = $properties['memcached']['host'] ?? 'localhost';
        $port = $properties['memcached']['port'] ?? 11211;
        $this->memcached->addServer($host, $port);

        // Set additional memcached options
        if (isset($properties['memcached']['options']) && is_array($properties['memcached']['options'])) {
            foreach ($properties['memcached']['options'] as $option => $value) {
                $this->memcached->setOption($option, $value);
            }
        }
    }

    
    /**
     * Check for cached data in Memcached.
     * 
     * @desc <English> Checks for cached data in Memcached.
     * @desc <Greek> Ελέγχει για δεδομένα cache στο Memcached.
     * 
     * @param string $cacheKey  <English> The key for the cache. 
     *                          <Greek> Το κλειδί για το cache.
     * @return mixed    <English> Cached data if available, false otherwise. 
     *                  <Greek> Τα δεδομένα cache εάν είναι διαθέσιμα, αλλιώς false.
     */ 
    public function checkCache(string $cacheKey): mixed
    {
        $data = $this->memcached->get($cacheKey);
        return ($this->memcached->getResultCode() === Memcached::RES_NOTFOUND) ? false : $data;
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
            $this->memcached->flush();
        } else {
            $this->memcached->delete($cacheKey);
        }
    }


    /**
     * Get statistics from Memcached.
     * 
     * @desc <English> Returns statistics from the Memcached server.
     * @desc <Greek> Επιστρέφει στατιστικά από τον εξυπηρετητή Memcached.
     * 
     * @return array    <English> Array containing Memcached statistics.
     *                  <Greek> Πίνακας που περιέχει στατιστικά του Memcached.
     * 
     * @version 24.0.0
     */
    public function getStats(): array
    {
        return $this->memcached->getStats();
    }


    /**
     * Saves data to Memcached.
     * 
     * @desc <English> Saves data to Memcached.
     * @desc <Greek> Αποθηκεύει δεδομένα στο Memcached.
     * 
     * @param string $cacheKey  <English> The key for the cache file. 
     *                          <Greek> Το κλειδί για το αρχείο cache.
     * @param array $data   <English> The data to cache. 
     *                      <Greek> Τα δεδομένα για αποθήκευση στο cache.
     */    
    public function saveCache(string $cacheKey, array $data): void
    {
        $this->memcached->set($cacheKey, $data, $this->cacheTime);
    }

    // ________________________________________________________________________________________________
    // ............... Others methods and properties of TCacheMemcachedHandler Class  .................
    // ________________________________________________________________________________________________      
}
/******************************************************************************
 * @endtcode TCacheMemcachedHandler
 *****************************************************************************/
?>