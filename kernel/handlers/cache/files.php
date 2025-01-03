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
 * @subpackage         	: Handles Cache Files.
 * @source             	: afw/kernel/handlers/cache/files.php
 * @fileNo             	: 
 * @version            	: 25.0.0
 * @build               : 10829
 * @created            	: 2007-05-11 07:00:00 UTC+2 
 * @updated            	: 2025-01-01 07:00:00 UTC+2
 * @author             	: Drogidis Christos
 * @authorSite         	: www.alexsoft.gr
 * @license 			: AGL-F
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);
namespace ASCOOS\FRAMEWORK\Kernel\Cache\Files;
defined ("ALEXSOFT_RUN_CMS") or die("Prohibition of Access.");
defined ("ASCOOS_FRAMEWORK_RUN") or die("Prohibition of Access.");


use ASCOOS\FRAMEWORK\Kernel\Cache\TCacheHandler;


/******************************************************************************
 * @startcode TCacheFileHandler
 *****************************************************************************/
/**
 * @class   TCacheFileHandler
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
 * @method array getStats()                                                Get statistics from cache file.
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
class TCacheFileHandler extends TCacheHandler
{
    protected string $cachePath;
    protected bool $useCompression;

    /**
     * Constructor.
     * 
     * @desc <English> Initialize the TCacheFileHandler class with the cache path, cache time, and properties.
     * @desc <Greek> Αρχικοποιεί την κλάση TCacheFileHandler με το μονοπάτι για την cache, τον χρόνο cache, και τις ιδιότητες.
     * 
     * @param string $cachePath  <English> Path for the cache files. <Greek> Μονοπάτι για τα αρχεία cache.
     * @param int $cacheTime  <English> The time in seconds for cache validity. <Greek> Ο χρόνος σε δευτερόλεπτα για την εγκυρότητα της cache.
     * @param array $properties  <English> Additional properties for the class. <Greek> Επιπρόσθετες ιδιότητες για την κλάση.
     */
    public function __construct(string $cachePath = './cache/', int $cacheTime = 3600, array $properties = [])
    {
        parent::__construct('file', $cacheTime, $properties);
        $this->cachePath = $cachePath;
        $this->useCompression = $properties['useCompression'] ?? false;
    }

    /**
     * Clear cache files.
     * 
     * @desc <English> Clears cache files, optionally for a specific key.
     * @desc <Greek> Καθαρίζει τα αρχεία cache, προαιρετικά για ένα συγκεκριμένο κλειδί.
     * 
     * @param string|null $cacheKey     <English> The key for the cache file (optional). 
     *                                  <Greek> Το κλειδί για το αρχείο cache (προαιρετικό).
     */
     public function clearCache(?string $cacheKey = null): void
     {
         if ($cacheKey) {
             $cacheFile = $this->cachePath . md5($cacheKey) . '.json';
             if (file_exists($cacheFile)) {
                 if (is_writable($cacheFile)) {
                     if (@unlink($cacheFile) === false) {
                         echo "Failed to delete file: $cacheFile.";
                     }
                 } else {
                     echo "Cannot delete file: $cacheFile. Check permissions.";
                 }
             }
         } else {
             $files = glob($this->cachePath . '*.json');
             foreach ($files as $file) {
                 if (is_file($file)) {
                     if (is_writable($file)) {
                         if (@unlink($file) === false) {
                             echo "Failed to delete file: $file.";
                         }
                     } else {
                         echo "Cannot delete file: $file. Check permissions.";
                     }
                 }
             }
         }
     }


    /**
     * Compress data before saving to cache.
     * 
     * @desc <English> Compresses data before saving to cache.
     * @desc <Greek> Συμπιέζει τα δεδομένα πριν από την αποθήκευσή τους στην cache.
     * 
     * @param array $data  <English> The data to compress. <Greek> Τα δεδομένα για συμπίεση.
     * @return string  <English> The compressed data. <Greek> Τα συμπιεσμένα δεδομένα.
     */
    protected function compressData(array $data): string
    {
        return gzcompress(json_encode($data), 9);
    }


    /**
     * Check for cached data in files.
     * 
     * @desc <English> Checks for cached data in files.
     * @desc <Greek> Ελέγχει για δεδομένα cache στα αρχεία.
     * 
     * @param string $cacheKey  <English> The key for the cache file. 
     *                          <Greek> Το κλειδί για το αρχείο cache.
     * @return mixed    <English> Cached data if available, false otherwise. 
     *                  <Greek> Τα δεδομένα cache εάν είναι διαθέσιμα, αλλιώς false.
     */    
    public function checkCache(string $cacheKey): mixed
    {
        $cacheFile = $this->cachePath . md5($cacheKey) . '.json';
        if (file_exists($cacheFile)) {
            if (time() - filemtime($cacheFile) < $this->cacheTime) {
                $data = file_get_contents($cacheFile);
                $data = $this->useCompression ? gzuncompress($data) : $data;
                return json_decode($data, true);
            }
        }
        return false;
    }


    /**
     * Decompress data after reading from cache.
     * 
     * @desc <English> Decompresses data after reading from cache.
     * @desc <Greek> Αποσυμπιέζει τα δεδομένα μετά την ανάγνωση από την cache.
     * 
     * @param string $data  <English> The compressed data. <Greek> Τα συμπιεσμένα δεδομένα.
     * @return array  <English> The decompressed data. <Greek> Τα αποσυμπιεσμένα δεδομένα.
     */
    protected function decompressData(string $data): array
    {
        return json_decode(gzuncompress($data), true);
    }


    /**
     * Get Cache Statistics.
     * 
     * @desc <English>  Get statistics from the file-based cache (optional method).
     * @desc <Greek>    Λήψη στατιστικών από την cache αρχείων (προαιρετική μέθοδος).
     * 
     * @return array <English> Array containing file-based cache statistics (optional method).
     *               <Greek>   Πίνακας με τα στατιστικά της cache αρχείων (προαιρετική μέθοδος).
     */
    public function getStats(): array
    {
        // Optional method: Implement if needed to return file-based cache statistics
        return [];
    }


    /**
     * Invalidate the cache for a specific key.
     * 
     * @desc <English> Invalidates the cache for a specific key.
     * @desc <Greek> Ακυρώνει την cache για ένα συγκεκριμένο κλειδί.
     * 
     * @param string $cacheKey  <English> The key for the cache file. <Greek> Το κλειδί για το αρχείο cache.
     */
    public function invalidateCache(string $cacheKey): void
    {
        $cacheFile = $this->cachePath . md5($cacheKey) . '.json';
        if (file_exists($cacheFile)) {
            if (@unlink($cacheFile) === false) {
                // Αν η διαγραφή αποτύχει, εμφάνισε μήνυμα σφάλματος
                echo "Failed to delete file: $cacheFile.";
            }
        }
    }

    
    /**
     * Save data to cache files.
     * 
     * @desc <English> Saves data to cache files.
     * @desc <Greek> Αποθηκεύει δεδομένα στα αρχεία cache.
     * 
     * @param string $cacheKey  <English> The key for the cache file. <Greek> Το κλειδί για το αρχείο cache.
     * @param array $data  <English> The data to cache. <Greek> Τα δεδομένα για αποθήκευση στο cache.
     */
    public function saveCache(string $cacheKey, array $data): void
    {
        if (!is_dir($this->cachePath)) {
            mkdir($this->cachePath, 0755, true);
        }
        $cacheFile = $this->cachePath . md5($cacheKey) . '.json';
        $dataToSave = $this->useCompression ? $this->compressData($data) : json_encode($data);
        file_put_contents($cacheFile, $dataToSave);
    }

    
    // ___________________________________________________________________________________________
    // ............... Others methods and properties of TCacheFileHandler Class  .................
    // ___________________________________________________________________________________________      
}
/******************************************************************************
 * @endcode TCacheFileHandler
 *****************************************************************************/
?>