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
 * @subpackage         	: ASCOOS FRAMEWORK Implementation Methods File
 * @source             	: [ASCOOS FRAMEWORK (AFW)]/kernel/implementation/Methods.php
 * @fileNo             	: 
 * @version            	: 24.0.0
 * @created            	: 2024-07-01 20:00:00 UTC+3 
 * @updated            	: 
 * @author             	: Drogidis Christos
 * @authorSite         	: www.alexsoft.gr
 * @license 			: AGL-F
 * 
 * @since PHP 8.2.0
 */
namespace ASCOOS\FRAMEWORK\Kernel\Implementation\Methods;
defined ("ALEXSOFT_RUN_CMS") or die("Prohibition of Access.");
defined ("ASCOOS_FRAMEWORK_RUN") or die("Prohibition of Access.");

trait func_formatBytes {
    private function formatBytes($bytes, $precision = 2): string {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }    
}


trait func_free {
    /**
     * Frees the memory of the Object or its clone 
     * 
     * @param object $object    Object of class for free
     * @return bool
     */
    final public function Free(object $object): bool
    {
        if (is_object($object)) {
            unset($object);
            memory_reset_peak_usage();
            return true;
        }
        return false;
    } 
}

trait func_FreeProperties {
    final public function FreeProperties(object $object): bool
    {
        if (is_object($object)) {
            foreach (get_object_vars($object) as $key => $value) {
                unset($object->$key);
            }
            memory_reset_peak_usage();
            return true;
        }
        return false;
    }
}






?>