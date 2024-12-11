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
 * @subpackage         	: Handles advanced data analysis for arrays.
 * @source             	: afw/extras/arrays/TArrayAnalysisHandler.php
 * @file             	: 
 * @version            	: 24.0.5
 * @created            	: 2024-07-01 20:00:00 UTC+3 
 * @updated            	: 2024-12-10 07:00:00 UTC+3 
 * @author             	: Drogidis Christos
 * @authorSite         	: www.alexsoft.gr
 * @license 			: AGL-F
 * 
 * @since PHP 8.2.0
 */
namespace ASCOOS\FRAMEWORK\Extras\Arrays\Analysis;

defined ("ALEXSOFT_RUN_CMS") or die("Prohibition of Access.");
defined ("ASCOOS_FRAMEWORK_RUN") or die("Prohibition of Access.");


use ASCOOS\FRAMEWORK\Kernel\Arrays\TArrayHandler;

/******************************************************************************
 * @startcode TArrayAnalysisHandler
 *****************************************************************************/
/**
 * @class   TArrayAnalysisHandler
 * @extends TArrayHandler
 * 
 * @summary Handles advanced data analysis for arrays.
 *  
 * [ METHODS ]
 * @method void __construct(array $array = [], array $properties = [])     The constructor method for the class.
 * @method array categorizeByThreshold(float $threshold)                   Categorizes the array based on a threshold.
 * @method float correlationCoefficient(array $otherArray)                 Calculates the Pearson correlation coefficient between two arrays.
 * @method float covariance(array $otherArray)                             Calculates the covariance between the internal array and another array.
 * @method float entropy()                                                 Calculates the entropy of the array.
 * @method mixed findMax()                                                 Finds the maximum value in the array.
 * @method mixed findMin()                                                 Finds the minimum value in the array.
 * @method array frequencyDistribution()                                   Calculates the frequency distribution of the array.
 * @method array generateStatisticsReport()                                Automatically generates a report of basic statistical measures for the array.
 * @method array groupBy(callable $callback)                               Groups the array elements based on a callback function.
 * @method float mean()                                                    Calculates the mean (average) of the array.
 * @method float median()                                                  Calculates the median of the array.
 * @method mixed mode()                                                    Calculates the mode of the array.
 * @method array movingAverage(int $windowSize)                            Calculates the moving average of the array.
 * @method float range()                                                   Calculates the range of the array.
 * @method float standardDeviation()                                       Calculates the standard deviation of the array.
 * @method float sumOfSquares()                                            Calculates the sum of squares of the array elements.
 * @method float variance()                                                Calculates the variance of the array.
 * @method float weightedAverage(array $weights)                           Calculates the weighted average of the array.
 *  
 * [ INHERITANCE PROPERTIES ]
 * @property array $array                                                  Array to store data.
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
 * @method string __toString()                                              Returns a string containing the name of this class.
 * @method bool getClassDeprecated()                                        Returns true if class is deprecated, otherwise false.
 * @method int getClassVersion()                                            We get the version of the class.
 * @method array getProperties()                                            Returns the table of class properties.
 * @method mixed getProperty(string $property)                              Returns the content of the requested property.
 * @method ?array getPublicProperties()                                     Returns an array of the public properties of the class.
 * @method int|false getVersion(string $property)                           Get the version as an integer.
 * @method string|false getVersionStr(string $property)                     Get the version as a formatted string.
 * @method bool isExecutable(int $currentVersion, int $currentPHPVersion)   Checks whether the current version of the class is executable according to the minimum and maximum versions you specify.
 * @method void setProjectVersion(int|string $version = -1)                 Sets the project version.
 * @method void setProperties(array $properties)                            Set the properties of the class.
 * @method void setProperty(string $property, mixed $value)                 Set a single property of the class.
 * @method bool Free(object $object)                                        Frees the memory of the Object or its clone.
 * @method bool FreeProperties(object $object)                              Delete and Frees up memory for all class properties.
 */
class TArrayAnalysisHandler extends TArrayHandler
{
    /**
     * Constructor.
     * 
     * @desc <English>  Initialize the class. It must be called by the offspring if the classes are initialized.
     * @desc <Greek>    Αρχικοποιεί την κλάση. Πρέπει να καλείται από τα παραγόμενα αν οι κλάσεις αρχικοποιούνται.
     * 
     * @param array $properties   <English>  An associative array of properties to initialize the class with.
     *                            <Greek>    Ένας συσχετιστικός πίνακας ιδιοτήτων για την αρχικοποίηση της κλάσης.
     */   
    public function __construct(array $array = [], array $properties = [])
    {
        parent::__construct($array, $properties);
    }


    /**
     * Categorizes the array based on a threshold.
     * 
     * @desc <English>  Categorizes the internal array based on a threshold.
     * @desc <Greek>    Κατηγοριοποιεί τον εσωτερικό πίνακα βάσει ενός ορίου.
     * 
     * @param float $threshold <English>  The threshold to use for categorization.
     *                         <Greek>    Το όριο για την κατηγοριοποίηση.
     * @return array <English>  The categorized array.
     *                <Greek>    Ο κατηγοριοποιημένος πίνακας.
     */
    public function categorizeByThreshold(float $threshold): array
    {
        /*
        <English>
            Categorize elements as 'high' or 'low' based on the threshold.
        </English>
        <Greek>
            Κατηγοριοποιεί τα στοιχεία ως 'υψηλά' ή 'χαμηλά' βάσει του ορίου.
        </Greek>
        */
        return array_map(fn($value) => $value >= $threshold ? 'high' : 'low', $this->array);
    }


    /**
     * Calculates the Pearson correlation coefficient between two arrays.
     * 
     * @desc <English>  Calculates the Pearson correlation coefficient between the internal array and another array.
     * @desc <Greek>    Υπολογίζει τον συντελεστή συσχέτισης Pearson μεταξύ του εσωτερικού πίνακα και ενός άλλου πίνακα.
     * 
     * @param array $otherArray <English>  The other array to calculate the correlation with.
     *                          <Greek>    Ο άλλος πίνακας για τον υπολογισμό της συσχέτισης.
     * @return float <English>  The Pearson correlation coefficient.
     *               <Greek>    Ο συντελεστής συσχέτισης Pearson.
     */
    public function correlationCoefficient(array $otherArray): float
    {
        /*
        <English>
            Calculate the means of both arrays.
        </English>
        <Greek>
            Υπολογίζει τους μέσους όρους και των δύο πινάκων.
        </Greek>
        */
        $meanX = $this->mean();
        $meanY = (new self($otherArray))->mean();

        /*
        <English>
            Calculate the numerator and the denominators for the Pearson correlation coefficient.
        </English>
        <Greek>
            Υπολογίζει τον αριθμητή και τους παρονομαστές για τον συντελεστή συσχέτισης Pearson.
        </Greek>
        */
        $numerator = 0;
        $denominatorX = 0;
        $denominatorY = 0;

        for ($i = 0; $i < count($this->array); $i++) {
            $diffX = $this->array[$i] - $meanX;
            $diffY = $otherArray[$i] - $meanY;
            $numerator += $diffX * $diffY;
            $denominatorX += pow($diffX, 2);
            $denominatorY += pow($diffY, 2);
        }

        /*
        <English>
            Calculate the Pearson correlation coefficient.
        </English>
        <Greek>
            Υπολογίζει τον συντελεστή συσχέτισης Pearson.
        </Greek>
        */
        return $numerator / sqrt($denominatorX * $denominatorY);
    }  


    /**
     * Calculates the covariance between the internal array and another array.
     * 
     * @desc <English>  Calculates the covariance between the internal array and another array.
     * @desc <Greek>    Υπολογίζει τη συνδιακύμανση μεταξύ του εσωτερικού πίνακα και ενός άλλου πίνακα.
     * 
     * @param array $otherArray <English>  The other array to calculate the covariance with.
     *                          <Greek>    Ο άλλος πίνακας για τον υπολογισμό της συνδιακύμανσης.
     * @return float <English>  The covariance.
     *               <Greek>    Η συνδιακύμανση.
     */
    public function covariance(array $otherArray): float
    {
        $meanX = $this->mean();
        $meanY = (new self($otherArray))->mean();

        $covariance = 0;
        for ($i = 0; $i < count($this->array); $i++) {
            $covariance += ($this->array[$i] - $meanX) * ($otherArray[$i] - $meanY);
        }

        return $covariance / count($this->array);
    }


    /**
     * Calculates the entropy of the array.
     * 
     * @desc <English>  Calculates the entropy of the internal array, which measures the uncertainty or diversity of the data.
     * @desc <Greek>    Υπολογίζει την εντροπία του εσωτερικού πίνακα, η οποία μετρά την αβεβαιότητα ή την ποικιλία των δεδομένων.
     * 
     * @return float <English>  The entropy of the array.
     *               <Greek>    Η εντροπία του πίνακα.
     */
    public function entropy(): float
    {
        $frequency = array_count_values($this->array);
        $total = count($this->array);
        $entropy = 0;

        foreach ($frequency as $count) {
            $probability = $count / $total;
            $entropy -= $probability * log($probability, 2);
        }

        return $entropy;
    }


    /**
     * Finds the maximum value in the array.
     * 
     * @desc <English>  Finds the maximum value in the internal array.
     * @desc <Greek>    Βρίσκει τη μέγιστη τιμή στον εσωτερικό πίνακα.
     * 
     * @return mixed <English>  The maximum value in the array.
     *               <Greek>    Η μέγιστη τιμή στον πίνακα.
     */
    public function findMax(): mixed
    {
        /*
        <English>
            Find and return the maximum value in the array.
        </English>
        <Greek>
            Βρίσκει και επιστρέφει τη μέγιστη τιμή στον πίνακα.
        </Greek>
        */
        return max($this->array);
    }


    /**
     * Finds the minimum value in the array.
     * 
     * @desc <English>  Finds the minimum value in the internal array.
     * @desc <Greek>    Βρίσκει τη ελάχιστη τιμή στον εσωτερικό πίνακα.
     * 
     * @return mixed <English>  The minimum value in the array.
     *               <Greek>    Η ελάχιστη τιμή στον πίνακα.
     */
    public function findMin(): mixed
    {
        /*
        <English>
            Find and return the minimum value in the array.
        </English>
        <Greek>
            Βρίσκει και επιστρέφει τη ελάχιστη τιμή στον πίνακα.
        </Greek>
        */
        return min($this->array);
    }


    /**
     * Calculates the frequency distribution of the array.
     * 
     * @desc <English>  Calculates the frequency distribution of the internal array.
     * @desc <Greek>    Υπολογίζει τη συχνότητα κατανομής του εσωτερικού πίνακα.
     * 
     * @return array <English>  The frequency distribution of the array.
     *                <Greek>    Η συχνότητα κατανομής του πίνακα.
     */
    public function frequencyDistribution(): array
    {
        return array_count_values($this->array);
    }


    /**
     * Automatically generates a report of basic statistical measures for the array.
     * 
     * @desc <English>  Automatically generates a report of basic statistical measures for the internal array.
     * @desc <Greek>    Αυτόματα δημιουργεί μια αναφορά βασικών στατιστικών μέτρων για τον εσωτερικό πίνακα.
     * 
     * @return array <English>  A report of basic statistical measures.
     *                <Greek>    Μια αναφορά βασικών στατιστικών μέτρων.
     */
    public function generateStatisticsReport(): array
    {
        return [
            'entropy' => $this->entropy(),
            'mean' => $this->mean(),
            'median' => $this->median(),
            'mode' => $this->mode(),
            'range' => $this->range(),
            'standard_deviation' => $this->standardDeviation(),
            'sum_of_squares' => $this->sumOfSquares(),
            'variance' => $this->variance()
        ];
    } 


    /**
     * Groups the array elements based on a callback function.
     * 
     * @desc <English>  Groups the internal array elements based on a callback function.
     * @desc <Greek>    Κατηγοριοποιεί τα στοιχεία του εσωτερικού πίνακα βάσει μιας callback συνάρτησης.
     * 
     * @param callable $callback <English>  The callback function to use for grouping.
     *                           <Greek>    Η callback συνάρτηση για την κατηγοριοποίηση.
     * @return array <English>  The grouped array.
     *                <Greek>    Ο κατηγοριοποιημένος πίνακας.
     */
    public function groupBy(callable $callback): array
    {
        /*
        <English>
            Initialize an empty array for groups.
        </English>
        <Greek>
            Αρχικοποιεί έναν κενό πίνακα για τις ομάδες.
        </Greek>
        */
        $grouped = [];

        /*
        <English>
            Iterate through the array and group elements using the callback function.
        </English>
        <Greek>
            Διατρέχει τον πίνακα και κατηγοριοποιεί τα στοιχεία χρησιμοποιώντας την callback συνάρτηση.
        </Greek>
        */
        foreach ($this->array as $value) {
            $key = $callback($value);
            $grouped[$key][] = $value;
        }

        return $grouped;
    }
  

    /**
     * Calculates the mean (average) of the array.
     * 
     * @desc <English>  Calculates the mean (average) of the internal array.
     * @desc <Greek>    Υπολογίζει τον μέσο όρο του εσωτερικού πίνακα.
     * 
     * @return float <English>  The mean of the array.
     *               <Greek>    Ο μέσος όρος του πίνακα.
     */
    public function mean(): float
    {
        /*
        <English>
            Calculate the sum of the array elements.
        </English>
        <Greek>
            Υπολογίζει το άθροισμα των στοιχείων του πίνακα.
        </Greek>
        */
        $sum = array_sum($this->array);

        /*
        <English>
            Calculate the mean by dividing the sum by the number of elements.
        </English>
        <Greek>
            Υπολογίζει τον μέσο όρο διαιρώντας το άθροισμα με τον αριθμό των στοιχείων.
        </Greek>
        */
        return $sum / count($this->array);
    }


    /**
     * Calculates the median of the array.
     * 
     * @desc <English>  Calculates the median of the internal array.
     * @desc <Greek>    Υπολογίζει τη διαμέσου τιμή του εσωτερικού πίνακα.
     * 
     * @return float <English>  The median of the array.
     *               <Greek>    Η διαμέσου τιμή του πίνακα.
     */
    public function median(): float
    {
        /*
        <English>
            Sort the array.
        </English>
        <Greek>
            Ταξινομεί τον πίνακα.
        </Greek>
        */
        $sortedArray = $this->array;
        sort($sortedArray);
        $count = count($sortedArray);
        
        /*
        <English>
            Calculate the median based on the count of elements.
        </English>
        <Greek>
            Υπολογίζει τη διαμέσου τιμή βάσει του αριθμού των στοιχείων.
        </Greek>
        */
        $mid = (int) ($count / 2);
        if ($count % 2 === 0) {
            return ($sortedArray[$mid - 1] + $sortedArray[$mid]) / 2;
        }
        return $sortedArray[$mid];
    }


    /**
     * Calculates the mode of the array.
     * 
     * @desc <English>  Calculates the mode of the internal array.
     * @desc <Greek>    Υπολογίζει τη συχνότερα εμφανιζόμενη τιμή του εσωτερικού πίνακα.
     * 
     * @return mixed <English>  The mode of the array.
     *               <Greek>    Η συχνότερα εμφανιζόμενη τιμή του πίνακα.
     */
    public function mode(): mixed
    {
        /*
        <English>
            Calculate the frequency of each element.
        </English>
        <Greek>
            Υπολογίζει τη συχνότητα εμφάνισης κάθε στοιχείου.
        </Greek>
        */
        $frequency = array_count_values($this->array);

        /*
        <English>
            Find the element with the highest frequency.
        </English>
        <Greek>
            Βρίσκει το στοιχείο με τη μεγαλύτερη συχνότητα εμφάνισης.
        </Greek>
        */
        $maxFrequency = max($frequency);
        $modes = array_filter($frequency, fn($freq) => $freq === $maxFrequency);

        /*
        <English>
            Return the mode(s).
        </English>
        <Greek>
            Επιστρέφει τη συχνότερα εμφανιζόμενη τιμή.
        </Greek>
        */
        return array_keys($modes);
    }


    /**
     * Calculates the moving average of the array.
     * 
     * @desc <English>  Calculates the moving average of the internal array over a specified window size.
     * @desc <Greek>    Υπολογίζει τον κινητό μέσο όρο του εσωτερικού πίνακα σε ένα καθορισμένο μέγεθος παραθύρου.
     * 
     * @param int $windowSize <English>  The size of the window for the moving average.
     *                        <Greek>    Το μέγεθος του παραθύρου για τον κινητό μέσο όρο.
     * @return array <English>  The moving averages of the array.
     *                <Greek>    Οι κινητοί μέσοι όροι του πίνακα.
     */
    public function movingAverage(int $windowSize): array
    {
        $movingAverages = [];
        for ($i = 0; $i <= count($this->array) - $windowSize; $i++) {
            $window = array_slice($this->array, $i, $windowSize);
            $movingAverages[] = array_sum($window) / $windowSize;
        }
        return $movingAverages;
    }


    /**
     * Calculates the range of the array.
     * 
     * @desc <English>  Calculates the range of the internal array.
     * @desc <Greek>    Υπολογίζει το εύρος του εσωτερικού πίνακα.
     * 
     * @return float <English>  The range of the array.
     *               <Greek>    Το εύρος του πίνακα.
     */
    public function range(): float
    {
        /*
        <English>
            Find the maximum and minimum values.
        </English>
        <Greek>
            Βρίσκει τη μέγιστη και ελάχιστη τιμή.
        </Greek>
        */
        $max = $this->findMax();
        $min = $this->findMin();

        /*
        <English>
            Calculate and return the range.
        </English>
        <Greek>
            Υπολογίζει και επιστρέφει το εύρος.
        </Greek>
        */
        return $max - $min;
    }


    /**
     * Calculates the standard deviation of the array.
     * 
     * @desc <English>  Calculates the standard deviation of the internal array.
     * @desc <Greek>    Υπολογίζει την τυπική απόκλιση του εσωτερικού πίνακα.
     * 
     * @return float <English>  The standard deviation of the array.
     *               <Greek>    Η τυπική απόκλιση του πίνακα.
     */
    public function standardDeviation(): float
    {
        /*
        <English>
            Calculate the variance of the array.
        </English>
        <Greek>
            Υπολογίζει τη διασπορά του πίνακα.
        </Greek>
        */
        $variance = $this->variance();

        /*
        <English>
            Calculate the standard deviation as the square root of the variance.
        </English>
        <Greek>
            Υπολογίζει την τυπική απόκλιση ως την τετραγωνική ρίζα της διασποράς.
        </Greek>
        */
        return sqrt($variance);
    }


    /**
     * Calculates the sum of squares of the array elements.
     * 
     * @desc <English>  Calculates the sum of squares of the internal array elements.
     * @desc <Greek>    Υπολογίζει το άθροισμα των τετραγώνων των στοιχείων του εσωτερικού πίνακα.
     * 
     * @return float <English>  The sum of squares of the array elements.
     *               <Greek>    Το άθροισμα των τετραγώνων των στοιχείων του πίνακα.
     */
    public function sumOfSquares(): float
    {
        return array_reduce($this->array, fn($carry, $item) => $carry + pow($item, 2), 0);
    }



    /**
     * Calculates the variance of the array.
     * 
     * @desc <English>  Calculates the variance of the internal array.
     * @desc <Greek>    Υπολογίζει τη διασπορά του εσωτερικού πίνακα.
     * 
     * @return float <English>  The variance of the array.
     *               <Greek>    Η διασπορά του πίνακα.
     */
    public function variance(): float
    {
        /*
        <English>
            Calculate the mean of the array.
        </English>
        <Greek>
            Υπολογίζει τον μέσο όρο του πίνακα.
        </Greek>
        */
        $mean = $this->mean();

        /*
        <English>
            Calculate the squared differences from the mean.
        </English>
        <Greek>
            Υπολογίζει τις τετραγωνικές διαφορές από τον μέσο όρο.
        </Greek>
        */
        $squaredDiffs = array_map(fn($value) => pow($value - $mean, 2), $this->array);

        /*
        <English>
            Calculate the variance by averaging the squared differences.
        </English>
        <Greek>
            Υπολογίζει τη διασπορά υπολογίζοντας τον μέσο όρο των τετραγωνικών διαφορών.
        </Greek>
        */
        return array_sum($squaredDiffs) / count($this->array);
    }


    /**
     * Calculates the weighted average of the array.
     * 
     * @desc <English>  Calculates the weighted average of the internal array with a given weights array.
     * @desc <Greek>    Υπολογίζει τον σταθμισμένο μέσο όρο του εσωτερικού πίνακα με βάση έναν πίνακα βαρών.
     * 
     * @param array $weights <English>  The weights to use for the weighted average.
     *                       <Greek>    Τα βάρη για τον σταθμισμένο μέσο όρο.
     * @return float <English>  The weighted average of the array.
     *               <Greek>    Ο σταθμισμένος μέσος όρος του πίνακα.
     */
    public function weightedAverage(array $weights): float
    {
        $weightedSum = 0;
        $sumOfWeights = array_sum($weights);

        for ($i = 0; $i < count($this->array); $i++) {
            $weightedSum += $this->array[$i] * $weights[$i];
        }

        return $weightedSum / $sumOfWeights;
    }

}
/******************************************************************************
 * @endcode TArrayAnalysisHandler
 *****************************************************************************/
?>