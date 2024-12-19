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
 * @subpackage         	: Handles Chache.
 * @source             	: afw/kernel/coreCache.php
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
namespace ASCOOS\FRAMEWORK\Kernel\Cache;
defined ("ALEXSOFT_RUN_CMS") or die("Prohibition of Access.");
defined ("ASCOOS_FRAMEWORK_RUN") or die("Prohibition of Access.");

use ASCOOS\FRAMEWORK\Kernel\Core\TObject;

global $conf;

/******************************************************************************
 * @startcode TCacheHandler
 *****************************************************************************/
/**
 * @class   TCacheHandler
 * @extends TObject
 * 
 * @summary Handles Cache.
 * 
 * [ PROPERTIES ]
 * @property string $cacheType          Cache Type.
 * @property int $cacheTime             Time to live for cache data in seconds.
 * 
 * [ METHODS ]
 * @method void __construct(string $cacheType = 'file', int $cacheTime = 3600, array $properties = [])  Initialize the TCacheHandler class with the cache type, cache time, and properties.
 * @method mixed checkCache(string $cacheKey)                                     Checks for cached data (to be overridden by subclasses).
 * @method void clearCache(?string $cacheKey = null)                              Clears cache, optionally for a specific key.
 * @method int getCacheTime()                                                     Returns the cache time.
 * @method string getCacheType()                                                  Returns the cache type.
 * @method void setCacheTime(int $cacheTime)                                      Sets the cache time.
 * @method void setCacheType(string $cacheType)                                   Sets the cache type.
 * @method void saveCache(string $cacheKey, array $data)                          Saves data to cache (to be overridden by subclasses).
 * 
 * [ INHERITANCE METHODS ]
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
class TCacheHandler extends TObject
{
    protected string $cacheType;
    protected int $cacheTime;

    /**
     * Constructor.
     * 
     * @desc <English> Initialize the TCacheHandler class with the cache type, cache time, and properties.
     * @desc <Greek> Αρχικοποιεί την κλάση TCacheHandler με τον τύπο cache, τον χρόνο αποθήκευσης και τις ιδιότητες.
     * 
     * @param string $cacheType     <English> The type of cache (default is 'file'). 
     *                              <Greek> Ο τύπος της cache (προεπιλογή είναι 'file').
     * @param int $cacheTime        <English> Time to live for cache data in seconds (default is 3600). 
     *                              <Greek> Χρόνος αποθήκευσης των δεδομένων cache σε δευτερόλεπτα (προεπιλογή είναι 3600).
     * @param array $properties     <English> Additional properties for the class. 
     *                              <Greek> Επιπρόσθετες ιδιότητες για την κλάση.
     * 
     * @version 24.0.0
     */
    public function __construct(string $cacheType = 'file', int $cacheTime = 3600, array $properties = [])
    {
        parent::__construct($properties);
        $this->cacheType = $cacheType;
        $this->cacheTime = $cacheTime;
    }


    /**
     * Check for cached data.
     * 
     * @desc <English> Checks for cached data (to be overridden by subclasses).
     * @desc <Greek> Ελέγχει για δεδομένα cache (θα παρακάμπτεται από τις υποκλάσεις).
     * 
     * @param string $cacheKey  <English> The key for the cache file. 
     *                          <Greek> Το κλειδί για το αρχείο cache.
     * @return mixed    <English> Cached data if available, false otherwise. 
     *                  <Greek> Τα δεδομένα cache εάν είναι διαθέσιμα, αλλιώς false.
     * 
     * @version 24.0.0
     */
    public function checkCache(string $cacheKey): mixed
    {
        /*
            <English> This method will be overridden by subclasses
            <Greek> Αυτή η μέθοδος θα παρακάμπτεται από τις υποκλάσεις
        */
        return false;
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
        /*
            <English> This method will be overridden by subclasses
            <Greek> Αυτή η μέθοδος θα παρακάμπτεται από τις υποκλάσεις
        */
    }


    /**
     * Get the cache time.
     * 
     * @desc <English> Returns the cache time.
     * @desc <Greek> Επιστρέφει τον χρόνο αποθήκευσης των δεδομένων cache.
     * 
     * @return int  <English> The cache time in seconds. 
     *              <Greek> Ο χρόνος αποθήκευσης των δεδομένων cache σε δευτερόλεπτα.
     * 
     * @version 24.0.0
     */
    public function getCacheTime(): int
    {
        return $this->cacheTime;
    }


    /**
     * Set the cache time.
     * 
     * @desc <English> Sets the cache time.
     * @desc <Greek> Ορίζει τον χρόνο αποθήκευσης των δεδομένων cache.
     * 
     * @param int $cacheTime    <English> The cache time in seconds. 
     *                          <Greek> Ο χρόνος αποθήκευσης των δεδομένων cache σε δευτερόλεπτα.
     * 
     * @version 24.0.0
     */
    public function setCacheTime(int $cacheTime): void
    {
        $this->cacheTime = $cacheTime;
    }
        
    
    /**
     * Get the cache type.
     * 
     * @desc <English> Returns the cache type.
     * @desc <Greek> Επιστρέφει τον τύπο της cache.
     * 
     * @return string   <English> The cache type. 
     *                  <Greek> Ο τύπος της cache.
     * 
     * @version 24.0.0
     */
    public function getCacheType(): string
    {
        return $this->cacheType;
    }

    /**
     * Set the cache type.
     * 
     * @desc <English> Sets the cache type.
     * @desc <Greek> Ορίζει τον τύπο της cache.
     * 
     * @param string $cacheType  <English> The type of cache. 
     *                           <Greek> Ο τύπος της cache.
     * 
     * @version 24.0.0
     */
    public function setCacheType(string $cacheType): void
    {
        $this->cacheType = $cacheType;
    }


    /**
     * Save data to cache.
     * 
     * @desc <English> Saves data to cache (to be overridden by subclasses).
     * @desc <Greek> Αποθηκεύει δεδομένα στη cache (θα παρακάμπτεται από τις υποκλάσεις).
     * 
     * @param string $cacheKey  <English> The key for the cache file. 
     *                          <Greek> Το κλειδί για το αρχείο cache.
     * @param array $data   <English> The data to cache. 
     *                      <Greek> Τα δεδομένα για αποθήκευση στο cache.
     * 
     * @version 24.0.0
     */
    public function saveCache(string $cacheKey, array $data): void
    {
        /*
            <English> This method will be overridden by subclasses
            <Greek> Αυτή η μέθοδος θα παρακάμπτεται από τις υποκλάσεις
        */
    }

    // _______________________________________________________________________________________
    // ............... Others methods and properties of TCacheHandler Class  .................
    // _______________________________________________________________________________________    
}
/******************************************************************************
 * @endcode TCacheHandler
 *****************************************************************************/




/******************************************************************************
 * @RUNCODE  Default
 *****************************************************************************/
switch ($conf['cacheType']) {
    // ASCOOS CMS Cache Driver
//    case 'ascoos':
//        require_once "drivers/cache/ascoos.php";
//        break;
 
    // Memcached Cache Driver
    case 'memcached':
        require_once "drivers/cache/memcached.php";
        break;
 
    // Files (JSON) Cache Driver (DEFAULT)
    case 'file':
    default:
        require_once "drivers/cache/files.php";
}
 
?>