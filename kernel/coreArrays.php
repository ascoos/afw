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
 * @subpackage         	: Handles arrays.
 * @source             	: afw/kernel/coreArrays.php
 * @fileNo             	: 
 * @version            	: 24.0.6
 * @created            	: 2024-07-01 20:00:00 UTC+3 
 * @updated            	: 2024-12-15 07:00:00 UTC+3 
 * @author             	: Drogidis Christos
 * @authorSite         	: www.alexsoft.gr
 * @license 			: AGL-F
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);
namespace ASCOOS\FRAMEWORK\Kernel\Arrays;
defined ("ALEXSOFT_RUN_CMS") or die("Prohibition of Access.");
defined ("ASCOOS_FRAMEWORK_RUN") or die("Prohibition of Access.");

use SimpleXMLElement;
use ASCOOS\FRAMEWORK\Kernel\Core\{TObject, TError};
use Exception;
use TypeError;

/******************************************************************************
 * @startcode TArrayHandler
 *****************************************************************************/
/**
 * @class   TArrayHandler
 * @extends TObject
 * 
 * @summary Handles arrays.
 * 
 * [ PROPERTIES ]
 * @property array $array               Array to store data.
 * 
 * [ METHODS ]
 * @method void __construct(array $array = [], array $properties = [])     The constructor method for the class. It must always be overridden.
 * @method array chunk(int $length, bool $preserve_keys = false)           Splits the internal array into chunks.
 * @method void cleanEmptyElements()                                       Cleans the array by removing empty elements.
 * @method void cleanHTMLTags()                                            Cleans the array by removing HTML tags from elements.
 * @method void cleanInvalidDataTypes(string $type)                        Cleans the array by removing elements of invalid data types.
 * @method void cleanSpecialCharacters(string $pattern = '/[^A-Za-z0-9]/') Cleans the array by removing special characters from elements.
 * @method void cleanValidURLs()                                           Validates and cleans the array for valid URLs.
 * @method void cleanWhitespace()                                          Cleans the array by trimming whitespace from elements.
 * @method array combine(array $keys)                                      Combines two arrays into an associative array.
 * @method array diff(array $array)                                        Returns the difference between two arrays.
 * @method bool empty(?array $array=null)                                  Checks if an array is empty.
 * @method array filter(callable $callback)                                Filters the array based on a callback function.
 * @method bool find(mixed $element)                                       Finds an element in the array.
 * @method array flatten(?array $array=null)                               Flatten function for multidimensional arrays.
 * @method array flip()                                                    Flips the array keys and values.
 * @method void fromBSON(string $filePath)                                 Converts binary-like format to array.
 * @method void fromCSV(string $filePath)                                  Converts CSV format to array.
 * @method void fromINI(string $filePath)                                  Converts INI file to array.
 * @method void fromJSON(string $json)                                     Converts JSON string to array.
 * @method void fromObject(object $object)                                 Converts an object to array.
 * @method void fromPHPArrayFile(string $filePath)                         Reads a PHP file that returns an array and assigns it to the internal array.
 * @method void fromPHPVariablesFile(string $filePath)                     Reads a PHP file that defines variables and assigns them to the internal array.
 * @method void fromPlainText(string $filePath)                            Converts plain text format to array.
 * @method void fromRSS(string $rss)                                       Converts RSS feed format to array.
 * @method void fromTOML(string $filePath)                                 Converts TOML format to array.
 * @method void fromXML(string $xml)                                       Converts XML string to array.
 * @method void fromYAML(string $filePath)                                 Converts YAML format to array.
 * @method array intersect(array $array)                                   Returns the intersection of two arrays.
 * @method array keys()                                                    Returns the keys of the array.
 * @method array map(callable $callback)                                   Applies a callback function to each element in the array.
 * @method void merge(array ...$arrays)                                    Merges the internal array with one or more arrays.
 * @method void merge_recursive(array ...$arrays)                          Recursively merges the internal array with one or more arrays.
 * @method mixed reduce(callable $callback, mixed $initial)                Reduces the array to a single value using a callback function.
 * @method void replace(array ...$replacements)                            Replaces the internal array with one or more arrays.
 * @method void replace_recursive(array ...$replacements)                  Recursively replaces the internal array with one or more arrays.
 * @method void reverse()                                                  Reverses the array.
 * @method array slice(int $offset, ?int $length = null, bool $preserve_keys = false)   Returns a slice of the array.
 * @method void sortAsc()                                                  Sorts the array in ascending order.
 * @method void sortDesc()                                                 Sorts the array in descending order.
 * @method void toBSON(string $filePath)                                   Converts array to a binary-like format and saves to file.
 * @method void toCSV(string $filePath)                                    Converts array to CSV format and saves to file.
 * @method void toINI(string $filePath)                                    Converts array to INI format and saves to file.
 * @method string toJSON()                                                 Converts array to JSON string.
 * @method object toObject()                                               Converts array to an object.
 * @method void toPHPArrayFile(string $filePath)                           Creates a PHP file that returns the array.
 * @method void toPHPVariablesFile(string $filePath)                       Creates a PHP file that defines variables for the array elements.
 * @method void toPlainText(string $filePath)                              Converts array to plain text format and saves to file.
 * @method string toRSS()                                                  Converts array to RSS feed format.
 * @method void toTOML(string $filePath)                                   Converts array to TOML format and saves to file.
 * @method string toXML()                                                  Converts array to XML string.
 * @method void toYAML(string $filePath)                                   Converts array to YAML format and saves to file.
 * @method array unique()                                                  Removes duplicate values from the array.
 * @method bool validateDataType(string $type)                             Validates the array for specific data types.
 * @method bool validateNotEmpty()                                         Validates the array for empty elements.
 * @method bool validatePattern(string $pattern)                           Validates the array for elements matching a specific pattern.
 * @method bool validateRange(float $min, float $max)                      Validates the array for elements within a specific range.
 * @method bool validateUnique()                                           Validates the array for unique elements.
 * @method array values()                                                  Returns the values of the array.
 * @method bool walkRecursive(callable $callback)                          Applies a callback function to each element in the array recursively.
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
class TArrayHandler extends TObject
{
    protected array $array = [];


    /**
     * The constructor method for the class. It must always be overridden.
     * 
     * @desc <English>  Initializes the class with an array and optional properties.
     * @desc <Greek>    Αρχικοποιεί την κλάση με έναν πίνακα και προαιρετικές ιδιότητες.
     * 
     * @param array $array <English>  The array to initialize the class with.
     *                      <Greek>    Ο πίνακας για την αρχικοποίηση της κλάσης.
     * @param array $properties <English>  Optional properties for the class.
     *                           <Greek>    Προαιρετικές ιδιότητες για την κλάση.
     * 
     * @version 24.0.0
     */
    public function __construct(array $array = [], array $properties = [])
    {
        /*
        <English>
            If there are new properties for the class, we pass them to the properties table 
            by calling the parent constructor.
        </English>
        <Greek>
            Εάν υπάρχουν νέες ιδιότητες για την κλάση, τις περνάμε στον πίνακα ιδιοτήτων 
            καλώντας τον προγονικό κατασκευαστή.
        </Greek>
        */
        parent::__construct($properties);

        /*
        <English>
            Checks if a table $properties is empty, if not passes it to the inner data table
        </English>
        <Greek>
            Ελέγχει εάν ο πίνακας $properties είναι κενός, εάν όχι τον περνάει στον εσωτερικό πίνακα δεδομένων
        </Greek>
        */
        if (!$this->empty($array)) $this->array = $array;
    }


    /**
     * Splits the array into chunks.
     * 
     * @desc <English>  Splits the internal array into chunks of a given size.
     * @desc <Greek>    Διαχωρίζει τον εσωτερικό πίνακα σε τμήματα συγκεκριμένου μεγέθους.
     * 
     * @param int $size <English>  The size of each chunk.
     *                  <Greek>    Το μέγεθος κάθε τμήματος.
     * @return array <English>  The array of chunks.
     *                <Greek>    Ο πίνακας των τμημάτων.
     * 
     * @version 24.0.0
     */
    final public function chunk(int $length, bool $preserve_keys = false): array
    {
        /*
        <English>
            Split the internal array into chunks of the specified size.
        </English>
        <Greek>
            Διαχωρίζει τον εσωτερικό πίνακα σε τμήματα του καθορισμένου μεγέθους.
        </Greek>
        */
        return array_chunk($this->array, $length, $preserve_keys);
    }


    /**
     * Cleans the array by removing empty elements.
     * 
     * @desc <English>  Cleans the internal array by removing empty elements.
     * @desc <Greek>    Καθαρίζει τον εσωτερικό πίνακα αφαιρώντας τα κενά στοιχεία.
     * 
     * @return void
     * 
     * @version 24.0.0
     */
    public function cleanEmptyElements(): void
    {
        /*
        <English>
            Remove empty elements from the array.
        </English>
        <Greek>
            Αφαιρεί τα κενά στοιχεία από τον πίνακα.
        </Greek>
        */
        $this->array = array_filter($this->array, fn($value) => !empty($value));
    }


    /**
     * Cleans the array by removing HTML tags from elements.
     * 
     * @desc <English>  Cleans the internal array by removing HTML tags from elements.
     * @desc <Greek>    Καθαρίζει τον εσωτερικό πίνακα αφαιρώντας HTML tags από τα στοιχεία.
     * 
     * @return void
     * 
     * @version 24.0.0
     */
    public function cleanHTMLTags(): void
    {
        /*
        <English>
            Remove HTML tags from each element.
        </English>
        <Greek>
            Αφαιρεί HTML tags από κάθε στοιχείο.
        </Greek>
        */
        $this->array = array_map('strip_tags', $this->array);
    }


    /**
     * Cleans the array by removing elements of invalid data types.
     * 
     * @desc <English>  Cleans the internal array by removing elements of invalid data types.
     * @desc <Greek>    Καθαρίζει τον εσωτερικό πίνακα αφαιρώντας στοιχεία με μη έγκυρους τύπους δεδομένων.
     * 
     * @param string $type <English>  The valid data type to retain (e.g., 'integer', 'string').
     *                     <Greek>    Ο έγκυρος τύπος δεδομένων που θα διατηρηθεί (π.χ., 'integer', 'string').
     * @return void
     * 
     * @version 24.0.0
     */
    public function cleanInvalidDataTypes(string $type): void
    {
        /*
        <English>
            Remove elements of invalid data types from the array.
        </English>
        <Greek>
            Αφαιρεί στοιχεία με μη έγκυρους τύπους δεδομένων από τον πίνακα.
        </Greek>
        */
        $this->array = array_filter($this->array, fn($value) => gettype($value) === $type);
    }


    /**
     * Cleans the array by removing special characters from elements.
     * 
     * @desc <English>  Cleans the internal array by removing special characters from elements.
     * @desc <Greek>    Καθαρίζει τον εσωτερικό πίνακα αφαιρώντας ειδικούς χαρακτήρες από τα στοιχεία.
     * 
     * @return void
     * 
     * @version 24.0.0
     */
    public function cleanSpecialCharacters(string $pattern = '/[^A-Za-z0-9]/'): void
    {
        /*
        <English>
            Remove special characters from each element.
        </English>
        <Greek>
            Αφαιρεί ειδικούς χαρακτήρες από κάθε στοιχείο.
        </Greek>
        */
        $this->array = array_map(fn($value) => preg_replace($pattern, '', $value), $this->array);
    }


    /**
     * Validates and cleans the array for valid URLs.
     * 
     * @desc <English>  Validates and cleans the internal array for valid URLs.
     * @desc <Greek>    Επαληθεύει και καθαρίζει τον εσωτερικό πίνακα για έγκυρες διευθύνσεις URL.
     * 
     * @return void
     * 
     * @version 24.0.0
     */
    public function cleanValidURLs(): void
    {
        /*
        <English>
            Validate and clean each element to ensure it is a valid URL.
        </English>
        <Greek>
            Επαληθεύει και καθαρίζει κάθε στοιχείο για να διασφαλίσει ότι είναι έγκυρη διεύθυνση URL.
        </Greek>
        */
        $this->array = array_filter($this->array, function($value) {
            return filter_var($value, FILTER_VALIDATE_URL);
        });
    }


    /**
     * Cleans the array by trimming whitespace from elements.
     * 
     * @desc <English>  Cleans the internal array by trimming whitespace from elements.
     * @desc <Greek>    Καθαρίζει τον εσωτερικό πίνακα αφαιρώντας τα περιττά λευκά διαστήματα από τα στοιχεία.
     * 
     * @return void
     * 
     * @version 24.0.0
     */
    public function cleanWhitespace(): void
    {
        /*
        <English>
            Trim whitespace from each element.
        </English>
        <Greek>
            Αφαιρεί τα περιττά λευκά διαστήματα από κάθε στοιχείο.
        </Greek>
        */
        $this->array = array_map('trim', $this->array);
    }



    /**
     * Combines two arrays into an associative array.
     * 
     * @desc <English>  Combines the internal array with another array to form an associative array.
     * @desc <Greek>    Συνδυάζει τον εσωτερικό πίνακα με έναν άλλο πίνακα για να σχηματίσει έναν πίνακα συσχέτισης.
     * 
     * @param array $keys <English>  The array of keys.
     *                    <Greek>    Ο πίνακας των κλειδιών.
     * @return array <English>  The combined associative array.
     *                <Greek>    Ο συνδυασμένος πίνακας συσχέτισης.
     * 
     * @version 24.0.0
     */
    public function combine(array $keys): array
    {
        /*
        <English>
            Combine the internal array with the provided keys array.
        </English>
        <Greek>
            Συνδυάζει τον εσωτερικό πίνακα με τον παρεχόμενο πίνακα κλειδιών.
        </Greek>
        */
        return array_combine($keys, $this->array);
    }

    
    /**
     * Returns the difference between two arrays.
     * 
     * @desc <English>  Returns the difference between the internal array and another array.
     * @desc <Greek>    Επιστρέφει τις διαφορές μεταξύ του εσωτερικού πίνακα και ενός άλλου πίνακα.
     * 
     * @param array $array <English>  The array to compare with.
     *                     <Greek>    Ο πίνακας με τον οποίο θα γίνει η σύγκριση.
     * @return array <English>  The array of differences.
     *                <Greek>    Ο πίνακας των διαφορών.
     * 
     * @version 24.0.0
     */
    public function diff(array $array): array
    {
        /*
        <English>
            Return the differences between the internal array and the provided array.
        </English>
        <Greek>
            Επιστρέφει τις διαφορές μεταξύ του εσωτερικού πίνακα και του παρεχόμενου πίνακα.
        </Greek>
        */
        return array_diff($this->array, $array);
    }


    /**
     * Checks if the array is empty.
     * 
     * @desc <English>  Checks if an array is empty and handles exceptions.
     * @desc <Greek>    Ελέγχει εάν ένας πίνακας είναι κενός και διαχειρίζεται εξαιρέσεις.
     * 
     * @param array|null $array <English>  The array to check, or null to check the internal array.
     *                           <Greek>    Ο πίνακας προς έλεγχο, ή null για έλεγχο του εσωτερικού πίνακα.
     * @return bool <English>  True if the array is empty, false otherwise.
     *               <Greek>   True αν ο πίνακας είναι κενός, αλλιώς false.
     * 
     * @version 24.0.0
     */
    public function empty(?array $array = null): bool
    {
        if (!is_null($array)) {
            if (is_array($array)) {
                /*
                <English>
                    Check if the array is empty. If it has elements, set return value to false, otherwise set to true.
                </English>
                <Greek>
                    Ελέγχει αν ο πίνακας είναι κενός. Αν έχει στοιχεία, ορίζει την τιμή επιστροφής σε false, αλλιώς την ορίζει σε true.
                </Greek>
                */
                return empty($array);
            } else {
                throw new \InvalidArgumentException("TArrayHandler::empty : Argument #1 must be array or null. It has been given: " . gettype($array));
            }
        } else {
            /*
            <English>
                Check if the internal array is empty. If it has elements, set return value to false, otherwise set to true.
            </English>
            <Greek>
                Ελέγχει αν ο εσωτερικός πίνακας είναι κενός. Αν έχει στοιχεία, ορίζει την τιμή επιστροφής σε false, αλλιώς την ορίζει σε true.
            </Greek>
            */
            return empty($this->array);
        }
    }


    /**
     * Filters the array based on a callback function.
     * 
     * @desc <English>  Filters the internal array based on a user-defined callback function.
     * @desc <Greek>    Φιλτράρει τον εσωτερικό πίνακα βάσει μιας συνάρτησης καθορισμένης από τον χρήστη.
     * 
     * @param callable $callback <English>  The callback function to use for filtering.
     *                           <Greek>    Η συνάρτηση για φιλτράρισμα.
     * @return array <English>  The filtered array.
     *                <Greek>    Ο φιλτραρισμένος πίνακας.
     * 
     * @version 24.0.0
     */
    public function filter(callable $callback): array
    {
        return array_filter($this->array, $callback);
    }
        

    /**
     * Finds an element in the array.
     * 
     * @desc <English>  Finds an element in the internal array.
     * @desc <Greek>    Βρίσκει ένα στοιχείο στον εσωτερικό πίνακα.
     * 
     * @param mixed $element <English>  The element to find.
     *                       <Greek>    Το στοιχείο που θα βρεθεί.
     * @return bool <English>  Returns true if the element is found, otherwise false.
     *               <Greek>    Επιστρέφει true αν το στοιχείο βρεθεί, αλλιώς false.
     * 
     * @version 24.0.0
     */
    public function find($element): bool
    {
        /*
        <English>
            Check if the element is in the array and return the result.
        </English>
        <Greek>
            Ελέγχει αν το στοιχείο βρίσκεται στον πίνακα και επιστρέφει το αποτέλεσμα.
        </Greek>
        */
        return in_array($element, $this->array);
    }


    /**
     * Λειτουργία flatten για πολυδιάστατους πίνακες
     * 
     * @desc <English> Flatten function for multidimensional arrays.
     * @desc <Greek> Λειτουργία flatten για πολυδιάστατους πίνακες.
     * 
     * @param array $array <English> The multidimensional array to flatten.
     *                     <Greek> Ο πολυδιάστατος πίνακας για να ισοπεδωθεί.
     * @return array <English> The flattened array.
     *               <Greek> Ο επίπεδος πίνακας.
     * 
     * @version 24.0.0
     */
    public function flatten(?array $array=null): array {
        $result = [];
        $array = (is_null($array)) ? $this->array : $array;
        array_walk_recursive($array, function($a) use (&$result) { $result[] = $a; });
        return $result;
    }   


    /**
     * Flips the array keys and values.
     * 
     * @desc <English>  Flips the keys and values of the internal array.
     * @desc <Greek>    Αντιστρέφει τα κλειδιά και τις τιμές του εσωτερικού πίνακα.
     * 
     * @return array <English>  The flipped array.
     *                <Greek>    Ο αντιστραμμένος πίνακας.
     * 
     * @version 24.0.0
     */
    public function flip(): array
    {
        /*
        <English>
            Flip the keys and values of the internal array.
        </English>
        <Greek>
            Αντιστρέφει τα κλειδιά και τις τιμές του εσωτερικού πίνακα.
        </Greek>
        */
        return array_flip($this->array);
    }


    /**
     * Converts binary-like format (similar to BSON) to array.
     * 
     * @desc <English>  Converts a binary-like format (similar to BSON) to an array and assigns it to the internal array.
     * @desc <Greek>    Μετατρέπει μια δυαδική μορφή (παρόμοια με BSON) σε πίνακα και την αναθέτει στον εσωτερικό πίνακα.
     * 
     * @param string $filePath <English>  The path to the binary file to convert.
     *                         <Greek>    Η διαδρομή προς το αρχείο που θα μετατραπεί.
     * @return void
     * 
     * @version 24.0.0
     */
    public function fromBSON(string $filePath): void
    {
        /*
        <English>
            Read the binary file and convert it to a JSON string.
        </English>
        <Greek>
            Διαβάζει το δυαδικό αρχείο και το μετατρέπει σε JSON συμβολοσειρά.
        </Greek>
        */
        $binary = file_get_contents($filePath);
        $json = unpack('A*', $binary)[1];

        /*
        <English>
            Convert the JSON string to an array.
        </English>
        <Greek>
            Μετατρέπει τη JSON συμβολοσειρά σε πίνακα.
        </Greek>
        */
        $this->array = json_decode($json, true);
    }


    /**
     * Converts CSV format to array.
     * 
     * @desc <English>  Converts a CSV file to an array and assigns it to the internal array.
     * @desc <Greek>    Μετατρέπει ένα αρχείο CSV σε πίνακα και το αναθέτει στον εσωτερικό πίνακα.
     * 
     * @param string $filePath <English>  The path to the CSV file to convert.
     *                         <Greek>    Η διαδρομή προς το αρχείο CSV που θα μετατραπεί.
     * @return void
     * 
     * @version 24.0.0
     */
    public function fromCSV(string $filePath): void
    {
        /*
        <English>
            Open the file for reading.
        </English>
        <Greek>
            Ανοίγει το αρχείο για ανάγνωση.
        </Greek>
        */
        $file = fopen($filePath, 'r');

        /*
        <English>
            Read the header row.
        </English>
        <Greek>
            Αναγιγνώσκει την επικεφαλίδα.
        </Greek>
        */
        $header = fgetcsv($file);

        /*
        <English>
            Initialize an empty array to store the CSV data.
        </English>
        <Greek>
            Αρχικοποιεί έναν κενό πίνακα για την αποθήκευση των δεδομένων CSV.
        </Greek>
        */
        $data = [];

        /*
        <English>
            Iterate through the remaining rows and add them to the data array.
        </English>
        <Greek>
            Διατρέχει τις υπόλοιπες γραμμές και τις προσθέτει στον πίνακα δεδομένων.
        </Greek>
        */
        while ($row = fgetcsv($file)) {
            $data[] = array_combine($header, $row);
        }

        /*
        <English>
            Close the file.
        </English>
        <Greek>
            Κλείνει το αρχείο.
        </Greek>
        */
        fclose($file);

        /*
        <English>
            Assign the data array to the internal array.
        </English>
        <Greek>
            Αναθέτει τον πίνακα δεδομένων στον εσωτερικό πίνακα.
        </Greek>
        */
        $this->array = $data;
    }


    /**
     * Converts INI file to array.
     * 
     * @desc <English>  Converts the content of an INI file to an array and assigns it to the internal array.
     * @desc <Greek>    Μετατρέπει το περιεχόμενο ενός αρχείου INI σε πίνακα και τον αναθέτει στον εσωτερικό πίνακα.
     * 
     * @param string $filePath <English>  The path to the INI file to be converted.
     *                         <Greek>    Η διαδρομή προς το αρχείο INI που θα μετατραπεί.
     * @return void
     * 
     * @version 24.0.0
     */
    public function fromINI(string $filePath): void
    {
        /*
        <English>
            Parse the INI file and assign the resulting array to the internal array.
        </English>
        <Greek>
            Αναλύει το αρχείο INI και αναθέτει τον παραγόμενο πίνακα στον εσωτερικό πίνακα.
        </Greek>
        */
        $this->array = parse_ini_file($filePath);
    }



    /**
     * Converts JSON string to array.
     * 
     * @desc <English>  Converts a JSON string to an array and assigns it to the internal array.
     * @desc <Greek>    Μετατρέπει μια JSON συμβολοσειρά σε πίνακα και τον αναθέτει στον εσωτερικό πίνακα.
     * 
     * @param string $json <English>  The JSON string to convert.
     *                     <Greek>    Η JSON συμβολοσειρά που θα μετατραπεί.
     * @return void
     * 
     * @version 24.0.0
     */
    public function fromJSON(string $json): void
    {
        /*
        <English>
            Decode the JSON string to an array and assign it to the internal array.
        </English>
        <Greek>
            Αποκωδικοποιεί τη JSON συμβολοσειρά σε πίνακα και τον αναθέτει στον εσωτερικό πίνακα.
        </Greek>
        */
        $this->array = json_decode($json, true);
    }


    /**
     * Converts an object to array.
     * 
     * @desc <English>  Converts an object to an array and assigns it to the internal array.
     * @desc <Greek>    Μετατρέπει ένα αντικείμενο σε πίνακα και τον αναθέτει στον εσωτερικό πίνακα.
     * 
     * @param object $object <English>  The object to convert.
     *                       <Greek>    Το αντικείμενο που θα μετατραπεί.
     * @return void
     * 
     * @version 24.0.0
     */
    public function fromObject(object $object): void
    {
        /*
        <English>
            Cast the object to an array and assign it to the internal array.
        </English>
        <Greek>
            Μετατρέπει το αντικείμενο σε πίνακα και τον αναθέτει στον εσωτερικό πίνακα.
        </Greek>
        */
        $this->array = (array)$object;
    }


    /**
     * Reads a PHP file that returns an array and assigns it to the internal array.
     * 
     * @desc <English>  Reads a PHP file that returns an array and assigns it to the internal array.
     * @desc <Greek>    Αναγιγνώσκει ένα αρχείο PHP που επιστρέφει έναν πίνακα και το αναθέτει στον εσωτερικό πίνακα.
     * 
     * @param string $filePath <English>  The path to the PHP file to read.
     *                         <Greek>    Η διαδρομή προς το αρχείο PHP που θα διαβαστεί.
     * @return void
     * 
     * @version 24.0.0
     */
    public function fromPHPArrayFile(string $filePath): void
    {
        /*
        <English>
            Include the PHP file and assign its return value to the internal array.
        </English>
        <Greek>
            Ενσωματώνει το αρχείο PHP και αναθέτει την τιμή επιστροφής του στον εσωτερικό πίνακα.
        </Greek>
        */
        $this->array = include $filePath;
    }


    /**
     * Reads a PHP file that defines variables and assigns them to the internal array.
     * 
     * @desc <English>  Reads a PHP file that defines variables and assigns them to the internal array.
     * @desc <Greek>    Αναγιγνώσκει ένα αρχείο PHP που ορίζει μεταβλητές και τις αναθέτει στον εσωτερικό πίνακα.
     * 
     * @param string $filePath <English>  The path to the PHP file to read.
     *                         <Greek>    Η διαδρομή προς το αρχείο PHP που θα διαβαστεί.
     * @return void
     * 
     * @version 24.0.0
     */
    public function fromPHPVariablesFile(string $filePath): void
    {
        /*
        <English>
            Include the PHP file and extract the variables.
        </English>
        <Greek>
            Ενσωματώνει το αρχείο PHP και εξάγει τις μεταβλητές.
        </Greek>
        */
        include $filePath;

        /*
        <English>
            Extract the variables to the internal array.
        </English>
        <Greek>
            Εξάγει τις μεταβλητές στον εσωτερικό πίνακα.
        </Greek>
        */
        $this->array = get_defined_vars();
    }


    /**
     * Converts plain text format to array.
     * 
     * @desc <English>  Converts a plain text file to an array and assigns it to the internal array.
     * @desc <Greek>    Μετατρέπει ένα αρχείο απλού κειμένου σε πίνακα και το αναθέτει στον εσωτερικό πίνακα.
     * 
     * @param string $filePath <English>  The path to the plain text file to convert.
     *                         <Greek>    Η διαδρομή προς το αρχείο απλού κειμένου που θα μετατραπεί.
     * @return void
     * 
     * @version 24.0.0
     */
    public function fromPlainText(string $filePath): void
    {
        /*
        <English>
            Read the plain text file and convert it to an array.
        </English>
        <Greek>
            Διαβάζει το αρχείο απλού κειμένου και το μετατρέπει σε πίνακα.
        </Greek>
        */
        $plainText = file_get_contents($filePath);
        $this->array = eval('return ' . var_export($plainText, true) . ';');
    }


    /**
     * Converts RSS feed format to array.
     * 
     * @desc <English>  Converts an RSS feed format to an array and assigns it to the internal array.
     * @desc <Greek>    Μετατρέπει μια μορφή RSS feed σε πίνακα και την αναθέτει στον εσωτερικό πίνακα.
     * 
     * @param string $rss <English>  The RSS feed string to convert.
     *                    <Greek>    Η συμβολοσειρά RSS feed που θα μετατραπεί.
     * @return void
     * 
     * @version 24.0.0
     */
    public function fromRSS(string $rss): void
    {
        /*
        <English>
            Load the RSS feed string as a SimpleXMLElement.
        </English>
        <Greek>
            Φορτώνει τη συμβολοσειρά RSS feed ως SimpleXMLElement.
        </Greek>
        */
        $rssXml = simplexml_load_string($rss, 'SimpleXMLElement', LIBXML_NOCDATA);

        /*
        <English>
            Convert the SimpleXMLElement to JSON and then to an array.
        </English>
        <Greek>
            Μετατρέπει το SimpleXMLElement σε JSON και έπειτα σε πίνακα.
        </Greek>
        */
        $this->array = json_decode(json_encode($rssXml), true)['channel']['item'];
    }


    /**
     * Converts TOML format to array.
     * 
     * @desc <English>  Converts a TOML file to an array and assigns it to the internal array.
     * @desc <Greek>    Μετατρέπει ένα αρχείο TOML σε πίνακα και το αναθέτει στον εσωτερικό πίνακα.
     * 
     * @param string $filePath <English>  The path to the TOML file to convert.
     *                         <Greek>    Η διαδρομή προς το αρχείο TOML που θα μετατραπεί.
     * @return void
     * 
     * @version 24.0.0
     */
    public function fromTOML(string $filePath): void
    {
        /*
        <English>
            Read the TOML file and convert it to an array.
        </English>
        <Greek>
            Διαβάζει το αρχείο TOML και το μετατρέπει σε πίνακα.
        </Greek>
        */
        $toml = file_get_contents($filePath);
        $this->array = $this->TOMLToArray($toml);
    }


    /**
     * Converts XML string to array.
     * 
     * @desc <English>  Converts an XML string to an array and assigns it to the internal array.
     * @desc <Greek>    Μετατρέπει μια XML συμβολοσειρά σε πίνακα και τον αναθέτει στον εσωτερικό πίνακα.
     * 
     * @param string $xml <English>  The XML string to convert.
     *                    <Greek>    Η XML συμβολοσειρά που θα μετατραπεί.
     * @return void
     * 
     * @version 24.0.0
     */
    public function fromXML(string $xml): void
    {
        /*
        <English>
            Convert the XML string to a SimpleXMLElement, then to a JSON string, and finally to an array.
        </English>
        <Greek>
            Μετατρέπει την XML συμβολοσειρά σε SimpleXMLElement, έπειτα σε JSON συμβολοσειρά, και τελικά σε πίνακα.
        </Greek>
        */
        $this->array = json_decode(json_encode(simplexml_load_string($xml)), true);
    }    


    /**
     * Converts YAML format to array.
     * 
     * @desc <English>  Converts a YAML file to an array and assigns it to the internal array.
     * @desc <Greek>    Μετατρέπει ένα αρχείο YAML σε πίνακα και το αναθέτει στον εσωτερικό πίνακα.
     * 
     * @param string $filePath <English>  The path to the YAML file to convert.
     *                         <Greek>    Η διαδρομή προς το αρχείο YAML που θα μετατραπεί.
     * @return void
     * 
     * @version 24.0.0
     */
    public function fromYAML(string $filePath): void
    {
        /*
        <English>
            Read the YAML file and convert it to an array.
        </English>
        <Greek>
            Διαβάζει το αρχείο YAML και το μετατρέπει σε πίνακα.
        </Greek>
        */
        $yaml = file_get_contents($filePath);
        $this->array = $this->YAMLToArray($yaml);
    }


    /**
     * Returns the intersection of two arrays.
     * 
     * @desc <English>  Returns the intersection of the internal array and another array.
     * @desc <Greek>    Επιστρέφει τα κοινά στοιχεία μεταξύ του εσωτερικού πίνακα και ενός άλλου πίνακα.
     * 
     * @param array $array <English>  The array to compare with.
     *                     <Greek>    Ο πίνακας με τον οποίο θα γίνει η σύγκριση.
     * @return array <English>  The array of common elements.
     *                <Greek>    Ο πίνακας των κοινών στοιχείων.
     * 
     * @version 24.0.0
     */
    public function intersect(array $array): array
    {
        /*
        <English>
            Return the intersection of the internal array and the provided array.
        </English>
        <Greek>
            Επιστρέφει τα κοινά στοιχεία μεταξύ του εσωτερικού πίνακα και του παρεχόμενου πίνακα.
        </Greek>
        */
        return array_intersect($this->array, $array);
    }


    /**
     * Returns the keys of the array.
     * 
     * @desc <English>  Returns the keys of the internal array.
     * @desc <Greek>    Επιστρέφει τα κλειδιά του εσωτερικού πίνακα.
     * 
     * @return array <English>  The keys of the array.
     *                <Greek>    Τα κλειδιά του πίνακα.
     * 
     * @version 24.0.0
     */
    public function keys(): array
    {
        /*
        <English>
            Return the keys of the internal array.
        </English>
        <Greek>
            Επιστρέφει τα κλειδιά του εσωτερικού πίνακα.
        </Greek>
        */
        return array_keys($this->array);
    }


    /**
     * Applies a callback function to each element in the array.
     * 
     * @desc <English>  Applies a user-defined callback function to each element in the internal array.
     * @desc <Greek>    Εφαρμόζει μια καθορισμένη από τον χρήστη συνάρτηση σε κάθε στοιχείο του εσωτερικού πίνακα.
     * 
     * @param callable $callback <English>  The callback function to apply.
     *                           <Greek>    Η συνάρτηση που θα εφαρμοστεί.
     * @return array <English>  The array with applied function results.
     *                <Greek>    Ο πίνακας με τα αποτελέσματα της εφαρμοσμένης συνάρτησης.
     * 
     * @version 24.0.0
     */
    public function map(callable $callback): array
    {
        /*
        <English>
            Apply the callback function to each element of the internal array.
        </English>
        <Greek>
            Εφαρμόζει τη συνάρτηση σε κάθε στοιχείο του εσωτερικού πίνακα.
        </Greek>
        */
        return array_map($callback, $this->array);
    }


    /**
     * Merges the internal array with one or more arrays.
     * 
     * @desc <English>  Merges the internal array with one or more arrays.
     * @desc <Greek>    Συγχωνεύει τον εσωτερικό πίνακα με έναν ή περισσότερους πίνακες.
     * 
     * @param array ...$arrays <English>  The arrays to merge with.
     *                         <Greek>    Οι πίνακες με τους οποίους θα γίνει η συγχώνευση.
     * @return void
     * 
     * @version 24.0.6
     */
    public function merge(array ...$arrays): void
    {
        foreach ($arrays as $array) {
            $this->array = array_merge($this->array, $array);
        }
    }


    /**
     * Recursively merges the internal array with one or more arrays.
     * 
     * @desc <English>  Recursively merges the internal array with one or more arrays.
     * @desc <Greek>    Συγχωνεύει αναδρομικά τον εσωτερικό πίνακα με έναν ή περισσότερους πίνακες.
     * 
     * @param array ...$arrays <English>  The arrays to merge with.
     *                         <Greek>    Οι πίνακες με τους οποίους θα γίνει η συγχώνευση.
     * @return void
     * 
     * @version 24.0.6
     */
    public function merge_recursive(array ...$arrays): void
    {
        foreach ($arrays as $array) {
            $this->array = array_merge_recursive($this->array, $array);
        }
    }


    /**
     * Reduces the array to a single value using a callback function.
     * 
     * @desc <English>  Reduces the internal array to a single value using a user-defined callback function.
     * @desc <Greek>    Μειώνει τον εσωτερικό πίνακα σε μία μόνο τιμή χρησιμοποιώντας μια καθορισμένη από τον χρήστη συνάρτηση.
     * 
     * @param callable $callback <English>  The callback function to use for reduction.
     *                           <Greek>    Η συνάρτηση που θα χρησιμοποιηθεί για τη μείωση.
     * @param mixed $initial <English>  The initial value for the reduction.
     *                     <Greek>    Η αρχική τιμή για τη μείωση.
     * @return mixed <English>  The reduced value.
     *               <Greek>    Η μειωμένη τιμή.
     * 
     * @version 24.0.0
     */
    public function reduce(callable $callback, $initial)
    {
        /*
        <English>
            Reduce the internal array to a single value using the callback function.
        </English>
        <Greek>
            Μειώνει τον εσωτερικό πίνακα σε μία μόνο τιμή χρησιμοποιώντας τη συνάρτηση.
        </Greek>
        */
        return array_reduce($this->array, $callback, $initial);
    }


    /**
     * Replaces the internal array with one or more arrays.
     * 
     * @desc <English>  Replaces the internal array with one or more arrays.
     * @desc <Greek>    Αντικαθιστά τον εσωτερικό πίνακα με έναν ή περισσότερους πίνακες.
     * 
     * @param array ...$arrays <English>  The arrays to replace with.
     *                         <Greek>    Οι πίνακες με τους οποίους θα γίνει η αντικατάσταση.
     * @return void
     * 
     * @version 24.0.6
     */
    public function replace(array ...$replacements): void
    {
        foreach ($replacements as $array) {
            /*
            <English>
                Override default options with provided options if any.
            </English>
            <Greek>
                Αντικαθιστά τις προκαθορισμένες επιλογές με τις παρεχόμενες επιλογές, εάν υπάρχουν.
            </Greek>
            */ 
            if (!empty($array)) {
                $this->array = array_replace($this->array, $array);
            }                 
        }
    }


    /**
     * Recursively replaces the internal array with one or more arrays.
     * 
     * @desc <English>  Recursively replaces the internal array with one or more arrays.
     * @desc <Greek>    Αντικαθιστά αναδρομικά τον εσωτερικό πίνακα με έναν ή περισσότερους πίνακες.
     * 
     * @param array ...$arrays <English>  The arrays to replace with.
     *                         <Greek>    Οι πίνακες με τους οποίους θα γίνει η αναδρομική αντικατάσταση.
     * @return void
     * 
     * @version 24.0.6
     */
    public function replace_recursive(array ...$replacements): void
    {
        foreach ($replacements as $array) {
            /*
            <English>
                Override default options with provided options if any.
            </English>
            <Greek>
                Αντικαθιστά τις προκαθορισμένες επιλογές με τις παρεχόμενες επιλογές, εάν υπάρχουν.
            </Greek>
            */ 
            if (!empty($array)) {        
                $this->array = array_replace_recursive($this->array, $array);
            }
        }
    }


    /**
     * Reverses the array.
     * 
     * @desc <English>  Reverses the internal array.
     * @desc <Greek>    Αντιστρέφει τον εσωτερικό πίνακα.
     * 
     * @return void
     * 
     * @version 24.0.0
     */
    public function reverse(): void
    {
        /*
        <English>
            Reverse the internal array.
        </English>
        <Greek>
            Αντιστρέφει τον εσωτερικό πίνακα.
        </Greek>
        */
        $this->array = array_reverse($this->array);
    }


    /**
     * Returns a slice of the array.
     * 
     * @desc <English>  Returns a slice of the internal array.
     * @desc <Greek>    Επιστρέφει ένα τμήμα του εσωτερικού πίνακα.
     * 
     * @param int $offset <English>  The offset where the slice starts.
     *                    <Greek>    Η θέση από την οποία ξεκινά το τμήμα.
     * @param int|null $length <English>  The length of the slice.
     *                         <Greek>    Το μήκος του τμήματος.
     * @return array <English>  The array slice.
     *                <Greek>    Το τμήμα του πίνακα.
     * 
     * @version 24.0.0
     */
    public function slice(int $offset, ?int $length = null, bool $preserve_keys = false): array
    {
        /*
        <English>
            Return a slice of the internal array from the specified offset and length.
        </English>
        <Greek>
            Επιστρέφει ένα τμήμα του εσωτερικού πίνακα από τη συγκεκριμένη θέση και μήκος.
        </Greek>
        */
        return array_slice($this->array, $offset, $length, $preserve_keys);
    }


    /**
     * Sorts the array in ascending order.
     * 
     * @desc <English>  Sorts the internal array in ascending order.
     * @desc <Greek>    Ταξινομεί τον εσωτερικό πίνακα σε αύξουσα σειρά.
     * 
     * @return void
     * 
     * @version 24.0.0
     */
    public function sortAsc(): void
    {
        sort($this->array);
    }


    /**
     * Sorts the array in descending order.
     * 
     * @desc <English>  Sorts the internal array in descending order.
     * @desc <Greek>    Ταξινομεί τον εσωτερικό πίνακα σε φθίνουσα σειρά.
     * 
     * @return void
     * 
     * @version 24.0.0
     */
    public function sortDesc(): void
    {
        /*
        <English>
            Sort the internal array in descending order.
        </English>
        <Greek>
            Ταξινομεί τον εσωτερικό πίνακα σε φθίνουσα σειρά.
        </Greek>
        */
        rsort($this->array);
    }


    /**
     * Converts array to a binary-like format (similar to BSON) and saves to file.
     * 
     * @desc <English>  Converts the internal array to a binary-like format (similar to BSON) and saves it to a specified file.
     * @desc <Greek>    Μετατρέπει τον εσωτερικό πίνακα σε δυαδική μορφή (παρόμοια με BSON) και τον αποθηκεύει σε ένα καθορισμένο αρχείο.
     * 
     * @param string $filePath <English>  The path to the file where the binary content will be saved.
     *                         <Greek>    Η διαδρομή προς το αρχείο όπου θα αποθηκευτεί το περιεχόμενο.
     * @return void
     * 
     * @version 24.0.0
     */
    public function toBSON(string $filePath): void
    {
        /*
        <English>
            Convert the internal array to a JSON string.
        </English>
        <Greek>
            Μετατρέπει τον εσωτερικό πίνακα σε JSON συμβολοσειρά.
        </Greek>
        */
        $json = json_encode($this->array);

        /*
        <English>
            Convert the JSON string to a binary-like format.
        </English>
        <Greek>
            Μετατρέπει τη JSON συμβολοσειρά σε δυαδική μορφή.
        </Greek>
        */
        $binary = pack('A*', $json);

        /*
        <English>
            Write the binary content to the specified file.
        </English>
        <Greek>
            Εγγράφει το δυαδικό περιεχόμενο στο καθορισμένο αρχείο.
        </Greek>
        */
        file_put_contents($filePath, $binary);
    }


    /**
     * Converts array to CSV format and saves to file.
     * 
     * @desc <English>  Converts the internal array to CSV format and saves it to a specified file.
     * @desc <Greek>    Μετατρέπει τον εσωτερικό πίνακα σε μορφή CSV και τον αποθηκεύει σε ένα καθορισμένο αρχείο.
     * 
     * @param string $filePath <English>  The path to the file where the CSV content will be saved.
     *                         <Greek>    Η διαδρομή προς το αρχείο όπου θα αποθηκευτεί το περιεχόμενο CSV.
     * @return void
     * 
     * @version 24.0.0
     */
    public function toCSV(string $filePath): void
    {
        /*
        <English>
            Open the file for writing.
        </English>
        <Greek>
            Ανοίγει το αρχείο για εγγραφή.
        </Greek>
        */
        $file = fopen($filePath, 'w');

        /*
        <English>
            Write the header row if the array contains associative arrays.
        </English>
        <Greek>
            Γράφει την επικεφαλίδα αν ο πίνακας περιέχει συσχετιστικούς πίνακες.
        </Greek>
        */
        if (isset($this->array[0]) && is_array($this->array[0])) {
            fputcsv($file, array_keys($this->array[0]));
        }

        /*
        <English>
            Iterate through the array and write each row to the CSV file.
        </English>
        <Greek>
            Διατρέχει τον πίνακα και γράφει κάθε γραμμή στο αρχείο CSV.
        </Greek>
        */
        foreach ($this->array as $row) {
            fputcsv($file, $row);
        }

        /*
        <English>
            Close the file.
        </English>
        <Greek>
            Κλείνει το αρχείο.
        </Greek>
        */
        fclose($file);
    }


    /**
     * Converts array to INI format and saves to file.
     * 
     * @desc <English>  Converts the internal array to INI format and saves it to a specified file.
     * @desc <Greek>    Μετατρέπει τον εσωτερικό πίνακα σε μορφή INI και τον αποθηκεύει σε ένα καθορισμένο αρχείο.
     * 
     * @param string $filePath <English>  The path to the file where the INI content will be saved.
     *                         <Greek>    Η διαδρομή προς το αρχείο όπου θα αποθηκευτεί το περιεχόμενο INI.
     * @return void
     * 
     * @version 24.0.0
     */
    public function toINI(string $filePath): void
    {
        /*
        <English>
            Initialize an empty string to store the INI content.
        </English>
        <Greek>
            Αρχικοποιεί μια κενή συμβολοσειρά για την αποθήκευση του περιεχομένου INI.
        </Greek>
        */
        $content = "";

        /*
        <English>
            Iterate through the array and append each key-value pair to the INI string.
        </English>
        <Greek>
            Διατρέχει τον πίνακα και προσθέτει κάθε ζευγάρι κλειδιού-τιμής στη συμβολοσειρά INI.
        </Greek>
        */
        foreach ($this->array as $key => $value) {
            $content .= "$key = $value\n";
        }

        /*
        <English>
            Write the INI string to the specified file.
        </English>
        <Greek>
            Εγγράφει τη συμβολοσειρά INI στο καθορισμένο αρχείο.
        </Greek>
        */
        file_put_contents($filePath, $content);
    }


    /**
     * Converts array to JSON string.
     * 
     * @desc <English>  Converts the internal array to a JSON string.
     * @desc <Greek>    Μετατρέπει τον εσωτερικό πίνακα σε JSON συμβολοσειρά.
     * 
     * @return string <English>  The JSON representation of the array.
     *                <Greek>    Η JSON αναπαράσταση του πίνακα.
     * 
     * @version 24.0.0
     */
    public function toJSON(): string
    {
        /*
        <English>
            Encode the internal array as a JSON string and return it.
        </English>
        <Greek>
            Κωδικοποιεί τον εσωτερικό πίνακα ως JSON συμβολοσειρά και τον επιστρέφει.
        </Greek>
        */
        return json_encode($this->array);
    }


    /**
     * Converts array to an object.
     * 
     * @desc <English>  Converts the internal array to an object.
     * @desc <Greek>    Μετατρέπει τον εσωτερικό πίνακα σε αντικείμενο.
     * 
     * @return object <English>  The object representation of the array.
     *                 <Greek>    Η αναπαράσταση του πίνακα ως αντικείμενο.
     * 
     * @version 24.0.0
     */
    public function toObject(): object
    {
        /*
        <English>
            Cast the internal array to an object and return it.
        </English>
        <Greek>
            Μετατρέπει τον εσωτερικό πίνακα σε αντικείμενο και τον επιστρέφει.
        </Greek>
        */
        return (object)$this->array;
    }


    /**
     * Creates a PHP file that returns the array.
     * 
     * @desc <English>  Creates a PHP file that returns the internal array.
     * @desc <Greek>    Δημιουργεί ένα αρχείο PHP που επιστρέφει τον εσωτερικό πίνακα.
     * 
     * @param string $filePath <English>  The path to the PHP file to create.
     *                         <Greek>    Η διαδρομή προς το αρχείο PHP που θα δημιουργηθεί.
     * @return void
     * 
     * @version 24.0.0
     */
    public function toPHPArrayFile(string $filePath): void
    {
        /*
        <English>
            Generate the PHP code to return the internal array.
        </English>
        <Greek>
            Δημιουργεί τον κώδικα PHP που επιστρέφει τον εσωτερικό πίνακα.
        </Greek>
        */
        $phpCode = "<?php\nreturn " . var_export($this->array, true) . ";\n";

        /*
        <English>
            Write the PHP code to the specified file.
        </English>
        <Greek>
            Εγγράφει τον κώδικα PHP στο καθορισμένο αρχείο.
        </Greek>
        */
        file_put_contents($filePath, $phpCode);
    }


    /**
     * Creates a PHP file that defines variables for the array elements.
     * 
     * @desc <English>  Creates a PHP file that defines variables for the internal array elements.
     * @desc <Greek>    Δημιουργεί ένα αρχείο PHP που ορίζει μεταβλητές για τα στοιχεία του εσωτερικού πίνακα.
     * 
     * @param string $filePath <English>  The path to the PHP file to create.
     *                         <Greek>    Η διαδρομή προς το αρχείο PHP που θα δημιουργηθεί.
     * @return void
     * 
     * @version 24.0.0
     */
    public function toPHPVariablesFile(string $filePath): void
    {
        /*
        <English>
            Initialize an empty string to store the PHP code.
        </English>
        <Greek>
            Αρχικοποιεί μια κενή συμβολοσειρά για την αποθήκευση του κώδικα PHP.
        </Greek>
        */
        $phpCode = "<?php\n";

        /*
        <English>
            Iterate through the array and generate PHP code for each element. If the element is an array, use var_export.
        </English>
        <Greek>
            Διατρέχει τον πίνακα και δημιουργεί τον κώδικα PHP για κάθε στοιχείο. Αν το στοιχείο είναι πίνακας, χρησιμοποιεί την var_export.
        </Greek>
        */
        foreach ($this->array as $key => $value) {
            if (is_array($value)) {
                $phpCode .= "\$$key = " . var_export($value, true) . ";\n";
            } else {
                $phpCode .= "\$$key = \"$value\";\n";
            }
        }

        /*
        <English>
            Close the PHP script tag.
        </English>
        <Greek>
            Κλείνει το tag του PHP script.
        </Greek>
        */
        $phpCode .= "?>\n";

        /*
        <English>
            Write the PHP code to the specified file.
        </English>
        <Greek>
            Εγγράφει τον κώδικα PHP στο καθορισμένο αρχείο.
        </Greek>
        */
        file_put_contents($filePath, $phpCode);
    }


    /**
     * Converts array to plain text format and saves to file.
     * 
     * @desc <English>  Converts the internal array to plain text format and saves it to a specified file.
     * @desc <Greek>    Μετατρέπει τον εσωτερικό πίνακα σε μορφή απλού κειμένου και τον αποθηκεύει σε ένα καθορισμένο αρχείο.
     * 
     * @param string $filePath <English>  The path to the file where the plain text content will be saved.
     *                         <Greek>    Η διαδρομή προς το αρχείο όπου θα αποθηκευτεί το περιεχόμενο απλού κειμένου.
     * @return void
     * 
     * @version 24.0.0
     */
    public function toPlainText(string $filePath): void
    {
        /*
        <English>
            Convert the internal array to a plain text string.
        </English>
        <Greek>
            Μετατρέπει τον εσωτερικό πίνακα σε συμβολοσειρά απλού κειμένου.
        </Greek>
        */
        $plainText = print_r($this->array, true);

        /*
        <English>
            Write the plain text string to the specified file.
        </English>
        <Greek>
            Εγγράφει τη συμβολοσειρά απλού κειμένου στο καθορισμένο αρχείο.
        </Greek>
        */
        file_put_contents($filePath, $plainText);
    }


    /**
     * Converts array to RSS feed format.
     * 
     * @desc <English>  Converts the internal array to RSS feed format.
     * @desc <Greek>    Μετατρέπει τον εσωτερικό πίνακα σε μορφή RSS feed.
     * 
     * @return string <English>  The RSS feed representation of the array.
     *                <Greek>    Η αναπαράσταση του πίνακα σε μορφή RSS feed.
     * 
     * @version 24.0.0
     */
    public function toRSS(): string
    {
        /*
        <English>
            Initialize the RSS feed string with the root elements.
        </English>
        <Greek>
            Αρχικοποιεί τη συμβολοσειρά RSS feed με τα ριζικά στοιχεία.
        </Greek>
        */
        $rssFeed = '<?xml version="1.0" encoding="UTF-8"?><rss version="2.0"><channel>';

        /*
        <English>
            Iterate through the array and append each item as an RSS item element.
        </English>
        <Greek>
            Διατρέχει τον πίνακα και προσθέτει κάθε στοιχείο ως στοιχείο RSS item.
        </Greek>
        */
        foreach ($this->array as $item) {
            $rssFeed .= '<item>';
            foreach ($item as $key => $value) {
                $rssFeed .= "<$key><![CDATA[$value]]></$key>";
            }
            $rssFeed .= '</item>';
        }

        /*
        <English>
            Close the RSS feed elements.
        </English>
        <Greek>
            Κλείνει τα στοιχεία του RSS feed.
        </Greek>
        */
        $rssFeed .= '</channel></rss>';

        /*
        <English>
            Return the RSS feed string.
        </English>
        <Greek>
            Επιστρέφει τη συμβολοσειρά RSS feed.
        </Greek>
        */
        return $rssFeed;
    }


    /**
     * Converts array to TOML format and saves to file.
     * 
     * @desc <English>  Converts the internal array to TOML format and saves it to a specified file.
     * @desc <Greek>    Μετατρέπει τον εσωτερικό πίνακα σε μορφή TOML και τον αποθηκεύει σε ένα καθορισμένο αρχείο.
     * 
     * @param string $filePath <English>  The path to the file where the TOML content will be saved.
     *                         <Greek>    Η διαδρομή προς το αρχείο όπου θα αποθηκευτεί το περιεχόμενο TOML.
     * @return void
     * 
     * @version 24.0.0
     */
    public function toTOML(string $filePath): void
    {
        /*
        <English>
            Convert the internal array to a TOML string.
        </English>
        <Greek>
            Μετατρέπει τον εσωτερικό πίνακα σε TOML συμβολοσειρά.
        </Greek>
        */
        $toml = $this->arrayToTOML($this->array);

        /*
        <English>
            Write the TOML string to the specified file.
        </English>
        <Greek>
            Εγγράφει τη TOML συμβολοσειρά στο καθορισμένο αρχείο.
        </Greek>
        */
        file_put_contents($filePath, $toml);
    }


    /**
     * Converts array to XML string.
     * 
     * @desc <English>  Converts the internal array to an XML string.
     * @desc <Greek>    Μετατρέπει τον εσωτερικό πίνακα σε XML συμβολοσειρά.
     * 
     * @return string <English>  The XML representation of the array.
     *                <Greek>    Η XML αναπαράσταση του πίνακα.
     * 
     * @version 24.0.0
     */
    public function toXML(): string
    {
        /*
        <English>
            Initialize a new SimpleXMLElement with a root element.
        </English>
        <Greek>
            Αρχικοποιεί ένα νέο SimpleXMLElement με ένα ριζικό στοιχείο.
        </Greek>
        */
        $xml = new SimpleXMLElement('<root/>');

        /*
        <English>
            Recursively walk through the array and add each element as a child to the XML object.
        </English>
        <Greek>
            Διατρέχει αναδρομικά τον πίνακα και προσθέτει κάθε στοιχείο ως παιδί στο αντικείμενο XML.
        </Greek>
        */
        array_walk_recursive($this->array, array ($xml, 'addChild'));

        /*
        <English>
            Return the XML as a string.
        </English>
        <Greek>
            Επιστρέφει το XML ως συμβολοσειρά.
        </Greek>
        */
        return $xml->asXML();
    }


    /**
     * Converts array to YAML format and saves to file.
     * 
     * @desc <English>  Converts the internal array to YAML format and saves it to a specified file.
     * @desc <Greek>    Μετατρέπει τον εσωτερικό πίνακα σε μορφή YAML και τον αποθηκεύει σε ένα καθορισμένο αρχείο.
     * 
     * @param string $filePath <English>  The path to the file where the YAML content will be saved.
     *                         <Greek>    Η διαδρομή προς το αρχείο όπου θα αποθηκευτεί το περιεχόμενο YAML.
     * @return void
     * 
     * @version 24.0.0
     */
    public function toYAML(string $filePath): void
    {
        /*
        <English>
            Convert the internal array to a YAML string.
        </English>
        <Greek>
            Μετατρέπει τον εσωτερικό πίνακα σε YAML συμβολοσειρά.
        </Greek>
        */
        $yaml = $this->arrayToYAML($this->array);

        /*
        <English>
            Write the YAML string to the specified file.
        </English>
        <Greek>
            Εγγράφει τη YAML συμβολοσειρά στο καθορισμένο αρχείο.
        </Greek>
        */
        file_put_contents($filePath, $yaml);
    }


    /**
     * Removes duplicate values from the array.
     * 
     * @desc <English>  Removes duplicate values from the internal array.
     * @desc <Greek>    Αφαιρεί διπλότυπα στοιχεία από τον εσωτερικό πίνακα.
     * 
     * @return array <English>  The array with unique values.
     *                <Greek>    Ο πίνακας με μοναδικές τιμές.
     * 
     * @version 24.0.0
     */
    public function unique(): array
    {
        /*
        <English>
            Remove duplicate values from the internal array.
        </English>
        <Greek>
            Αφαιρεί τα διπλότυπα στοιχεία από τον εσωτερικό πίνακα.
        </Greek>
        */
        return array_unique($this->array);
    }


    /**
     * Validates the array for specific data types.
     * 
     * @desc <English>  Validates the internal array for specific data types.
     * @desc <Greek>    Επαληθεύει τον εσωτερικό πίνακα για συγκεκριμένους τύπους δεδομένων.
     * 
     * @param string $type <English>  The data type to validate against (e.g., 'integer', 'string').
     *                     <Greek>    Ο τύπος δεδομένων για την επαλήθευση (π.χ., 'integer', 'string').
     * @return bool <English>  Returns true if all elements match the specified data type, otherwise false.
     *               <Greek>    Επιστρέφει true αν όλα τα στοιχεία ταιριάζουν με τον συγκεκριμένο τύπο δεδομένων, αλλιώς false.
     * 
     * @version 24.0.0
     */
    public function validateDataType(string $type): bool
    {
        /*
        <English>
            Iterate through the array and check for the specified data type.
        </English>
        <Greek>
            Διατρέχει τον πίνακα και ελέγχει για τον συγκεκριμένο τύπο δεδομένων.
        </Greek>
        */
        foreach ($this->array as $value) {
            if (gettype($value) !== $type) {
                return false;
            }
        }
        return true;
    }


    /**
     * Validates the array for empty elements.
     * 
     * @desc <English>  Validates the internal array for empty elements.
     * @desc <Greek>    Επαληθεύει τον εσωτερικό πίνακα για κενά στοιχεία.
     * 
     * @return bool <English>  Returns true if there are no empty elements, otherwise false.
     *               <Greek>    Επιστρέφει true αν δεν υπάρχουν κενά στοιχεία, αλλιώς false.
     * 
     * @version 24.0.0
     */
    public function validateNotEmpty(): bool
    {
        /*
        <English>
            Iterate through the array and check for empty elements.
        </English>
        <Greek>
            Διατρέχει τον πίνακα και ελέγχει για κενά στοιχεία.
        </Greek>
        */
        foreach ($this->array as $value) {
            if (empty($value)) {
                return false;
            }
        }
        return true;
    }


    /**
     * Validates the array for elements matching a specific pattern.
     * 
     * @desc <English>  Validates the internal array for elements matching a specific pattern.
     * @desc <Greek>    Επαληθεύει τον εσωτερικό πίνακα για στοιχεία που ταιριάζουν με ένα συγκεκριμένο μοτίβο.
     * 
     * @param string $pattern <English>  The regular expression pattern to match.
     *                        <Greek>    Το μοτίβο κανονικής έκφρασης για επαλήθευση.
     * @return bool <English>  Returns true if all elements match the specified pattern, otherwise false.
     *               <Greek>    Επιστρέφει true αν όλα τα στοιχεία ταιριάζουν με το καθορισμένο μοτίβο, αλλιώς false.
     * 
     * @version 24.0.0
     */
    public function validatePattern(string $pattern): bool
    {
        /*
        <English>
            Check if all elements match the specified pattern.
        </English>
        <Greek>
            Ελέγχει αν όλα τα στοιχεία ταιριάζουν με το καθορισμένο μοτίβο.
        </Greek>
        */
        foreach ($this->array as $value) {
            if (!preg_match($pattern, $value)) {
                return false;
            }
        }
        return true;
    }


    /**
     * Validates the array for elements within a specific range.
     * 
     * @desc <English>  Validates the internal array for elements within a specific range.
     * @desc <Greek>    Επαληθεύει τον εσωτερικό πίνακα για στοιχεία εντός συγκεκριμένου εύρους.
     * 
     * @param float $min <English>  The minimum value of the range.
     *                   <Greek>    Η ελάχιστη τιμή του εύρους.
     * @param float $max <English>  The maximum value of the range.
     *                   <Greek>    Η μέγιστη τιμή του εύρους.
     * @return bool <English>  Returns true if all elements are within the specified range, otherwise false.
     *               <Greek>    Επιστρέφει true αν όλα τα στοιχεία είναι εντός του καθορισμένου εύρους, αλλιώς false.
     * 
     * @version 24.0.0
     */
    public function validateRange(float $min, float $max): bool
    {
        /*
        <English>
            Check if all elements are within the specified range.
        </English>
        <Greek>
            Ελέγχει αν όλα τα στοιχεία είναι εντός του καθορισμένου εύρους.
        </Greek>
        */
        foreach ($this->array as $value) {
            if ($value < $min || $value > $max) {
                return false;
            }
        }
        return true;
    }


    /**
     * Validates the array for unique elements.
     * 
     * @desc <English>  Validates the internal array for unique elements.
     * @desc <Greek>    Επαληθεύει τον εσωτερικό πίνακα για μοναδικά στοιχεία.
     * 
     * @return bool <English>  Returns true if all elements are unique, otherwise false.
     *               <Greek>    Επιστρέφει true αν όλα τα στοιχεία είναι μοναδικά, αλλιώς false.
     * 
     * @version 24.0.0
     */
    public function validateUnique(): bool
    {
        /*
        <English>
            Check if all elements are unique.
        </English>
        <Greek>
            Ελέγχει αν όλα τα στοιχεία είναι μοναδικά.
        </Greek>
        */
        return count($this->array) === count(array_unique($this->array));
    }


    /**
     * Returns the values of the array.
     * 
     * @desc <English>  Returns the values of the internal array.
     * @desc <Greek>    Επιστρέφει τις τιμές του εσωτερικού πίνακα.
     * 
     * @return array <English>  The values of the array.
     *                <Greek>    Οι τιμές του πίνακα.
     * 
     * @version 24.0.0
     */
    public function values(): array
    {
        /*
        <English>
            Return the values of the internal array.
        </English>
        <Greek>
            Επιστρέφει τις τιμές του εσωτερικού πίνακα.
        </Greek>
        */
        return array_values($this->array);
    }


    /**
     * Applies a callback function to each element in the array recursively.
     * 
     * @desc <English>  Applies a user-defined callback function to each element in the internal array recursively.
     * @desc <Greek>    Εφαρμόζει μια καθορισμένη από τον χρήστη συνάρτηση σε κάθε στοιχείο του εσωτερικού πίνακα αναδρομικά.
     * 
     * @param callable $callback <English>  The callback function to apply.
     *                           <Greek>    Η συνάρτηση που θα εφαρμοστεί.
     * @return bool <English>  Returns true on success or false on failure.
     *               <Greek>    Επιστρέφει true σε περίπτωση επιτυχίας ή false σε περίπτωση αποτυχίας.
     * 
     * @version 24.0.0
     */
    public function walkRecursive(callable $callback): bool
    {
        /*
        <English>
            Apply the callback function recursively to each element of the internal array.
        </English>
        <Greek>
            Εφαρμόζει τη συνάρτηση αναδρομικά σε κάθε στοιχείο του εσωτερικού πίνακα.
        </Greek>
        */
        return array_walk_recursive($this->array, $callback);
    } 



    /***********************************************************************
     * PRIVATE METHODS
     **********************************************************************/
     /**
      * Summary of arrayToTOML
      * @param array $array
      * @param int $level
      * @return string
      *
      * @version 24.0.0
      */
     private function arrayToTOML(array $array, int $level = 0): string
    {
        $toml = '';
        $indent = str_repeat('  ', $level);

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $toml .= "[$key]\n" . $this->arrayToTOML($value, $level + 1);
            } else {
                $toml .= "$indent$key = \"$value\"\n";
            }
        }

        return $toml;
    }


    /**
     * Summary of TOMLToArray
     * @param string $toml
     * @return array
     * 
     * @version 24.0.0
     */
    private function TOMLToArray(string $toml): array
    {
        $lines = explode("\n", $toml);
        $result = [];
        $currentSection = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') continue;

            if ($line[0] === '[' && $line[-1] === ']') {
                $currentSection = trim($line, '[]');
                $result[$currentSection] = [];
            } else {
                list($key, $value) = explode('=', $line, 2);
                $value = trim($value, " \"");
                if ($currentSection) {
                    $result[$currentSection][trim($key)] = $value;
                } else {
                    $result[trim($key)] = $value;
                }
            }
        }

        return $result;
    }


    /**
     * Recursively converts an array to a YAML string.
     * 
     * @desc <English>  Recursively converts an array to a YAML string.
     * @desc <Greek>    Μετατρέπει αναδρομικά έναν πίνακα σε YAML συμβολοσειρά.
     * 
     * @param array $array <English>  The array to convert.
     *                     <Greek>    Ο πίνακας που θα μετατραπεί.
     * @param int $level <English>  The current depth level (used for indentation).
     *                  <Greek>    Το τρέχον βάθος (χρησιμοποιείται για εσοχή).
     * @return string <English>  The YAML string.
     *                <Greek>    Η YAML συμβολοσειρά.
     * 
     * @version 24.0.0
     */
    private function arrayToYAML(array $array, int $level = 0): string
    {
        $yaml = '';
        $indent = str_repeat('  ', $level);

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $yaml .= "$indent$key:\n" . $this->arrayToYAML($value, $level + 1);
            } else {
                $yaml .= "$indent$key: $value\n";
            }
        }

        return $yaml;
    }


    /**
     * Recursively converts a YAML string to an array.
     * 
     * @desc <English>  Recursively converts a YAML string to an array.
     * @desc <Greek>    Μετατρέπει αναδρομικά μια YAML συμβολοσειρά σε πίνακα.
     * 
     * @param string $yaml <English>  The YAML string to convert.
     *                     <Greek>    Η YAML συμβολοσειρά που θα μετατραπεί.
     * @return array <English>  The resulting array.
     *                <Greek>    Ο παραγόμενος πίνακας.
     * 
     * @version 24.0.0
     */
    private function YAMLToArray(string $yaml): array
    {
        $lines = explode("\n", $yaml);
        $result = [];
        $path = [];

        foreach ($lines as $line) {
            if (trim($line) === '') {
                continue;
            }

            $indent = strlen($line) - strlen(ltrim($line));
            $keyValue = explode(': ', trim($line), 2);
            $key = $keyValue[0];
            $value = $keyValue[1] ?? null;

            $level = $indent / 2;
            $path[$level] = $key;

            $temp = &$result;

            for ($i = 0; $i <= $level; $i++) {
                $temp = &$temp[$path[$i]];
            }

            if (!is_null($value)) {
                $temp = $value;
            }
        }

        return $result;
    }    
    /******************************************************************************
     * END OF PRIVATE METHODS OF TArrayHandler
     *****************************************************************************/

}
/******************************************************************************
 * @endcode TArrayHandler
 *****************************************************************************/


