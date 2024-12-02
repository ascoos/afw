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
 * @package            	: ASCOOS FRAMEWORK (AFW)
 * @subpackage         	: Extra Array Handles for Mongo BSON File
 * @source             	: [ASCOOS FRAMEWORK (AFW)]/extras/arrays/TArrayMongoBSONHandler.php
 * @fileNo             	: 
 * @version            	: 24.0.2
 * @created            	: 2024-07-01 20:00:00 UTC+3 
 * @updated            	: 2024-12-01 07:00:00 UTC+3 
 * @author             	: Drogidis Christos
 * @authorSite         	: www.alexsoft.gr
 * @license 			: AGL-F
 * 
 * @since PHP 8.2.0
 */
namespace ASCOOS\FRAMEWORK\Arrays\Extras\MongoBSON;

use ASCOOS\FRAMEWORK\Kernel\Arrays\TArrayHandler;
use MongoDB\BSON\Document;




/******************************************************************************
 * @startcode TArrayMongoBSONHandler
 *****************************************************************************/
/**
 * @class   TArrayMongoBSONHandler
 * @extends TArrayHandler
 * 
 * @summary Handles MongoDB BSON format arrays.
 * 
 * [ METHODS ]
 * @method void toMongoBSON(string $filePath)         Converts array to BSON format and saves to file.
 * @method void fromMongoBSON(string $filePath)       Converts BSON format to array.
 * 
 * [ INHERITANCE METHODS ]
 * @method bool empty(array $array)                                        Checks if an array is empty.
 * @method string toJSON()                                                 Converts array to JSON string.
 * @method void fromJSON(string $json)                                     Converts JSON string to array.
 * @method string toXML()                                                  Converts array to XML string.
 * @method void fromXML(string $xml)                                       Converts XML string to array.
 * @method object toObject()                                               Converts array to an object.
 * @method void fromObject(object $object)                                 Converts an object to array.
 * @method void toINI(string $filePath)                                    Converts array to INI format and saves to file.
 * @method void fromINI(string $filePath)                                  Converts INI file to array.
 * @method string toRSS()                                                  Converts array to RSS feed format.
 * @method void fromRSS(string $rss)                                       Converts RSS feed format to array.
 * @method void toPHPArrayFile(string $filePath)                           Creates a PHP file that returns the array.
 * @method void fromPHPArrayFile(string $filePath)                         Reads a PHP file that returns an array and assigns it to the internal array.
 * @method void toPHPVariablesFile(string $filePath)                       Creates a PHP file that defines variables for the array elements.
 * @method void fromPHPVariablesFile(string $filePath)                     Reads a PHP file that defines variables and assigns them to the internal array.
 * @method void toCSV(string $filePath)                                    Converts array to CSV format and saves to file.
 * @method void fromCSV(string $filePath)                                  Converts CSV format to array.
 * @method void toYAML(string $filePath)                                   Converts array to YAML format and saves to file.
 * @method void fromYAML(string $filePath)                                 Converts YAML format to array.
 * @method void toBSON(string $filePath)                                   Converts array to a binary-like format and saves to file.
 * @method void fromBSON(string $filePath)                                 Converts binary-like format to array.
 * @method void toTOML(string $filePath)                                   Converts array to TOML format and saves to file.
 * @method void fromTOML(string $filePath)                                 Converts TOML format to array.
 * @method void toPlainText(string $filePath)                              Converts array to plain text format and saves to file.
 * @method void fromPlainText(string $filePath)                            Converts plain text format to array.
 * @method array filter(callable $callback)                                Filters the array based on a callback function.
 * @method void sortAsc()                                                  Sorts the array in ascending order.
 * @method void sortDesc()                                                 Sorts the array in descending order.
 * @method void reverse()                                                  Reverses the array.
 * @method bool find(mixed $element)                                       Finds an element in the array.
 * @method array map(callable $callback)                                   Applies a callback function to each element in the array.
 * @method mixed reduce(callable $callback, mixed $initial)                Reduces the array to a single value using a callback function.
 * @method array unique()                                                  Removes duplicate values from the array.
 * @method array keys()                                                    Returns the keys of the array.
 * @method array values()                                                  Returns the values of the array.
 * @method array slice(int $offset, int $length = null)                    Returns a slice of the array.
 * @method array chunk(int $size)                                          Splits the array into chunks.
 * @method array combine(array $keys)                                      Combines two arrays into an associative array.
 * @method array diff(array $array)                                        Returns the difference between two arrays.
 * @method array intersect(array $array)                                   Returns the intersection of two arrays.
 * @method array flip()                                                    Flips the array keys and values.
 * @method bool walkRecursive(callable $callback)                          Applies a callback function to each element in the array recursively.
 * @method bool validateNotEmpty()                                         Validates the array for empty elements.
 * @method bool validateDataType(string $type)                             Validates the array for specific data types.
 * @method bool validateUnique()                                           Validates the array for unique elements.
 * @method bool validateRange(float $min, float $max)                      Validates the array for elements within a specific range.
 * @method bool validatePattern(string $pattern)                           Validates the array for elements matching a specific pattern.
 * @method void cleanEmptyElements()                                       Cleans the array by removing empty elements.
 * @method void cleanInvalidDataTypes(string $type)                        Cleans the array by removing elements of invalid data types.
 * @method void cleanSpecialCharacters(string $pattern = '/[^A-Za-z0-9]/') Cleans the array by removing special characters from elements.
 * @method void cleanWhitespace()                                          Cleans the array by trimming whitespace from elements.
 * @method void cleanHTMLTags()                                            Cleans the array by removing HTML tags from elements.
 * @method void cleanValidURLs()                                           Validates and cleans the array for valid URLs.
 */
class TArrayMongoBSONHandler extends TArrayHandler
{
 
    /**
     * Converts array to BSON format and saves to file.
     * 
     * @desc <English>  Converts the internal array to BSON format and saves it to a specified file.
     * @desc <Greek>    Μετατρέπει τον εσωτερικό πίνακα σε μορφή BSON και τον αποθηκεύει σε ένα καθορισμένο αρχείο.
     * 
     * @param string $filePath <English>  The path to the file where the BSON content will be saved.
     *                         <Greek>    Η διαδρομή προς το αρχείο όπου θα αποθηκευτεί το περιεχόμενο BSON.
     * @return void
     */
    public function toMongoBSON(string $filePath): void
    {
        /*
        <English>
            Convert the internal array to BSON.
        </English>
        <Greek>
            Μετατρέπει τον εσωτερικό πίνακα σε BSON.
        </Greek>
        */
        $bson = MongoDB\BSON\Document::fromPHP($this->array);
 
        /*
        <English>
            Write the BSON to the specified file.
        </English>
        <Greek>
            Εγγράφει το BSON στο καθορισμένο αρχείο.
        </Greek>
        */
        file_put_contents($filePath, $bson);
    }
 
    /**
     * Converts BSON format to array.
     * 
     * @desc <English>  Converts a BSON file to an array and assigns it to the internal array.
     * @desc <Greek>    Μετατρέπει ένα αρχείο BSON σε πίνακα και το αναθέτει στον εσωτερικό πίνακα.
     * 
     * @param string $filePath <English>  The path to the BSON file to convert.
     *                         <Greek>    Η διαδρομή προς το αρχείο BSON που θα μετατραπεί.
     * @return void
     */
    public function fromMongoBSON(string $filePath): void
    {
        /*
        <English>
            Read the BSON file and convert it to an array.
        </English>
        <Greek>
            Διαβάζει το αρχείο BSON και το μετατρέπει σε πίνακα.
        </Greek>
        */
        $bson = file_get_contents($filePath);
        $this->array = MongoDB\BSON\Document::toPHP($bson);
    }
}
/******************************************************************************
 * @endcode TArrayMongoBSONHandler
 *****************************************************************************/

?>