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
 * @subpackage         	: Core Functions Library
 * @source             	: afw/kernel/coreFunctions.php
 * @fileNo             	: 
 * @version            	: 24.0.6
 * @created            	: 2024-07-01 20:00:00 UTC+3 
 * @updated            	: 2024-12-15 07:00:00 UTC+3 
 * @author             	: Drogidis Christos
 * @authorSite         	: www.alexsoft.gr
 * @license 			: AGL-F
 * 
 * @since PHP 8.2
 */
declare(strict_types=1);

defined ("ALEXSOFT_RUN_CMS") or die("Prohibition of Access.");
defined ("ASCOOS_FRAMEWORK_RUN") or die("Prohibition of Access.");

use ASCOOS\FRAMEWORK\Kernel\Core\TError;

/**
 * [ LIST FUNCTIONS ]
 * 
 * @function bool array_is_empty(array $array)  Checks if an array is empty.
 * @function string formatBytes()               Returns the size of bytes in a formatted string 
 *                                                  e.g. 20.4 KB, 230.2 MB, 20.5 GB, etc.
 * @function bool is_even()                     Checking if a number is even
 * @function bool is_odd()                      Checking if a number is odd 
 * @function string|false vn()                  Returns the name of a variable as a string. Otherwise it returns false
 * @function string intToVersionString(int $number, string $mask = 'X.XX.XX')           Converts an integer to a version string format using a mask.
 * @function int versionStringToInt(string $versionString, string $mask = 'X.XX.XX')    Converts a version string format to an integer using a mask.
 */


 
/**
 * Returns the size of bytes in a formatted string e.g. 20.4 KB, 230.2 MB, 20.5 GB, etc.
 * 
 * @param int $bytes
 * @param int $precision = 2    [optional] The optional number of decimal digits.
 * @return string
 * 
 * @version 24.0.0
 */
function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    $bytes /= pow(1024, $pow);

    return round($bytes, $precision) . ' ' . $units[$pow];
}


/**
 * @function string|false vn($var)
 * 
 * Returns the name of a variable as a string. Otherwise it returns false
 * 
 * @param mixed $var    The Variable
 * @return string|false
 * 
 * @version 24.0.0
 */
function vn($var): string|false
{
    foreach ($GLOBALS  as $vn => $val) {
        if ($val === $var) {
            return "$".$vn;
        }
    }
    return false;
}


/**
 * @function even(int $number): bool
 * 
 * Checking if a number is even 
 * 
 * @param mixed $number     The number to be checked.
 * @return bool             Returns true if even, otherwise false.
 * 
 * @version 24.0.0
 */
function is_even($number): bool
{
    return (intval($number) % 2 == 0) ? true : false; 
}

/**
 * @function is_odd(int $number): bool
 * 
 * Checking if a number is odd 
 * 
 * @param mixed $number     The number to be checked.
 * @return bool             Returns true if odd, otherwise false.
 * 
 * @version 24.0.0
 */
function is_odd($number): bool
{
    return !is_even($number); 
}




/**
 * Checks if an array is empty.
 * 
 * @desc <English>  Checks if an array is empty and handles exceptions using TError.
 * @desc <Greek>    Ελέγχει εάν ένας πίνακας είναι κενός και διαχειρίζεται εξαιρέσεις χρησιμοποιώντας την TError.
 * 
 * @param array $array <English>  The array to check.
 *                      <Greek>    Ο πίνακας που θα ελεγχθεί.
 * @return bool <English>  Returns true if the array is empty, otherwise false.
 *               <Greek>    Επιστρέφει true αν ο πίνακας είναι κενός, αλλιώς false.
 * 
 * @version 24.0.0
 */
function array_is_empty(array $array): bool
{
    if (!is_array($array))     
        trigger_error('array_is_empty(): expects Argument #1 to be array, '.gettype($array).' given', E_USER_WARNING);

    /*
    <English>
        Check if the array is empty. 
        If it has elements, set return value to false, otherwise set to true.
    </English>
    <Greek>
        Ελέγχει αν ο πίνακας είναι κενός. 
        Αν έχει στοιχεία, ορίζει την τιμή επιστροφής σε false, αλλιώς την ορίζει σε true.
    </Greek>
    */
    return empty($array);
}




/**
 * Converts an integer to a version string format using a mask.
 * 
 * @desc <English> Converts an integer to a version string format using a mask.
 * @desc <Greek> Μετατρέπει έναν ακέραιο αριθμό σε μορφή έκδοσης string χρησιμοποιώντας μια μάσκα.
 * 
 * @param int $number <English> The integer number to be converted.
 *                    <Greek> Ο ακέραιος αριθμός που θα μετατραπεί.
 * @param string $mask <English> The mask for the version format.
 *                     <Greek> Η μάσκα για τη μορφή της έκδοσης.
 * @return string <English> The version format as a string.
 *                <Greek> Η μορφή της έκδοσης ως string.
 * 
 * @version 24.0.0
 */
function intToVersionString(int $number, string $mask = 'X.XX.XX'): string {
    /*
    <English>
        Convert number to string to manipulate it.
    </English>
    <Greek>
        Μετατροπή αριθμού σε string για επεξεργασία του.
    </Greek>
    */
    $numberStr = (string)$number;
    $numberLength = strlen($numberStr);

    /*
    <English>
        Remove separators from the mask and count X's.
    </English>
    <Greek>
        Αφαίρεση διαχωριστικών από τη μάσκα και μέτρηση των X.
    </Greek>
    */
    $maskNoSeparators = str_replace('.', '', $mask);
    $maskLength = strlen($maskNoSeparators);

    /*
    <English>
        If the number is shorter than the mask, pad with leading zeros.
    </English>
    <Greek>
        Αν ο αριθμός είναι μικρότερος από τη μάσκα, συμπλήρωση με μηδενικά.
    </Greek>
    */
    if ($numberLength < $maskLength) {
        $numberStr = str_pad($numberStr, $maskLength, '0', STR_PAD_LEFT);
    }

    /*
    <English>
        Replace X's in the mask with the number's digits, without trimming build part yet.
    </English>
    <Greek>
        Αντικατάσταση των X στη μάσκα με τα ψηφία του αριθμού.
    </Greek>
    */
    $formatted = '';
    $numberIndex = 0;
    for ($i = 0; $i < strlen($mask); $i++) {
        if ($mask[$i] === 'X' && isset($numberStr[$numberIndex])) {
            $formatted .= $numberStr[$numberIndex];
            $numberIndex++;
        } else {
            $formatted .= $mask[$i];
        }
    }

    /*
    <English>
        Handle the build part specifically.
    </English>
    <Greek>
        Επεξεργασία του μέρους build.
    </Greek>
    */
    $formattedParts = explode('.', $formatted);
    if (count($formattedParts) === 4) {
        $buildMaskLength = strlen(explode('.', $mask)[3]); // Calculate the length of the build part from the mask
        // Υπολογισμός μήκους build από τη μάσκα
        
        /*
        <English>
            Take remaining part for the build section.
        </English>
        <Greek>
            Λήψη του υπόλοιπου μέρους για το build.
        </Greek>
        */
        $remainingBuildPart = substr($numberStr, $maskLength - $buildMaskLength);

        /*
        <English>
            Remove leading zeros first.
        </English>
        <Greek>
            Αφαίρεση μηδενικών από την αρχή.
        </Greek>
        */
        $remainingBuildPart = ltrim($remainingBuildPart, '0');
        
        /*
        <English>
            If the build part is shorter than the mask length, pad with trailing zeros.
        </English>
        <Greek>
            Αν το μέρος build είναι μικρότερο από τη μάσκα, συμπλήρωση με μηδενικά στο τέλος.
        </Greek>
        */
        $remainingBuildPart = str_pad($remainingBuildPart, $buildMaskLength, '0', STR_PAD_RIGHT);

        /*
        <English>
            If the build part exceeds the mask length, trim excess digits from the end.
        </English>
        <Greek>
            Αν το μέρος build υπερβαίνει το μήκος της μάσκας, αποκοπή από το τέλος.
        </Greek>
        */
        if (strlen($remainingBuildPart) > $buildMaskLength) {
            $remainingBuildPart = substr($remainingBuildPart, 0, $buildMaskLength);
        }

        /*
        <English>
            Assign back to the parts array.
        </English>
        <Greek>
            Ανάθεση πίσω στο array των μερών.
        </Greek>
        */
        $formattedParts[3] = $remainingBuildPart;
    }
    $formatted = implode('.', $formattedParts);

    return $formatted;
}


/**
 * Converts a version string format to an integer using a mask.
 * 
 * @desc <English> Converts a version string format to an integer using a mask.
 * @desc <Greek> Μετατρέπει μια μορφή έκδοσης string σε ακέραιο χρησιμοποιώντας μια μάσκα.
 * 
 * @param string $versionString <English> The version format as a string.
 *                              <Greek> Η μορφή της έκδοσης ως string.
 * @param string $mask <English> The mask for the version format.
 *                     <Greek> Η μάσκα για τη μορφή της έκδοσης.
 * @return int <English> The integer number resulting from the conversion.
 *             <Greek> Ο ακέραιος αριθμός που προκύπτει από τη μετατροπή.
 * 
 * @version 24.0.0
 */
function versionStringToInt(string $versionString, string $mask = 'X.XX.XX'): int {
    /*
    <English>
        Extract digits from the version string based on the mask.
    </English>
    <Greek>
        Εξαγωγή ψηφίων από τη μορφή έκδοσης βάσει της μάσκας.
    </Greek>
    */
    $numberStr = '';
    $versionIndex = 0;
    for ($i = 0; $i < strlen($mask); $i++) {
        if ($mask[$i] === 'X' && isset($versionString[$versionIndex])) {
            $numberStr .= $versionString[$versionIndex];
            $versionIndex++;
        } elseif ($mask[$i] !== 'X') {
            /*
            <English>
                Skip the mask separators in the version string.
            </English>
            <Greek>
                Παράκαμψη διαχωριστικών στη μορφή έκδοσης.
            </Greek>
            */            
            if ($versionString[$versionIndex] === $mask[$i]) {
                $versionIndex++;
            }
        }
    }

    /*
    <English>
        Convert the extracted digits back to an integer.
    </English>
    <Greek>
        Μετατροπή εξαγόμενων ψηφίων πίσω σε ακέραιο αριθμό.
    </Greek>
    */
    return intVal($numberStr);
}



?>