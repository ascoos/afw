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
 * @subpackage         	: ASCOOS FRAMEWORK Core Functions Library File
 * @source             	: [ASCOOS FRAMEWORK (AFW)]/kernel/coreFunctions.php
 * @fileNo             	: 
 * @version            	: 24.0.0
 * @created            	: 2024-07-01 20:00:00 UTC+3 
 * @updated            	: 
 * @author             	: Drogidis Christos
 * @authorSite         	: www.alexsoft.gr
 * @license 			: AGL-F
 * 
 * @since PHP 8.2
 */
declare(strict_types=1);
defined ("ALEXSOFT_RUN_CMS") or die("Prohibition of Access.");
defined ("ASCOOS_FRAMEWORK_RUN") or die("Prohibition of Access.");


/**
 * LIST FUNCTIONS
 * @function string formatBytes()   Returns the size of bytes in a formatted string e.g. 20.4 KB, 230.2 MB, 20.5 GB, etc.
 * @function string|false vn($var)  Returns the name of a variable as a string. Otherwise it returns false
 */


 
/**
 * Returns the size of bytes in a formatted string e.g. 20.4 KB, 230.2 MB, 20.5 GB, etc.
 * 
 * @param int $bytes
 * @param int $precision = 2    [optional] The optional number of decimal digits.
 * @return string
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


?>