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
 * @subpackage         	: Handles the creation of graphical representations from array data.
 * @source             	: afw/extras/arrays/TArrayGraphHandler.php
 * @fileNo             	: 
 * @version            	: 24.0.4
 * @created            	: 2024-07-01 20:00:00 UTC+3 
 * @updated            	: 2024-12-05 07:00:00 UTC+3 
 * @author             	: Drogidis Christos
 * @authorSite         	: www.alexsoft.gr
 * @license 			: AGL-F
 * 
 * @since PHP 8.2.0
 */
namespace ASCOOS\FRAMEWORK\Arrays\Extras\Graphs;
defined ("ALEXSOFT_RUN_CMS") or die("Prohibition of Access.");
defined ("ASCOOS_FRAMEWORK_RUN") or die("Prohibition of Access.");

use ASCOOS\FRAMEWORK\Kernel\{
    Arrays\TArrayHandler,
    Graphs\TColorHandler
};

/******************************************************************************
 * @startcode TArrayGraphHandler
 *****************************************************************************/
/**
 * @class   TArrayGraphHandler
 * @extends TArrayHandler
 * 
 * @summary Handles the creation of graphical representations from array data.
 * 
 * 
 * [ METHODS ]
 * @method void __construct(array $array = [], array $properties = [])     The constructor method for the class. It must always be overridden.
 * @method void createAreaChart(string $filePath)                          Creates an area chart from the array data.
 * @method void createBarChart(string $filePath)                           Creates a bar chart from the array data.
 * @method void createBoxPlot(string $filePath)                            Creates a box plot from the array data.
 * @method void createBubbleChart(array $otherArray, array $sizeArray, string $filePath) Creates a bubble chart from the array data.
 * @method void createCandlestickChart(string $filePath)                   Creates a candlestick chart from the array data.
 * @method void createCorrelationMatrix(string $filePath)                  Creates a correlation matrix from the array data.
 * @method void createDensityPlot(string $filePath)                        Creates a density plot from the array data.
 * @method void createDonutChart(string $filePath)                         Creates a donut chart from the array data.
 * @method void createFunnelChart(string $filePath)                        Creates a funnel chart from the array data.
 * @method void createGanttChart(string $filePath)                         Creates a Gantt chart from the array data.
 * @method void createGaugeChart(string $filePath)                         Creates a gauge chart from the array data.
 * @method void createHeatMap(array $matrix, string $filePath)             Creates a heat map from the array data.
 * @method void createHistogram(int $bins, string $filePath)               Creates a histogram from the array data.
 * @method void createLineChart(string $filePath)                          Creates a line chart from the array data.
 * @method void createMultiLineChart(string $filePath)                     Creates a multi-line chart from the multi-dimensional array data. 
 * @method void createPieChart(string $filePath)                           Creates a pie chart from the array data.
 * @method void createPolarAreaChart(array $labels, string $filePath)      Creates a polar area chart from the array data.
 * @method void createRadarChart(array $labels, string $filePath)          Creates a radar chart from the array data.
 * @method void createScatterPlot(array $otherArray, string $filePath)     Creates a scatter plot from the array data.
 * @method void createSplineChart(string $filePath)                        Creates a spline chart from the array data.
 * @method void createStepChart(string $filePath)                          Creates a step chart from the array data.
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
 * @method void replace(array $array)                                      Replaces the array.
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
class TArrayGraphHandler extends TArrayHandler
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
    public function __construct(array $array = [], array $properties = ['width'=>800, 'height'=>600]) {
        parent::__construct($array, $properties);
    }

 


    /**
     * Creates an area chart from the array data.
     * 
     * @desc <English> Creates an area chart from the array data.
     * @desc <Greek> Δημιουργεί ένα διάγραμμα εμβαδού από τα δεδομένα του πίνακα.
     * 
     * @param string $filePath <English> The file path to save the area chart image.
     *                         <Greek> Η διαδρομή του αρχείου για την αποθήκευση της εικόνας του διαγράμματος εμβαδού.
     * @return void
     */
    public function createAreaChart(string $filePath): void {
        $width = $this->properties['width'];
        $height = $this->properties['height'];
        $fontPath = $this->properties['fontPath'] ?? '/path/to/default/font.ttf'; // Προσθήκη προεπιλεγμένου μονοπατιού
        $showValues = $this->properties['showValues'] ?? false; // Προσθήκη προαιρετικής παραμέτρου
        $colorIndex = $this->properties['colorIndex'] ?? 2; // Προσθήκη προαιρετικής παραμέτρου για χρώμα

        $image = imagecreatetruecolor($width, $height);
        $backgroundColor = imagecolorallocate($image, 255, 255, 255);
        $textColor = imagecolorallocate($image, 0, 0, 0);

        $colorHandler = new TColorHandler();
        $selectedColor = $colorHandler->getColor($colorIndex);
        $plotColor = imagecolorallocate($image, ...$selectedColor);

        imagefilledrectangle($image, 0, 0, $width - 1, $height - 1, $backgroundColor);

        $prevX = 0;
        $prevY = $height;
        $numericPoints = array_filter($this->array, function($point) {
            return is_array($point) && is_numeric($point[1]);
        });

        if (empty($numericPoints)) {
            $maxX = count($this->array); // Χρησιμοποιούμε τον αριθμό των σημείων δεδομένων ως μέγιστο X αν δεν υπάρχουν αριθμητικά σημεία
        } else {
            $maxX = max(array_column($numericPoints, 0)); // Μέγιστη τιμή στον άξονα X με έλεγχο για κενά
        }

        $scaleX = $width / ($maxX + 1); // Κλίμακα για τον άξονα X

        foreach ($this->array as $index => $point) {
            if (is_array($point)) {
                $x = is_numeric($point[0]) ? $point[0] * $scaleX : $index * $scaleX; // Έλεγχος για αριθμητική τιμή ή χρήση του δείκτη
                $y = is_numeric($point[1]) ? $point[1] : 0; // Έλεγχος για αριθμητική τιμή
            } else {
                $x = $prevX + $scaleX; // Προσθήκη της κλίμακας για το x
                $y = is_numeric($point) ? $point : 0; // Έλεγχος για αριθμητική τιμή
            }
            $y = $height - $y * ($height / 100);
            @imagefilledpolygon($image, [$prevX, $height, $prevX, $prevY, $x, $y, $x, $height], 4, $plotColor);
        
            // Εμφάνιση τιμών πάνω από τις κορυφές αν είναι ενεργοποιημένο
            if ($showValues) {
                $value = is_array($point) ? $point[1] : $point;
                @imagettftext($image, 12, 0, $x - 10, $y - 10, $textColor, $fontPath, $value);
            }
        
            $prevX = $x;
            $prevY = $y;
        }

        imagepng($image, $filePath);
        imagedestroy($image);
    }





    /**
     * Creates a bar chart from the array data.
     * 
     * @desc <English>  Creates a bar chart from the array data and saves it to a specified file.
     * @desc <Greek>    Δημιουργεί ένα γράφημα ράβδων από τα δεδομένα του πίνακα και το αποθηκεύει σε ένα καθορισμένο αρχείο.
     * 
     * @param string $filePath <English>  The path to the file where the bar chart will be saved.
     *                         <Greek>    Η διαδρομή προς το αρχείο όπου θα αποθηκευτεί το γράφημα ράβδων.
     * @param string $fontPath <English>  The path to the TrueType font file.
     *                         <Greek>    Η διαδρομή προς το αρχείο γραμματοσειράς TrueType.
     * @return void
     */
    public function createBarChart(string $filePath, string $fontPath): void {
        $imageWidth = $this->properties['width'];
        $imageHeight = $this->properties['height'];
        $image = imagecreatetruecolor($imageWidth, $imageHeight);
        $backgroundColor = imagecolorallocate($image, 255, 255, 255);
        $borderColor = imagecolorallocate($image, 0, 0, 0);

        $subBarColors = [
            imagecolorallocate($image, 0, 0, 255), // Blue for population
            imagecolorallocate($image, 0, 255, 0), // Green for GDP per capita
            imagecolorallocate($image, 255, 0, 0)  // Red for GDP
        ];

        imagefill($image, 0, 0, $backgroundColor);

        $maxValue = is_array(current($this->array)) ? max(array_map('max', $this->array)) : max($this->array);
        $barWidth = ($imageWidth - 60) / (count($this->array) * 1.5); // Περισσότερος χώρος για τα κενά
        $scale = ($imageHeight - 70) / $maxValue;
        $fontSize = 14;

        $i = 0;
        foreach ($this->array as $key => $values) {
            if (is_array($values)) {
                $subBarWidth = $barWidth / count($values);

                foreach ($values as $j => $value) {
                    $x1 = $i * $barWidth * 1.5 + $j * $subBarWidth + 20;
                    $y1 = $imageHeight - ($value * $scale) - 35;
                    $x2 = $x1 + $subBarWidth;
                    $y2 = $imageHeight - 35;

                    @imagerectangle($image, $x1, $y1, $x2, $y2, $borderColor);
                    @imagefilledrectangle($image, $x1, $y1, $x2, $y2, $subBarColors[$j]);
                }

                // Κεντράρισμα της ετικέτας κάτω από την κεντρική μπάρα
                $labelX = $i * $barWidth * 1.5 + $barWidth / 2 + 20 - (strlen($key) * $fontSize / 4);
            } else {
                $x1 = $i * $barWidth * 1.5 + 20;
                $y1 = $imageHeight - ($values * $scale) - 35;
                $x2 = $x1 + $barWidth;
                $y2 = $imageHeight - 35;

                @imagerectangle($image, $x1, $y1, $x2, $y2, $borderColor);
                @imagefilledrectangle($image, $x1, $y1, $x2, $y2, $subBarColors[0]);

                // Κεντράρισμα της ετικέτας κάτω από την κεντρική μπάρα
                $labelX = $i * $barWidth * 1.5 + $barWidth / 2 + 20 - (strlen($key) * $fontSize / 4);
            }

            $textColor = imagecolorallocate($image, 0, 0, 0);
            @imagettftext($image, $fontSize, 0, $labelX, $imageHeight - 10, $textColor, $fontPath, $key);

            $i++;
        }

        imagepng($image, $filePath);
        imagedestroy($image);
    }


    /**
     * Creates a box plot from the array data.
     * 
     * @desc <English>  Creates a box plot from the array data and saves it to a specified file.
     * @desc <Greek>    Δημιουργεί ένα διάγραμμα κουτιού από τα δεδομένα του πίνακα και το αποθηκεύει σε ένα καθορισμένο αρχείο.
     * 
     * @param array $labels    <English>  The labels for the categories.
     *                         <Greek>    Οι ετικέτες για τις κατηγορίες.
     * @param string $filePath <English>  The path to the file where the box plot will be saved.
     *                         <Greek>    Η διαδρομή προς το αρχείο όπου θα αποθηκευτεί το διάγραμμα κουτιού.
     * @return void
     */
    public function createBoxPlot(array $labels, string $filePath): void {
        $width = $this->properties['width'] ?? 800;
        $height = $this->properties['height'] ?? 600;
        $fontPath = $this->properties['fontPath'] ?? '/path/to/default/font.ttf';
        $boxColorIndex = $this->properties['boxColorIndex'] ?? 2; // Προσθήκη προαιρετικής παραμέτρου για χρώμα
        $borderColorIndex = $this->properties['borderColorIndex'] ?? 0; // Προσθήκη προαιρετικής παραμέτρου για χρώμα
    
        $image = imagecreatetruecolor($width, $height);
        $backgroundColor = imagecolorallocate($image, 255, 255, 255);
        $textColor = imagecolorallocate($image, 0, 0, 0);

        $colorHandler = new TColorHandler();
        $boxColor = imagecolorallocate($image, ...$colorHandler->getColor($boxColorIndex));
        $borderColor = imagecolorallocate($image, ...$colorHandler->getColor($borderColorIndex));

        imagefill($image, 0, 0, $backgroundColor);

        $boxWidth = $width / (count($this->array) * 2);
        $padding = 20;

        foreach ($this->array as $i => $values) {
            sort($values);
            $min = $values[0];
            $max = end($values);
            $median = $values[floor(count($values) / 2)];
            $q1 = $values[floor(count($values) / 4)];
            $q3 = $values[floor(count($values) * 3 / 4)];

            $x1 = $i * 2 * $boxWidth + $padding;
            $x2 = $x1 + $boxWidth;
            $yMin = $height - ($min * 10) - $padding;
            $yMax = $height - ($max * 10) - $padding;
            $yMedian = $height - ($median * 10) - $padding;
            $yQ1 = $height - ($q1 * 10) - $padding;
            $yQ3 = $height - ($q3 * 10) - $padding;

            // Σχεδίαση του κουτιού
            @imagerectangle($image, $x1, $yQ1, $x2, $yQ3, $borderColor);
            @imagefilledrectangle($image, $x1, $yQ1, $x2, $yQ3, $boxColor);

            // Σχεδίαση της μεσαίας γραμμής
            @imageline($image, $x1, $yMedian, $x2, $yMedian, $borderColor);

            // Σχεδίαση των γραμμών min και max
            @imageline($image, ($x1 + $x2) / 2, $yMin, ($x1 + $x2) / 2, $yQ1, $borderColor);
            @imageline($image, ($x1 + $x2) / 2, $yQ3, ($x1 + $x2) / 2, $yMax, $borderColor);

            // Προσθήκη ετικέτας κατηγορίας αν υπάρχει
            if ($fontPath !== null && isset($labels[$i])) {
                imagettftext($image, 10, 0, $x1, $height - $padding / 2, $textColor, $fontPath, $labels[$i]);
            }
        }

        imagepng($image, $filePath);
        imagedestroy($image);
    }


    /**
     * Creates a bubble chart from the array data.
     * 
     * @desc <English> Creates a bubble chart from the array data.
     * @desc <Greek> Δημιουργεί ένα διάγραμμα φυσαλίδων από τα δεδομένα του πίνακα.
     * 
     * @param array $otherArray <English> The array for the other dimension of data.
     *                          <Greek> Ο πίνακας για τη δεύτερη διάσταση δεδομένων.
     * @param array $sizeArray <English> The array for the size of the bubbles.
     *                         <Greek> Ο πίνακας για το μέγεθος των φυσαλίδων.
     * @param string $filePath <English> The file path to save the bubble chart image.
     *                         <Greek> Η διαδρομή του αρχείου για την αποθήκευση της εικόνας του διαγράμματος φυσαλίδων.
     * @param float $initialPercentage <English> The percentage of bubbles to place at the beginning of the axes.
     *                                 <Greek> Το ποσοστό των φυσαλίδων που θα τοποθετηθεί στην αρχή των αξόνων.
     * @return void
     */
    public function createBubbleChart(array $otherArray, array $sizeArray, string $filePath, float $initialPercentage = 0.3): void {
        // <English> Create the bubble chart image
        // <Greek> Δημιουργία του διαγράμματος φυσαλίδων
        $imageWidth = $this->properties['width'];
        $imageHeight = $this->properties['height'];
        $image = imagecreatetruecolor($imageWidth, $imageHeight);
        $white = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image, 0, 0, $imageWidth - 1, $imageHeight - 1, $white);

        $positions = [];
        
        // <English> Calculate the percentage of initial bubbles
        // <Greek> Υπολογισμός του ποσοστού των αρχικών φυσαλίδων
        $initialBubbles = ceil(count($this->array) * $initialPercentage);  


        foreach ($this->array as $i => $point) {
            $size = $sizeArray[$i];
            if ($i < $initialBubbles) {
                // <English> Place initial bubbles near the origin of the axes
                // <Greek> Τοποθέτηση των αρχικών φυσαλίδων κοντά στην αρχή των αξόνων
                $x = @rand($size / 2, $imageWidth / 4);
                $y = @rand($imageHeight * 3 / 4, $imageHeight - $size / 2);
            } else {
                // <English> Random placement for the remaining bubbles
                // <Greek> Τυχαία τοποθέτηση για τις υπόλοιπες φυσαλίδες
                $x = @rand($size / 2, $imageWidth - $size / 2);
                $y = @rand($size / 2, $imageHeight - $size / 2);
            }

            // <English> Check for overlap and adjust position if necessary
            // <Greek> Έλεγχος επικάλυψης και προσαρμογή θέσης αν χρειαστεί
            $attempts = 0;
            while ($attempts < 100 && $this->isOverlap($x, $y, $size, $positions)) {
                $x = @rand($size / 2, $imageWidth - $size / 2);
                $y = @rand($size / 2, $imageHeight - $size / 2);
                $attempts++;
            }

            $positions[] = [$x, $y, $size];

            // <English> Generate a unique color for each bubble
            // <Greek> Δημιουργία μοναδικού χρώματος για κάθε φυσαλίδα
            if (count($point) > 2) {
                $colorValue = intval($point[2] * 255);
                $color = imagecolorallocate($image, $colorValue, 0, 255 - $colorValue);
            } else {
                $hue = ($i / count($this->array)) * 360;
                list($r, $g, $b) = TColorHandler::hsvToRgb($hue, 1, 1);
                $color = imagecolorallocate($image, $r, $g, $b);
            }

            @imagefilledellipse($image, $x, $y, $size, $size, $color);
        }

        imagepng($image, $filePath);
        imagedestroy($image);
    }


    /**
     * Creates a candlestick chart from the array data.
     * 
     * @desc <English> Creates a candlestick chart from the array data.
     * @desc <Greek> Δημιουργεί ένα διάγραμμα κηροπηγίων από τα δεδομένα του πίνακα.
     * 
     * @param string $filePath <English> The file path to save the candlestick chart image.
     *                         <Greek> Η διαδρομή του αρχείου για την αποθήκευση της εικόνας του διαγράμματος κηροπηγίων.
     * @return void
     */
    public function createCandlestickChart(string $filePath): void 
    {
        $ohlcData = $this->array;
        $width = $this->properties['width'] ?? 800;
        $height = $this->properties['height'] ?? 600;
        $backgroundColorIndex = $this->properties['backgroundColorIndex'] ?? 1;
        $upColorIndex = $this->properties['upColorIndex'] ?? 3;
        $downColorIndex = $this->properties['downColorIndex'] ?? 2;
        $borderColorIndex = $this->properties['borderColorIndex'] ?? 0;

        $image = imagecreatetruecolor($width, $height);

        $colorHandler = new TColorHandler();
        $backgroundColor = imagecolorallocate($image, ...$colorHandler->getColor($backgroundColorIndex));
        $borderColor = imagecolorallocate($image, ...$colorHandler->getColor($borderColorIndex));
        $upColor = imagecolorallocate($image, ...$colorHandler->getColor($upColorIndex));
        $downColor = imagecolorallocate($image, ...$colorHandler->getColor($downColorIndex));

        imagefilledrectangle($image, 0, 0, $width - 1, $height - 1, $backgroundColor);

        $xSpacing = ($width - 40) / count($ohlcData); // Υπολογισμός απόστασης x ανάλογα με τον αριθμό δεδομένων
        $x = 20;
        foreach ($ohlcData as $ohlc) {
            $open = $height - $ohlc['open'] * ($height / 100);
            $high = $height - $ohlc['high'] * ($height / 100);
            $low = $height - $ohlc['low'] * ($height / 100);
            $close = $height - $ohlc['close'] * ($height / 100);

            $color = ($close >= $open) ? $upColor : $downColor;
            @imageline($image, $x, $low, $x, $high, $borderColor);
            @imagefilledrectangle($image, $x - 5, min($open, $close), $x + 5, max($open, $close), $color);
            @imagerectangle($image, $x - 5, min($open, $close), $x + 5, max($open, $close), $borderColor);

            $x += $xSpacing; // Αύξηση του x ανάλογα με την απόσταση x
        }

        imagepng($image, $filePath);
        imagedestroy($image);
    }



    /**
     * Creates a correlation matrix from the array data.
     * 
     * @desc <English> Creates a correlation matrix from the array data.
     * @desc <Greek> Δημιουργεί έναν πίνακα συντελεστών συσχέτισης από τα δεδομένα του πίνακα.
     * 
     * @param string $filePath <English> The file path to save the correlation matrix image.
     *                         <Greek> Η διαδρομή του αρχείου για την αποθήκευση της εικόνας του πίνακα συντελεστών συσχέτισης.
     * @return void
     */
    public function createCorrelationMatrix(string $filePath): void {
        $data = $this->array;
        $isMultidimensional = is_array($data[0]);

        $imageWidth = $this->properties['width'];
        $imageHeight = $this->properties['height'];
        $image = imagecreatetruecolor($imageWidth, $imageHeight);
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);

        imagefilledrectangle($image, 0, 0, $imageWidth - 1, $imageHeight - 1, $white);

        if ($isMultidimensional) {
            // <English> Multidimensional data: Calculate correlation coefficients
            // <Greek> Πολυδιάστατα δεδομένα: Υπολογισμός συντελεστών συσχέτισης
            $cellWidth = $imageWidth / count($data);
            $cellHeight = $imageHeight / count($data[0]);
            $maxValue = max(array_map('max', $data));
            $minValue = min(array_map('min', $data));

            for ($i = 0; $i < count($data); $i++) {
                for ($j = 0; $j < count($data[0]); $j++) {
                    $value = $data[$i][$j];
                    $hue = 360 * ($value - $minValue) / ($maxValue - $minValue); // Scale hue based on value
                    list($r, $g, $b) = TColorHandler::hsvToRgb($hue, 1, 1);
                    $color = @imagecolorallocate($image, $r, $g, $b);
                    @imageline($image, $i * $cellWidth, $j * $cellHeight, ($i + 1) * $cellWidth, ($j + 1) * $cellHeight, $color);
                }
            }
        } else {
            // <English> Simple data: Different logic
            // <Greek> Απλά δεδομένα: Διαφορετική λογική
            $maxValue = max($data);
            $minValue = min($data);

            for ($i = 0; $i < count($data); $i++) {
                $x = $i * $imageWidth / count($data);
                $y = $imageHeight / 2 - $data[$i] * $imageHeight / (2 * ($maxValue - $minValue)); // Adjust for simple data
                $hue = 360 * ($data[$i] - $minValue) / ($maxValue - $minValue); // Scale hue based on value
                list($r, $g, $b) = TColorHandler::hsvToRgb($hue, 1, 1);
                $color = imagecolorallocate($image, $r, $g, $b);
                @imagefilledrectangle($image, $x, $y, $x + $imageWidth / count($data), $imageHeight / 2, $color);
            }
        }

        imagepng($image, $filePath);
        imagedestroy($image);
    }


    /**
     * Δημιουργεί ένα διάγραμμα πυκνότητας από τα δεδομένα του πίνακα.
     * 
     * @desc <English> Creates a density plot from the array data.
     * @desc <Greek> Δημιουργεί ένα διάγραμμα πυκνότητας από τα δεδομένα του πίνακα.
     * 
     * @param string $filePath <English> The file path to save the density plot image.
     *                         <Greek> Η διαδρομή του αρχείου για την αποθήκευση της εικόνας του διαγράμματος πυκνότητας.
     * @return void
     */
    public function createDensityPlot(string $filePath): void {
        $data = $this->array;
        $isMultidimensional = is_array($data[0]);
        $width = $this->properties['width'] ?? 800;
        $height = $this->properties['height'] ?? 600;
        $backgroundColorIndex = $this->properties['backgroundColorIndex'] ?? 1;
        $lineColorIndex = $this->properties['lineColorIndex'] ?? 4;
        $showAxes = $this->properties['showAxes'] ?? true;
        $fontPath = $this->properties['fontPath'] ?? '/path/to/default/font.ttf';

        // Δημιουργία της εικόνας
        $image = imagecreatetruecolor($width, $height);

        $colorHandler = new TColorHandler();
        $backgroundColor = imagecolorallocate($image, ...$colorHandler->getColor($backgroundColorIndex));
        $lineColor = imagecolorallocate($image, ...$colorHandler->getColor($lineColorIndex));
        $axesColor = imagecolorallocate($image, 0, 0, 0);

        imagefilledrectangle($image, 0, 0, $width - 1, $height - 1, $backgroundColor);

        // Σχεδίαση αξόνων Χ και Ψ αν είναι ενεργοποιημένοι
        if ($showAxes) {
            imageline($image, 40, $height - 40, $width - 20, $height - 40, $axesColor); // Άξονας Χ
            imageline($image, 40, 10, 40, $height - 40, $axesColor); // Άξονας Ψ

            // Προσθήκη τιμών στα διαστήματα του άξονα Χ
            $xInterval = ($width - 60) / 10; // 10 διαστήματα
            for ($i = 0; $i <= 10; $i++) {
                $x = 40 + $i * $xInterval;
                $label = strval($i * 10); // Ετικέτες από 0 έως 100
                imagettftext($image, 10, 0, $x - 10, $height - 20, $axesColor, $fontPath, $label); // Μετακίνηση λίγο πιο ψηλά
            }

            // Προσθήκη τιμών στα διαστήματα του άξονα Ψ
            $yInterval = ($height - 50) / 10; // 10 διαστήματα
            for ($i = 0; $i <= 10; $i++) {
                $y = $height - 40 - $i * $yInterval;
                $label = strval($i * 10); // Ετικέτες από 0 έως 100
                imagettftext($image, 10, 0, 10, $y, $axesColor, $fontPath, $label);
            }
        }

        if ($isMultidimensional) {
            // Υπολογισμός και σχεδίαση πυκνότητας για πολυδιάστατα δεδομένα
            $avgData = [];
            $numFeatures = count($data[0]);
            for ($i = 0; $i < $numFeatures; $i++) {
                $sum = 0;
                for ($j = 0; $j < count($data); $j++) {
                    if (!isset($data[$j][$i])) {
                        // Διάγνωση σφάλματος: Έλλειψη δεδομένων
                        echo "Error: Missing data at row $j, column $i";
                        return;
                    }
                    $sum += $data[$j][$i];
                }
                $avgData[] = $sum / count($data);
            }

            $prevX = 40;
            $prevY = $height - 40;
            for ($i = 0; $i < count($avgData); $i++) {
                $x = $i * (($width - 60) / count($avgData)) + 40;
                $y = $height - 40 - ($avgData[$i] * (($height - 50) / 100));

                if ($i > 0) {
                    @imageline($image, $prevX, $prevY, $x, $y, $lineColor);
                }

                $prevX = $x;
                $prevY = $y;
            }
        } else {
            // Σχεδίαση γραμμών πυκνότητας για απλά δεδομένα
            $prevX = 40;
            $prevY = $height - 40;
            for ($i = 0; $i < count($data); $i++) {
                $x = $i * (($width - 60) / count($data)) + 40;
                $y = $height - 40 - ($data[$i] * (($height - 50) / 100));

                if ($i > 0) {
                    @imageline($image, $prevX, $prevY, $x, $y, $lineColor);
                }

                $prevX = $x;
                $prevY = $y;
            }
        }

        imagepng($image, $filePath);
        imagedestroy($image);
    }



    /**
     * Creates a donut chart from the array data.
     * 
     * @desc <English> Creates a donut chart from the array data.
     * @desc <Greek> Δημιουργεί ένα διάγραμμα ντόνατ από τα δεδομένα του πίνακα.
     * 
     * @param string $filePath <English> The file path to save the donut chart image.
     *                         <Greek> Η διαδρομή του αρχείου για την αποθήκευση της εικόνας του διαγράμματος ντόνατ.
     * @return void
     */
    public function createDonutChart(string $filePath): void {
        $data = $this->array;
        $isMultidimensional = is_array($data[0]);
        $width = $this->properties['width'] ?? 800;
        $height = $this->properties['height'] ?? 600;
        $backgroundColorIndex = $this->properties['backgroundColorIndex'] ?? 1;
        $outerRadius = $this->properties['outerRadius'] ?? 200;
        $innerRadius = $this->properties['innerRadius'] ?? 100;
        $colors = $this->properties['colors'] ?? [
            [255, 0, 0],   // Red
            [0, 255, 0],   // Green
            [0, 0, 255],   // Blue
            [255, 255, 0], // Yellow
            [255, 0, 255]  // Magenta
        ];

        // Δημιουργία της εικόνας
        $image = imagecreatetruecolor($width, $height);
        $colorHandler = new TColorHandler();
        $backgroundColor = imagecolorallocate($image, ...$colorHandler->getColor($backgroundColorIndex));

        imagefilledrectangle($image, 0, 0, $width - 1, $height - 1, $backgroundColor);

        $allocatedColors = [];
        foreach ($colors as $color) {
            $allocatedColors[] = imagecolorallocate($image, ...$color);
        }

        if ($isMultidimensional) {
            // Πολυδιάστατα δεδομένα: Δημιουργία πολλών διαγραμμάτων Donut
            $numFeatures = count($data);
            $maxRows = ceil($numFeatures / 2); // Υπολογισμός μέγιστου αριθμού σειρών
            for ($k = 0; $k < $numFeatures; $k++) {
                $startAngle = 0;
                $cx = ($k % 2) * ($width / 2) + ($width / 4); // Κέντρο του κύκλου για κάθε χαρακτηριστικό
                $cy = (floor($k / 2)) * ($height / $maxRows) + ($height / ($maxRows * 2)); // Κέντρο του κύκλου για κάθε χαρακτηριστικό

                $total = array_sum($data[$k]);

                foreach ($data[$k] as $i => $value) {
                    $endAngle = $startAngle + ($value / $total) * 360;
                    $color = $allocatedColors[$i % count($allocatedColors)];

                    // Σχεδίαση τομέα
                    @imagefilledarc($image, $cx, $cy, $outerRadius * 2, $outerRadius * 2, $startAngle, $endAngle, $color, IMG_ARC_PIE);

                    // Σχεδίαση εσωτερικού κύκλου για το δακτυλίδι
                    @imagefilledellipse($image, $cx, $cy, $innerRadius * 2, $innerRadius * 2, $backgroundColor);

                    $startAngle = $endAngle;
                }
            }
        } else {
            // Απλά δεδομένα: Δημιουργία ενός διαγράμματος Donut
            $total = array_sum($data);
            $startAngle = 0;
            $cx = $width / 2; // Κέντρο του κύκλου
            $cy = $height / 2; // Κέντρο του κύκλου

            foreach ($data as $i => $value) {
                $endAngle = $startAngle + ($value / $total) * 360;
                $color = $allocatedColors[$i % count($allocatedColors)];

                // Σχεδίαση τομέα
                @imagefilledarc($image, $cx, $cy, $outerRadius * 2, $outerRadius * 2, $startAngle, $endAngle, $color, IMG_ARC_PIE);

                // Σχεδίαση εσωτερικού κύκλου για το δακτυλίδι
                @imagefilledellipse($image, $cx, $cy, $innerRadius * 2, $innerRadius * 2, $backgroundColor);

                $startAngle = $endAngle;
            }
        }

        imagepng($image, $filePath);
        imagedestroy($image);
    }



    /**
     * Creates a funnel chart from the array data.
     * 
     * @desc <English> Creates a funnel chart from the array data.
     * @desc <Greek> Δημιουργεί ένα διάγραμμα χωνιού από τα δεδομένα του πίνακα.
     * 
     * @param string $filePath <English> The file path to save the funnel chart image.
     *                         <Greek> Η διαδρομή του αρχείου για την αποθήκευση της εικόνας του διαγράμματος χωνιού.
     * @return void
     */
    public function createFunnelChart(string $filePath): void {
        $data = $this->array;
        $total = array_sum($data);
        $width = $this->properties['width'] ?? 800;
        $height = $this->properties['height'] ?? 600;
        $backgroundColorIndex = $this->properties['backgroundColorIndex'] ?? 1;
        $fontPath = $this->properties['fontPath'] ?? '/path/to/default/font.ttf';
        $topWidth = $this->properties['topWidth'] ?? 600;
        $bottomWidth = $this->properties['bottomWidth'] ?? 200;
        $sectionHeight = $this->properties['sectionHeight'] ?? 80;
        $padding = $this->properties['padding'] ?? 20;
        $colorIndices = $this->properties['colorIndices'] ?? [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $labels = $this->properties['labels'] ?? []; // Προαιρετικές ετικέτες

        // Δημιουργία της εικόνας
        $image = imagecreatetruecolor($width, $height);
        $colorHandler = new TColorHandler();
        $backgroundColor = imagecolorallocate($image, ...$colorHandler->getColor($backgroundColorIndex));
        $black = imagecolorallocate($image, 0, 0, 0);

        imagefilledrectangle($image, 0, 0, $width - 1, $height - 1, $backgroundColor);

        $allocatedColors = [];
        foreach ($colorIndices as $colorIndex) {
            $allocatedColors[] = imagecolorallocate($image, ...$colorHandler->getColor($colorIndex));
        }

        $x1 = ($width - $topWidth) / 2;
        $y1 = 50;
        $index = 0;
        foreach ($data as $key => $value) {
            $ratio = $value / $total;
            $currentWidth = $topWidth * $ratio;

            // Έλεγχος εάν υπάρχουν αρκετά χρώματα για να καλύψουν όλα τα δεδομένα
            $color = $allocatedColors[$index % count($allocatedColors)];

            $x2 = $x1 + $currentWidth;
            $y2 = $y1 + $sectionHeight;

            // Σχεδίαση του τομέα του χωνιού
            @imagefilledpolygon($image, [
                $x1, $y1,
                $x2, $y1,
                $x2 - ($topWidth - $bottomWidth) * $ratio, $y2,
                $x1 + ($topWidth - $bottomWidth) * $ratio, $y2
            ], 4, $color);

            // Προσθήκη ετικέτας κειμένου
            $label = isset($labels[$key]) ? $labels[$key] : "Stage " . ($key + 1);
            imagettftext($image, 12, 0, $x1 + 10, $y1 + 30, $black, $fontPath, $label);

            $y1 = $y2 + $padding;
            $index++;
        }

        imagepng($image, $filePath);
        imagedestroy($image);
    }


    /**
     * Creates a Gantt chart from the array data.
     * 
     * @desc <English> Creates a Gantt chart from the array data.
     * @desc <Greek> Δημιουργεί ένα διάγραμμα Gantt από τα δεδομένα του πίνακα.
     * 
     * @param string $filePath <English> The file path to save the Gantt chart image.
     *                         <Greek> Η διαδρομή του αρχείου για την αποθήκευση της εικόνας του διαγράμματος Gantt.
     * @param string $fontPath <English> The path to the TrueType font file.
     *                         <Greek> Η διαδρομή προς το αρχείο γραμματοσειράς TrueType.
     * @return void
     */
    public function createGanttChart(string $filePath, string $fontPath): void {
        $width = $this->properties['width'];
        $height = $this->properties['height'];
        $image = imagecreatetruecolor($width, $height);
        $backgroundColor = imagecolorallocate($image, 255, 255, 255);
        $barColor = imagecolorallocate($image, 0, 0, 255);
        $borderColor = imagecolorallocate($image, 0, 0, 0);
        $textColor = imagecolorallocate($image, 0, 0, 0);

        imagefill($image, 0, 0, $backgroundColor);

        $taskHeight = 30;
        $padding = 10;
        $startX = 100;
        $startY = 50;

        $fontSize = 10; // Μέγεθος γραμματοσειράς

        // Υπολογισμός της πρώτης ημερομηνίας εκκίνησης όλων των εργασιών
        $startDateReference = min(array_map(fn($task) => strtotime($task[1]), $this->array));

        // Υπολογισμός του συνολικού εύρους ημερομηνιών σε ημέρες
        $endDateReference = max(array_map(fn($task) => strtotime($task[2]), $this->array));
        $totalDays = ($endDateReference - $startDateReference) / (60 * 60 * 24);

        // Καθορισμός της κλίμακας για τις ημέρες
        $dayScale = ($width - 2 * $startX) / $totalDays;

        // Προσθήκη σημειώσεων ημερομηνιών στο επάνω μέρος
        $numDates = 10;
        $dateInterval = $totalDays / $numDates;
        for ($i = 0; $i <= $numDates; $i++) {
            $currentDate = date('Y-m-d', $startDateReference + ($i * $dateInterval * 60 * 60 * 24));
            $xPos = $startX + ($i * $dateInterval * $dayScale);
            @imagettftext($image, $fontSize, 0, $xPos, $startY - 10, $textColor, $fontPath, $currentDate);
        }

        foreach ($this->array as $index => $task) {
            list($taskName, $startDate, $endDate) = $task;
            $startXPos = $startX + ((strtotime($startDate) - $startDateReference) / (60 * 60 * 24)) * $dayScale;
            $endXPos = $startX + ((strtotime($endDate) - $startDateReference) / (60 * 60 * 24)) * $dayScale;

            $x1 = $startXPos;
            $x2 = $endXPos;

            // Κατάλληλη κλιμάκωση των συντεταγμένων
            if ($x1 < $startX) {
                $x1 = $startX;
            }
            if ($x2 > $width - $startX) {
                $x2 = $width - $startX;
            }
            if ($x1 == $x2) {
                $x2 = $x1 + 10; // Προσαρμογή ώστε να υπάρχει μήκος μπάρας μεγαλύτερο από 1
            }
            $y1 = $startY + ($index * ($taskHeight + $padding));
            $y2 = $y1 + $taskHeight;
            if ($y2 > $height - $padding) {
                $y2 = $height - $padding;
            }

            @imagerectangle($image, $x1, $y1, $x2, $y2, $borderColor);
            @imagefilledrectangle($image, $x1, $y1, $x2, $y2, $barColor);

            // Προσθήκη ετικέτας κατηγορίας κάτω από τη ράβδο χρησιμοποιώντας γραμματοσειρά TrueType
            @imagettftext($image, $fontSize, 0, $x1 - 90, $y1 + ($taskHeight / 2), $textColor, $fontPath, $taskName);
        }

        imagepng($image, $filePath);
        imagedestroy($image);
    }
    


    /**
     * Creates a gauge chart from the array data.
     * 
     * @desc <English> Creates a gauge chart from the array data.
     * @desc <Greek> Δημιουργεί ένα διάγραμμα δείκτη από τα δεδομένα του πίνακα.
     * 
     * @param string $filePath <English> The file path to save the gauge chart image.
     *                         <Greek> Η διαδρομή του αρχείου για την αποθήκευση της εικόνας του διαγράμματος δείκτη.
     * @return void
     */
    public function createGaugeChart(string $filePath): void {
        $value = $this->array[0];
        $width = $this->properties['width'] ?? 400;
        $height = $this->properties['height'] ?? 400;
        $backgroundColorIndex = $this->properties['backgroundColorIndex'] ?? 1;
        $needleColorIndex = $this->properties['needleColorIndex'] ?? 2;
        $arcColorIndex = $this->properties['arcColorIndex'] ?? 0;

        // Δημιουργία της εικόνας
        $image = imagecreatetruecolor($width, $height);
        $colorHandler = new TColorHandler();
        $backgroundColor = imagecolorallocate($image, ...$colorHandler->getColor($backgroundColorIndex));
        $arcColor = imagecolorallocate($image, ...$colorHandler->getColor($arcColorIndex));
        $needleColor = imagecolorallocate($image, ...$colorHandler->getColor($needleColorIndex));

        imagefilledrectangle($image, 0, 0, $width - 1, $height - 1, $backgroundColor);

        // Ρύθμιση πάχους γραμμής για το gauge
        imagesetthickness($image, 5); // Αυξάνει το πάχος των γραμμών σε 5 pixels

        // Σχεδίαση του κύκλου του gauge με το κυρτό μέρος προς τα πάνω
        imagearc($image, $width / 2, $height / 2, 300, 300, 180, 360, $arcColor);

        // Σχεδίαση της βελόνας
        $angle = ($value / 100) * 180;
        $x = ($width / 2) + 150 * cos(deg2rad($angle - 180));
        $y = ($height / 2) + 150 * sin(deg2rad($angle - 180));
        @imageline($image, $width / 2, $height / 2, $x, $y, $needleColor);

        imagepng($image, $filePath);
        imagedestroy($image);
    }


    /**
     * Creates a heat map from the array data.
     * 
     * @desc <English>  Creates a heat map from the array data and saves it to a specified file.
     * @desc <Greek>    Δημιουργεί ένα χάρτη θερμότητας από τα δεδομένα του πίνακα και το αποθηκεύει σε ένα καθορισμένο αρχείο.
     * 
     * @param string $filePath <English>  The path to the file where the heat map will be saved.
     *                         <Greek>    Η διαδρομή προς το αρχείο όπου θα αποθηκευτεί ο χάρτης θερμότητας.
     * @return void
     */
    public function createHeatMap(string $filePath): void {
        $data = $this->array;
        $rows = count($data);
        $cols = count($data[0]);
        $cellSize = $this->properties['cellSize'] ?? 50; // Μέγεθος κάθε κελιού
        $imageWidth = $cols * $cellSize;
        $imageHeight = $rows * $cellSize;
        $backgroundColorIndex = $this->properties['backgroundColorIndex'] ?? 1;
        $colorGradient = $this->properties['colorGradient'] ?? range(0, 10); // Προεπιλεγμένος γραμμικός κλίμακας

        // Δημιουργία της εικόνας
        $image = imagecreatetruecolor($imageWidth, $imageHeight);
        $colorHandler = new TColorHandler();
        $backgroundColor = imagecolorallocate($image, ...$colorHandler->getColor($backgroundColorIndex));
        imagefilledrectangle($image, 0, 0, $imageWidth - 1, $imageHeight - 1, $backgroundColor);

        // Καθορισμός χρωμάτων από το γραμμικό κλίμακα
        $allocatedColors = [];
        foreach ($colorGradient as $i) {
            $allocatedColors[] = imagecolorallocate($image, 25 * $i, 0, 255 - 25 * $i);
        }

        // Σχεδίαση του χάρτη θερμότητας
        $minValue = min(array_map('min', $data));
        $maxValue = max(array_map('max', $data));
        foreach ($data as $r => $row) {
            foreach ($row as $c => $value) {
                $normalizedValue = round(10 * ($value - $minValue) / ($maxValue - $minValue));
                $color = $allocatedColors[$normalizedValue];
                imagefilledrectangle($image, $c * $cellSize, $r * $cellSize, ($c + 1) * $cellSize - 1, ($r + 1) * $cellSize - 1, $color);
            }
        }

        imagepng($image, $filePath);
        imagedestroy($image);
    }


    /**
     * Creates a histogram from the array data.
     * 
     * @desc <English>  Creates a histogram from the array data and saves it to a specified file.
     * @desc <Greek>    Δημιουργεί ένα ιστόγραμμα από τα δεδομένα του πίνακα και το αποθηκεύει σε ένα καθορισμένο αρχείο.
     * 
     * @param int $bins <English>  The number of bins for the histogram.
     *                  <Greek>    Ο αριθμός των διαστημάτων για το ιστόγραμμα.
     * @param string $filePath <English>  The path to the file where the histogram will be saved.
     *                         <Greek>    Η διαδρομή προς το αρχείο όπου θα αποθηκευτεί το ιστόγραμμα.
     * @return void
     */
    public function createHistogram(int $bins, string $filePath): void {
        $data = $this->array;
        $width = $this->properties['width'] ?? 800;
        $height = $this->properties['height'] ?? 600;
        $backgroundColorIndex = $this->properties['backgroundColorIndex'] ?? 1;
        $barColorIndex = $this->properties['barColorIndex'] ?? 2;
        $borderColorIndex = $this->properties['borderColorIndex'] ?? 0;
        $fontPath = $this->properties['fontPath'] ?? '/path/to/default/font.ttf';
        $labels = $this->properties['labels'] ?? []; // Προαιρετικές ετικέτες

        // Δημιουργία της εικόνας
        $image = imagecreatetruecolor($width, $height);
        $colorHandler = new TColorHandler();
        $backgroundColor = imagecolorallocate($image, ...$colorHandler->getColor($backgroundColorIndex));
        $barColor = imagecolorallocate($image, ...$colorHandler->getColor($barColorIndex));
        $borderColor = imagecolorallocate($image, ...$colorHandler->getColor($borderColorIndex));
        $black = imagecolorallocate($image, 0, 0, 0);

        imagefilledrectangle($image, 0, 0, $width - 1, $height - 1, $backgroundColor);

        $minValue = min($data);
        $maxValue = max($data);
        $range = $maxValue - $minValue;
        $binWidth = $range / $bins;

        $histogram = array_fill(0, $bins, 0);

        foreach ($data as $value) {
            $binIndex = (int) (($value - $minValue) / $binWidth);
            if ($binIndex == $bins) {
                $binIndex--;
            }
            $histogram[$binIndex]++;
        }

        $maxBinCount = max($histogram);
        $scale = ($height - 100) / $maxBinCount; // Προσαρμογή για το ύψος των ετικετών
        $barWidth = (($width - 100) / $bins) - 10; // Προσαρμογή για το πλάτος των ετικετών και απόσταση μεταξύ στηλών

        foreach ($histogram as $i => $count) {
            $x1 = $i * ($barWidth + 10) + 50;
            $y1 = $height - ($count * $scale) - 50;
            $x2 = $x1 + $barWidth;
            $y2 = $height - 50;

            @imagerectangle($image, $x1, $y1, $x2, $y2, $borderColor);
            @imagefilledrectangle($image, $x1, $y1, $x2, $y2, $barColor);

            // Προσθήκη ετικέτας για κάθε κάδο με μετατόπιση αριστερά
            $label = isset($labels[$i]) ? $labels[$i] : '';
            @imagettftext($image, 10, 0, $x1 + ($barWidth / 2) - 20, $height - 30, $black, $fontPath, $label);
        }

        // Προσθήκη τιμών για τον άξονα Ψ
        for ($i = 0; $i <= $maxBinCount; $i++) {
            $y = $height - ($i * $scale) - 50;
            @imagettftext($image, 10, 0, 20, $y, $black, $fontPath, (string)$i);
        }

        // Προσθήκη ετικέτας για τον οριζόντιο άξονα
        @imagettftext($image, 12, 0, ($width / 2) - 50, $height - 10, $black, $fontPath, "Bins");

        // Προσθήκη ετικέτας για τον κατακόρυφο άξονα
        @imagettftext($image, 12, 90, 20, $height / 2, $black, $fontPath, "Count");

        imagepng($image, $filePath);
        imagedestroy($image);
    }

    


    /**
     * Creates a line chart from the array data.
     * 
     * @desc <English>  Creates a line chart from the array data and saves it to a specified file.
     * @desc <Greek>    Δημιουργεί ένα γράφημα γραμμών από τα δεδομένα του πίνακα και το αποθηκεύει σε ένα καθορισμένο αρχείο.
     * 
     * @param string $filePath <English>  The path to the file where the line chart will be saved.
     *                         <Greek>    Η διαδρομή προς το αρχείο όπου θα αποθηκευτεί το γράφημα γραμμών.
     * @return void
     */
    public function createLineChart(string $filePath): void {
        $imageWidth = $this->properties['width'] ?? 800;
        $imageHeight = $this->properties['height'] ?? 600;
        $showAxes = $this->properties['showAxes'] ?? true;  // Προαιρετική εμφάνιση άξονων
        $fontPath = $this->properties['fontPath'] ?? '/path/to/default/font.ttf';
        $backgroundColorIndex = $this->properties['backgroundColorIndex'] ?? 1;
        $lineColorIndex = $this->properties['lineColorIndex'] ?? 0;
        $axisColorIndex = $this->properties['axisColorIndex'] ?? 0;

        $image = imagecreatetruecolor($imageWidth, $imageHeight);
        $colorHandler = new TColorHandler();
        $backgroundColor = imagecolorallocate($image, ...$colorHandler->getColor($backgroundColorIndex));
        $lineColor = imagecolorallocate($image, ...$colorHandler->getColor($lineColorIndex));
        $axisColor = imagecolorallocate($image, ...$colorHandler->getColor($axisColorIndex));
        $black = imagecolorallocate($image, 0, 0, 0);

        imagefill($image, 0, 0, $backgroundColor);

        // Έλεγχος αν τα δεδομένα είναι μονοδιάστατα ή πολυδιάστατα
        if (isset($this->array[0]['x']) && isset($this->array[0]['y'])) {
            // Διαχείριση δεδομένων πολυδιάστατου πίνακα (συντεταγμένες x και y)
            $yValues = array_column($this->array, 'y');
            $maxValue = max($yValues);
            $pointWidth = ($imageWidth - 60) / (count($this->array) - 1);
            $scale = ($imageHeight - 60) / $maxValue;

            $points = [];
            foreach ($this->array as $point) {
                $x = ($point['x'] - 1) * $pointWidth + 50; // Υποθέτουμε ότι το x αρχίζει από το 1
                $y = $imageHeight - ($point['y'] * $scale) - 50;
                $points[] = [$x, $y];
            }
        } else {
            // Διαχείριση δεδομένων μονοδιάστατου πίνακα
            $maxValue = max($this->array);
            $pointWidth = ($imageWidth - 60) / (count($this->array) - 1);
            $scale = ($imageHeight - 60) / $maxValue;

            $points = [];
            foreach ($this->array as $i => $value) {
                $x = $i * $pointWidth + 50;
                $y = $imageHeight - ($value * $scale) - 50;
                $points[] = [$x, $y];
            }
        }

        // Δημιουργία γραμμών
        for ($i = 0; $i < count($points) - 1; $i++) {
            @imageline($image, $points[$i][0], $points[$i][1], $points[$i+1][0], $points[$i+1][1], $lineColor);
        }

        if ($showAxes) {
            // Προσθήκη άξονων Χ και Ψ
            imageline($image, 50, 10, 50, $imageHeight - 50, $axisColor); // Άξονας Υ
            imageline($image, 50, $imageHeight - 50, $imageWidth - 10, $imageHeight - 50, $axisColor); // Άξονας Χ

            // Προσθήκη τιμών στον άξονα Υ
            for ($i = 0; $i <= $maxValue; $i += round($maxValue / 10)) {
                $y = $imageHeight - ($i * $scale) - 50;
                @imagettftext($image, 10, 0, 20, $y + 5, $black, $fontPath, (string)$i); // Τιμές εξωτερικά του άξονα
            }

            // Προσθήκη τιμών στον άξονα Χ
            for ($i = 0; $i < count($points); $i++) {
                $x = $i * $pointWidth + 50;
                @imagettftext($image, 10, 0, $x - 10, $imageHeight - 35, $black, $fontPath, (string)($i + 1)); // Τιμές εξωτερικά του άξονα
            }
        }

        imagepng($image, $filePath);
        imagedestroy($image);
    }

   
    /**
     * Creates a multi-line chart from the multi-dimensional array data.
     * 
     * @desc <English>  Creates a multi-line chart from the multi-dimensional array data and saves it to a specified file.
     * @desc <Greek>    Δημιουργεί ένα γράφημα πολλαπλών γραμμών από τα πολυδιάστατα δεδομένα του πίνακα και το αποθηκεύει σε ένα καθορισμένο αρχείο.
     * 
     * @param string $filePath <English>  The path to the file where the multi-line chart will be saved.
     *                         <Greek>    Η διαδρομή προς το αρχείο όπου θα αποθηκευτεί το γράφημα πολλαπλών γραμμών.
     * @return void
     */
    public function createMultiLineChart(string $filePath): void {
        $width = $this->properties['width'] ?? 800;
        $height = $this->properties['height'] ?? 600;
        $showAxes = $this->properties['showAxes'] ?? true; // Προαιρετική εμφάνιση άξονων
        $fontPath = $this->properties['fontPath'] ?? '/path/to/default/font.ttf';
        $backgroundColorIndex = $this->properties['backgroundColorIndex'] ?? 1;
        $lineColorIndices = $this->properties['lineColorIndices'] ?? [0, 1, 2, 3, 4];
        $axisColorIndex = $this->properties['axisColorIndex'] ?? 0;

        $image = imagecreatetruecolor($width, $height);
        $colorHandler = new TColorHandler();
        $backgroundColor = imagecolorallocate($image, ...$colorHandler->getColor($backgroundColorIndex));
        $axisColor = imagecolorallocate($image, ...$colorHandler->getColor($axisColorIndex));
        $black = imagecolorallocate($image, 0, 0, 0);

        imagefill($image, 0, 0, $backgroundColor);

        $colors = [];
        foreach ($lineColorIndices as $index) {
            $colors[] = imagecolorallocate($image, ...$colorHandler->getColor($index));
        }

        foreach ($this->array as $index => $arrayData) {
            $points = [];
            $yValues = array_column($arrayData, 'y');
            $maxValue = max($yValues);
            $pointWidth = ($width - 60) / (count($arrayData) - 1);
            $scale = ($height - 60) / $maxValue;

            foreach ($arrayData as $point) {
                $x = ($point['x'] - 1) * $pointWidth + 50;  // Υποθέτουμε ότι το x αρχίζει από το 1
                $y = $height - ($point['y'] * $scale) - 50;
                $points[] = [$x, $y];
            }

            for ($i = 0; $i < count($points) - 1; $i++) {
                @imageline($image, $points[$i][0], $points[$i][1], $points[$i + 1][0], $points[$i + 1][1], $colors[$index % count($colors)]);
            }
        }

        if ($showAxes) {
            // Προσθήκη άξονων Χ και Ψ
            imageline($image, 50, 10, 50, $height - 50, $axisColor); // Άξονας Υ
            imageline($image, 50, $height - 50, $width - 10, $height - 50, $axisColor); // Άξονας Χ

            // Προσθήκη τιμών στον άξονα Υ
            $maxValue = max(array_map(function($data) {
                return max(array_column($data, 'y'));
            }, $this->array));

            for ($i = 0; $i <= $maxValue; $i += round($maxValue / 10)) {
                $y = $height - ($i * $scale) - 50;
                @imagettftext($image, 10, 0, 20, $y + 5, $black, $fontPath, (string)$i); // Τιμές εξωτερικά του άξονα
            }

            // Προσθήκη τιμών στον άξονα Χ
            $maxX = max(array_map(function($data) {
                return max(array_column($data, 'x'));
            }, $this->array));

            for ($i = 0; $i < $maxX; $i++) {
                $x = $i * $pointWidth + 50;
                @imagettftext($image, 10, 0, $x - 10, $height - 35, $black, $fontPath, (string)($i + 1)); // Τιμές εξωτερικά του άξονα
            }
        }

        imagepng($image, $filePath);
        imagedestroy($image);
    }



    /**
     * Creates a 3D pie chart from the array data with labels using TrueType font and shades.
     * 
     * @desc <English>  Creates a 3D pie chart from the array data and saves it to a specified file.
     * @desc <Greek>    Δημιουργεί ένα τρισδιάστατο κυκλικό διάγραμμα από τα δεδομένα του πίνακα και το αποθηκεύει σε ένα καθορισμένο αρχείο.
     * 
     * @param string $filePath <English>  The path to the file where the pie chart will be saved.
     *                         <Greek>    Η διαδρομή προς το αρχείο όπου θα αποθηκευτεί το κυκλικό διάγραμμα.
     * @return void
     */
    public function createPieChart(string $filePath): void {
        $imageWidth = $this->properties['width'] ?? 800;
        $imageHeight = $this->properties['height'] ?? 600;
        $is3D = $this->properties['3D'] ?? false;
        $depth = $is3D ? 20 : 0;  // Το βάθος του τρισδιάστατου εφέ μόνο αν είναι ενεργοποιημένο
        $fontPath = $this->properties['fontPath'] ?? '/path/to/default/font.ttf';
        $backgroundColorIndex = $this->properties['backgroundColorIndex'] ?? 1;
        $colorIndices = $this->properties['colorIndices'] ?? range(0, 29);

        $image = imagecreatetruecolor($imageWidth, $imageHeight + $depth);  // Αύξηση του ύψους της εικόνας για το τρισδιάστατο εφέ
        $colorHandler = new TColorHandler();
        $backgroundColor = imagecolorallocate($image, ...$colorHandler->getColor($backgroundColorIndex));
        $shadowColor = imagecolorallocatealpha($image, 169, 169, 169, 75);  // Ημιδιαφανές γκρι χρώμα για τη σκιά

        imagefill($image, 0, 0, $backgroundColor);

        $total = array_sum(array_map(function($item) {
            return is_array($item) ? array_sum($item) : $item;
        }, $this->array));

        $startAngle = 0;
        $i = 0;

        if ($is3D) {
            // Δημιουργία σκιών για το τρισδιάστατο εφέ
            for ($j = $depth; $j > 0; $j--) {
                foreach ($this->array as $segment => $value) {
                    $segmentTotal = is_array($value) ? array_sum($value) : $value;
                    $endAngle = $startAngle + ($segmentTotal / $total) * 360;
                    imagefilledarc($image, $imageWidth / 2, $imageHeight / 2 + $j, $imageWidth - 20, $imageHeight - 20, $startAngle, $endAngle, $shadowColor, IMG_ARC_PIE);
                    $startAngle = $endAngle;
                }
            }
        }

        $startAngle = 0;

        foreach ($this->array as $segment => $value) {
            $baseColor = $colorHandler->getColor($colorIndices[$i % count($colorIndices)]);
            $color = imagecolorallocate($image, $baseColor[0], $baseColor[1], $baseColor[2]);

            $segmentTotal = is_array($value) ? array_sum($value) : $value;
            $endAngle = $startAngle + ($segmentTotal / $total) * 360;

            if (is_array($value)) {
                // Πολυδιάστατα δεδομένα
                $subTotal = array_sum($value);
                $subStartAngle = $startAngle;
                foreach ($value as $j => $subValue) {
                    $shadeFactor = 1 - ($j / count($value)) * 0.5;
                    $shadedColor = $colorHandler->getColor($colorIndices[$i % count($colorIndices)], $shadeFactor);
                    $shadedColorAlloc = @imagecolorallocate($image, $shadedColor[0], $shadedColor[1], $shadedColor[2]);
                    $subEndAngle = $subStartAngle + ($subValue / $subTotal) * ($endAngle - $startAngle);
                    imagefilledarc($image, $imageWidth / 2, $imageHeight / 2, $imageWidth - 20, $imageHeight - 20, $subStartAngle, $subEndAngle, $shadedColorAlloc, IMG_ARC_PIE);
                    $subStartAngle = $subEndAngle;
                }
            } else {
                // Μονοδιάστατα δεδομένα
                imagefilledarc($image, $imageWidth / 2, $imageHeight / 2, $imageWidth - 20, $imageHeight - 20, $startAngle, $endAngle, $color, IMG_ARC_PIE);
            }

            // Προσθήκη ετικέτας για το τμήμα της πίτας
            $middleAngle = deg2rad(($startAngle + $endAngle) / 2);
            $labelX = $imageWidth / 2 + cos($middleAngle) * ($imageWidth / 2.5);
            $labelY = $imageHeight / 2 + sin($middleAngle) * ($imageHeight / 2.5);
            $textColor = imagecolorallocate($image, 0, 0, 0);
            @imagettftext($image, 14, 0, $labelX - (strlen($segment) * 3), $labelY - 7, $textColor, $fontPath, $segment);

            $startAngle = $endAngle;
            $i++; // Αύξηση του μετρητή για τα χρώματα
        }

        imagepng($image, $filePath);
        imagedestroy($image);
    }


    /**
     * Creates a polar area chart from the array data.
     * 
     * @desc <English>  Creates a polar area chart from the array data and saves it to a specified file.
     * @desc <Greek>    Δημιουργεί ένα διάγραμμα πολικής περιοχής από τα δεδομένα του πίνακα και το αποθηκεύει σε ένα καθορισμένο αρχείο.
     * 
     * @param string $filePath <English>  The path to the file where the polar area chart will be saved.
     *                         <Greek>    Η διαδρομή προς το αρχείο όπου θα αποθηκευτεί το διάγραμμα πολικής περιοχής.
     * @return void
     */
    public function createPolarAreaChart(string $filePath): void {
        $width = $this->properties['width'] ?? 600;
        $height = $this->properties['height'] ?? 600;
        $fontPath = $this->properties['fontPath'] ?? '/path/to/default/font.ttf';
        $backgroundColorIndex = $this->properties['backgroundColorIndex'] ?? 1;
        $colorIndices = $this->properties['colorIndices'] ?? [0, 1, 2, 3, 4];
        $labels = $this->properties['labels'] ?? [];
        $labelsPerRow = $this->properties['labelsPerRow'] ?? 4;

        $extraHeight = !empty($labels) ? 200 : 0; // Προσθέτουμε ύψος μόνο αν υπάρχουν ετικέτες
        $image = imagecreatetruecolor($width, $height + $extraHeight);
        $colorHandler = new TColorHandler();
        $backgroundColor = imagecolorallocate($image, ...$colorHandler->getColor($backgroundColorIndex));
        imagefill($image, 0, 0, $backgroundColor);

        $colors = [];
        foreach ($colorIndices as $index) {
            $colors[] = imagecolorallocate($image, ...$colorHandler->getColor($index));
        }

        $total = array_sum($this->array);
        $startAngle = 0;
        $i = 0;

        foreach ($this->array as $segment => $value) {
            $angle = $value / $total * 360;
            $color = $colors[$i % count($colors)];
            $radius = $value / max($this->array) * 300;

            // Δημιουργία του τμήματος της πολικής περιοχής
            @imagefilledarc($image, $width / 2, $height / 2, $radius, $radius, $startAngle, $startAngle + $angle, $color, IMG_ARC_PIE);
            $startAngle += $angle;
            $i++;
        }

        // Προσθήκη ετικετών κάτω από το διάγραμμα αν υπάρχουν
        if (!empty($labels)) {
            $rows = ceil(count($labels) / $labelsPerRow); // Υπολογισμός αριθμού σειρών
            for ($row = 0; $row < $rows; $row++) {
                $labelY = $height + 10 + ($row * 30);
                for ($col = 0; $col < $labelsPerRow; $col++) {
                    $index = $row * $labelsPerRow + $col;
                    if ($index < count($labels)) {
                        $labelX = 20 + ($col * 150);
                        $boxColor = $colors[$index % count($colors)];
                        $label = $labels[$index];
                        $shortLabel = (strlen($label) > 15) ? substr($label, 0, 15) . '...' : $label;
                        imagefilledrectangle($image, $labelX, $labelY, $labelX + 20, $labelY + 20, $boxColor);
                        $textColor = imagecolorallocate($image, 0, 0, 0);
                        imagettftext($image, 12, 0, $labelX + 30, $labelY + 15, $textColor, $fontPath, $shortLabel);
                    }
                }
            }
        }

        imagepng($image, $filePath);
        imagedestroy($image);
    }



    /**
     * Creates a radar chart from the array data.
     * 
     * @desc <English>  Creates a radar chart from the array data and saves it to a specified file.
     * @desc <Greek>    Δημιουργεί ένα διάγραμμα ραντάρ από τα δεδομένα του πίνακα και το αποθηκεύει σε ένα καθορισμένο αρχείο.
     * 
     * @param string $filePath <English>  The path to the file where the radar chart will be saved.
     *                         <Greek>    Η διαδρομή προς το αρχείο όπου θα αποθηκευτεί το διάγραμμα ραντάρ.
     * @return void
     */
    public function createRadarChart(string $filePath): void {
        $width = $this->properties['width'] ?? 600;
        $height = $this->properties['height'] ?? 600;
        $fontPath = $this->properties['fontPath'] ?? '/path/to/default/font.ttf';
        $backgroundColorIndex = $this->properties['backgroundColorIndex'] ?? 1;
        $lineColorIndex = $this->properties['lineColorIndex'] ?? 0;
        $dataColorIndices = $this->properties['dataColorIndices'] ?? [2, 3, 4, 5];
        $labels = $this->properties['labels'] ?? [];
        $labelsPerRow = $this->properties['labelsPerRow'] ?? 4;
        $showAxes = $this->properties['showAxes'] ?? true;

        $extraHeight = !empty($labels) ? 100 : 0; // Προσθέτουμε ύψος μόνο αν υπάρχουν ετικέτες
        $image = imagecreatetruecolor($width, $height + $extraHeight);
        $colorHandler = new TColorHandler();
        $backgroundColor = imagecolorallocate($image, ...$colorHandler->getColor($backgroundColorIndex));
        $lineColor = imagecolorallocate($image, ...$colorHandler->getColor($lineColorIndex));
        $black = imagecolorallocate($image, 0, 0, 0);

        imagefill($image, 0, 0, $backgroundColor);

        $centerX = $width / 2;
        $centerY = $height / 2;
        $maxRadius = $width / 2 - 20;
        $numSegments = count($labels);
        $angleStep = 2 * M_PI / $numSegments;

        // Draw the radar chart grid
        for ($i = 0; $i < $numSegments; $i++) {
            $angle = $i * $angleStep;
            $x = $centerX + $maxRadius * cos($angle);
            $y = $centerY + $maxRadius * sin($angle);
            @imageline($image, $centerX, $centerY, $x, $y, $lineColor);
        }

        // Draw concentric circles for the grid
        if ($showAxes) {
            for ($i = 1; $i <= 5; $i++) {
                $radius = $maxRadius * ($i / 5);
                imageellipse($image, $centerX, $centerY, $radius * 2, $radius * 2, $lineColor);
            }

            // Προσθήκη τιμών στον άξονα Υ
            for ($i = 1; $i <= 5; $i++) {
                $radius = $maxRadius * ($i / 5);
                @imagettftext($image, 10, 0, $centerX + 5, $centerY - $radius - 5, $black, $fontPath, (string)($i * 20));
            }
        }

        // Draw the data points for each segment and add color markers
        $segmentColors = [];
        $segmentIndex = 0;
        foreach ($this->array as $segmentName => $values) {
            $dataColor = imagecolorallocate($image, ...$colorHandler->getColor($dataColorIndices[$segmentIndex % count($dataColorIndices)]));
            $segmentColors[$segmentIndex] = $dataColor;

            $numValues = count($values);
            $prevX = $centerX + $maxRadius * ($values[0] / max($values)) * cos(0);
            $prevY = $centerY + $maxRadius * ($values[0] / max($values)) * sin(0);
            imagefilledellipse($image, $prevX, $prevY, 8, 8, $dataColor); // Χρωματιστή κουκκίδα

            for ($i = 1; $i < $numValues; $i++) {
                $angle = $i * $angleStep;
                $value = $values[$i] / max($values);
                $x = $centerX + $maxRadius * $value * cos($angle);
                $y = $centerY + $maxRadius * $value * sin($angle);
                @imageline($image, $prevX, $prevY, $x, $y, $dataColor);
                @imagefilledellipse($image, $x, $y, 8, 8, $dataColor); // Χρωματιστή κουκκίδα
                $prevX = $x;
                $prevY = $y;
            }

            // Close the radar chart for each segment
            @imageline($image, $prevX, $prevY, $centerX + $maxRadius * ($values[0] / max($values)) * cos(0), $centerY + $maxRadius * ($values[0] / max($values)) * sin(0), $dataColor);

            $segmentIndex++;
        }

        // Προσθήκη ετικετών αν υπάρχουν
        if (!empty($labels)) {
            $rows = ceil(count($labels) / $labelsPerRow); // Υπολογισμός αριθμού σειρών
            for ($row = 0; $row < $rows; $row++) {
                $labelY = $height + 10 + ($row * 30);
                for ($col = 0; $col < $labelsPerRow; $col++) {
                    $index = $row * $labelsPerRow + $col;
                    if ($index < count($labels)) {
                        $labelX = 20 + ($col * 150);
                        $boxColor = $segmentColors[$index];
                        $label = $labels[$index];
                        $shortLabel = (strlen($label) > 15) ? substr($label, 0, 15) . '...' : $label;
                        imagefilledrectangle($image, $labelX, $labelY, $labelX + 20, $labelY + 20, $boxColor);
                        $textColor = imagecolorallocate($image, 0, 0, 0);
                        @imagettftext($image, 12, 0, $labelX + 30, $labelY + 15, $textColor, $fontPath, $shortLabel);
                    }
                }
            }
        }

        imagepng($image, $filePath);
        imagedestroy($image);
    }
    
            
    /**
     * Creates a scatter plot from the array data and additional data.
     * 
     * @desc <English>  Creates a scatter plot from the array data and additional data, and saves it to a specified file.
     * @desc <Greek>    Δημιουργεί ένα διάγραμμα διασποράς από τα δεδομένα του πίνακα και πρόσθετα δεδομένα, και το αποθηκεύει σε ένα καθορισμένο αρχείο.
     * 
     * @param array $additionalArray <English>  Additional array data to be included in the scatter plot.
     *                                <Greek>    Πρόσθετα δεδομένα του πίνακα που θα συμπεριληφθούν στο διάγραμμα διασποράς.
     * @param string $filePath <English>  The path to the file where the scatter plot will be saved.
     *                         <Greek>    Η διαδρομή προς το αρχείο όπου θα αποθηκευτεί το διάγραμμα διασποράς.
     * @return void
     */
    public function createScatterPlot(array $additionalArray, string $filePath): void {
        $width = $this->properties['width'] ?? 800;
        $height = $this->properties['height'] ?? 600;
        $backgroundColorIndex = $this->properties['backgroundColorIndex'] ?? 1;
        $dataColorIndex = $this->properties['dataColorIndex'] ?? 0;
        $additionalDataColorIndex = $this->properties['additionalDataColorIndex'] ?? 2;
        $showAxes = $this->properties['showAxes'] ?? true;
        $fontPath = $this->properties['fontPath'] ?? '/path/to/default/font.ttf';

        $image = imagecreatetruecolor($width, $height);
        $colorHandler = new TColorHandler();
        $backgroundColor = imagecolorallocate($image, ...$colorHandler->getColor($backgroundColorIndex));
        $dataColor = imagecolorallocate($image, ...$colorHandler->getColor($dataColorIndex));
        $additionalDataColor = imagecolorallocate($image, ...$colorHandler->getColor($additionalDataColorIndex));
        $black = imagecolorallocate($image, 0, 0, 0);

        imagefill($image, 0, 0, $backgroundColor);

        // Υπολογισμός των μέγιστων τιμών για να καθορίσουμε την κλίμακα
        $allXValues = array_merge(array_column($this->array, 'x'), array_column($additionalArray, 'x'));
        $allYValues = array_merge(array_column($this->array, 'y'), array_column($additionalArray, 'y'));
    
        $maxX = max($allXValues);
        $maxY = max($allYValues);

        // Σχεδίαση άξονων Χ και Ψ αν είναι ενεργοποιημένοι
        if ($showAxes) {
            imageline($image, 50, 10, 50, $height - 50, $black); // Άξονας Υ
            imageline($image, 50, $height - 50, $width - 10, $height - 50, $black); // Άξονας Χ

            // Προσθήκη τιμών στον άξονα Υ
            for ($i = 0; $i <= $maxY; $i += round($maxY / 10)) {
                $y = $height - ($i / $maxY * $height) - 50;
                imagettftext($image, 10, 0, 20, $y + 5, $black, $fontPath, (string)$i);
            }

            // Προσθήκη τιμών στον άξονα Χ
            for ($i = 0; $i <= $maxX; $i += round($maxX / 10)) {
                $x = ($i / $maxX * $width) + 50;
                imagettftext($image, 10, 0, $x - 10, $height - 35, $black, $fontPath, (string)$i);
            }
        }

        // Σχεδίαση των αρχικών δεδομένων
        foreach ($this->array as $point) {
            if (isset($point['x']) && isset($point['y'])) {
                $x = $point['x'] / $maxX * ($width - 60) + 50;
                $y = $height - ($point['y'] / $maxY * ($height - 60)) - 50;
                @imagefilledellipse($image, $x, $y, 5, 5, $dataColor);
            }
        }

        // Σχεδίαση των πρόσθετων δεδομένων
        foreach ($additionalArray as $point) {
            if (isset($point['x']) && isset($point['y'])) {
                $x = $point['x'] / $maxX * ($width - 60) + 50;
                $y = $height - ($point['y'] / $maxY * ($height - 60)) - 50;
                @imagefilledellipse($image, $x, $y, 5, 5, $additionalDataColor);
            }
        }

        imagepng($image, $filePath);
        imagedestroy($image);
    }


    /**
     * Creates a spline chart from the array data.
     * 
     * @desc <English> Creates a spline chart from the array data.
     * @desc <Greek> Δημιουργεί ένα διάγραμμα καμπυλών spline από τα δεδομένα του πίνακα.
     * 
     * @param string $filePath <English> The file path to save the spline chart image.
     *                         <Greek> Η διαδρομή του αρχείου για την αποθήκευση της εικόνας του διαγράμματος καμπυλών spline.
     * @return void
     */
    public function createSplineChart(string $filePath): void {
        $width = $this->properties['width'] ?? 800;
        $height = $this->properties['height'] ?? 600;
        $backgroundColorIndex = $this->properties['backgroundColorIndex'] ?? 1;
        $lineColorIndex = $this->properties['lineColorIndex'] ?? 2;
        $fontPath = $this->properties['fontPath'] ?? '/path/to/default/font.ttf';
        $showAxes = $this->properties['showAxes'] ?? true;

        $data = $this->array;

        // Δημιουργία της εικόνας
        $image = imagecreatetruecolor($width, $height);
        $colorHandler = new TColorHandler();
        $backgroundColor = imagecolorallocate($image, ...$colorHandler->getColor($backgroundColorIndex));
        $lineColor = imagecolorallocate($image, ...$colorHandler->getColor($lineColorIndex));
        $black = imagecolorallocate($image, 0, 0, 0);

        imagefilledrectangle($image, 0, 0, $width - 1, $height - 1, $backgroundColor);

        $maxValue = max($data);
        $numPoints = count($data);

        // Σχεδίαση άξονων Χ και Ψ αν είναι ενεργοποιημένοι
        if ($showAxes) {
            @imageline($image, 50, 10, 50, $height - 50, $black); // Άξονας Υ
            @imageline($image, 50, $height - 50, $width - 10, $height - 50, $black); // Άξονας Χ

            // Προσθήκη τιμών στον άξονα Υ
            for ($i = 0; $i <= $maxValue; $i += round($maxValue / 10)) {
                $y = $height - ($i / $maxValue * ($height - 60)) - 50;
                @imagettftext($image, 10, 0, 20, $y + 5, $black, $fontPath, (string)$i);
            }

            // Προσθήκη τιμών στον άξονα Χ
            for ($i = 0; $i < $numPoints; $i++) {
                $x = ($i / ($numPoints - 1) * ($width - 60)) + 50;
                @imagettftext($image, 10, 0, $x - 10, $height - 35, $black, $fontPath, (string)$i);
            }
        }

        // Σχεδιασμός διαγράμματος spline
        $previousX = 50;
        $previousY = $height - ($data[0] / $maxValue * ($height - 60)) - 50;

        for ($i = 1; $i < $numPoints; $i++) {
            $x = ($i / ($numPoints - 1) * ($width - 60)) + 50;
            $y = $height - ($data[$i] / $maxValue * ($height - 60)) - 50;

            @imageline($image, $previousX, $previousY, $x, $y, $lineColor);

            $previousX = $x;
            $previousY = $y;
        }

        imagepng($image, $filePath);
        imagedestroy($image);
    }



    /**
     * Creates a step chart from the array data.
     * 
     * @desc <English> Creates a step chart from the array data.
     * @desc <Greek> Δημιουργεί ένα διάγραμμα σκαλοπατιών από τα δεδομένα του πίνακα.
     * 
     * @param string $filePath <English> The file path to save the step chart image.
     *                         <Greek> Η διαδρομή του αρχείου για την αποθήκευση της εικόνας του διαγράμματος σκαλοπατιών.
     * @return void
     */
    public function createStepChart(string $filePath): void {
        $width = $this->properties['width'] ?? 800;
        $height = $this->properties['height'] ?? 600;
        $backgroundColorIndex = $this->properties['backgroundColorIndex'] ?? 1;
        $lineColorIndex = $this->properties['lineColorIndex'] ?? 0;
        $fontPath = $this->properties['fontPath'] ?? '/path/to/default/font.ttf';
        $showAxes = $this->properties['showAxes'] ?? true;

        $image = imagecreatetruecolor($width, $height);
        $colorHandler = new TColorHandler();
        $backgroundColor = imagecolorallocate($image, ...$colorHandler->getColor($backgroundColorIndex));
        $lineColor = imagecolorallocate($image, ...$colorHandler->getColor($lineColorIndex));
        $black = imagecolorallocate($image, 0, 0, 0);

        imagefill($image, 0, 0, $backgroundColor);

        // Υπολογισμός των μέγιστων τιμών για να καθορίσουμε την κλίμακα
        $maxX = max(array_column($this->array, 0));
        $maxY = max(array_column($this->array, 1));

        // Σχεδίαση άξονων Χ και Ψ αν είναι ενεργοποιημένοι
        if ($showAxes) {
            imageline($image, 50, 10, 50, $height - 50, $black); // Άξονας Υ
            imageline($image, 50, $height - 50, $width - 10, $height - 50, $black); // Άξονας Χ

            // Προσθήκη τιμών στον άξονα Υ
            for ($i = 0; $i <= $maxY; $i += round($maxY / 10)) {
                $y = $height - ($i / $maxY * ($height - 60)) - 50;
                imagettftext($image, 10, 0, 20, $y + 5, $black, $fontPath, (string)$i);
            }

            // Προσθήκη τιμών στον άξονα Χ
            for ($i = 0; $i <= $maxX; $i += round($maxX / 10)) {
                $x = ($i / $maxX * ($width - 60)) + 50;
                imagettftext($image, 10, 0, $x - 10, $height - 35, $black, $fontPath, (string)$i);
            }
        }

        $prevX = 50;
        $prevY = $height - ($this->array[0][1] / $maxY * ($height - 60)) - 50;

        for ($i = 1; $i < count($this->array); $i++) {
            $x = ($this->array[$i][0] / $maxX * ($width - 60)) + 50;
            $y = $height - ($this->array[$i][1] / $maxY * ($height - 60)) - 50;
            imageline($image, $prevX, $prevY, $x, $prevY, $lineColor);
            imageline($image, $x, $prevY, $x, $y, $lineColor);
            $prevX = $x;
            $prevY = $y;
        }

        imagepng($image, $filePath);
        imagedestroy($image);
    }



    /**
     * Checks if the new bubble position overlaps with any existing bubbles.
     *
     * @desc <English> Checks if the new bubble position overlaps with any existing bubbles.
     * @desc <Greek> Ελέγχει αν η νέα θέση της φυσαλίδας επικαλύπτεται με οποιαδήποτε υπάρχουσα φυσαλίδα.
     * 
     * @param int $x <English> X coordinate of the new bubble.
     *               <Greek> Συντεταγμένη Χ της νέας φυσαλίδας.
     * @param int $y <English> Y coordinate of the new bubble.
     *               <Greek> Συντεταγμένη Υ της νέας φυσαλίδας.
     * @param int $size <English> Size of the new bubble.
     *                  <Greek> Μέγεθος της νέας φυσαλίδας.
     * @param array $positions <English> Existing positions of the bubbles.
     *                         <Greek> Υπάρχουσες θέσεις των φυσαλίδων.
     * @return bool <English> True if the new bubble overlaps with any existing bubbles, false otherwise.
     *              <Greek> Επιστρέφει true αν η νέα φυσαλίδα επικαλύπτεται με οποιαδήποτε υπάρχουσα φυσαλίδα, διαφορετικά false.
     */
    private function isOverlap($x, $y, $size, $positions) {
        foreach ($positions as [$px, $py, $psize]) {
            if ($this->bubblesOverlap($x, $y, $size, $px, $py, $psize)) {
                return true;
            }
        }
        return false;
    }


    /**
     * Checks if two bubbles overlap.
     *
     * @desc <English> Checks if two bubbles overlap.
     * @desc <Greek> Ελέγχει αν δύο φυσαλίδες επικαλύπτονται.
     *
     * @param int $x1 <English> X coordinate of the first bubble.
     *                 <Greek> Συντεταγμένη Χ της πρώτης φυσαλίδας.
     * @param int $y1 <English> Y coordinate of the first bubble.
     *                 <Greek> Συντεταγμένη Υ της πρώτης φυσαλίδας.
     * @param int $size1 <English> Size of the first bubble.
     *                   <Greek> Μέγεθος της πρώτης φυσαλίδας.
     * @param int $x2 <English> X coordinate of the second bubble.
     *                 <Greek> Συντεταγμένη Χ της δεύτερης φυσαλίδας.
     * @param int $y2 <English> Y coordinate of the second bubble.
     *                 <Greek> Συντεταγμένη Υ της δεύτερης φυσαλίδας.
     * @param int $size2 <English> Size of the second bubble.
     *                   <Greek> Μέγεθος της δεύτερης φυσαλίδας.
     * @return bool <English> True if the bubbles overlap, false otherwise.
     *              <Greek> Επιστρέφει true αν οι φυσαλίδες επικαλύπτονται, διαφορετικά false.
     */
    private function bubblesOverlap($x1, $y1, $size1, $x2, $y2, $size2) {
        $distance = sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2));
        return $distance < (($size1 + $size2) / 2);
    }

}
/******************************************************************************
 * @endcode TArrayGraphHandler
 *****************************************************************************/

?>