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
 * @subpackage         	: ASCOOS FRAMEWORK Core Disks Example File
 * @source             	: [ASCOOS FRAMEWORK (AFW)]/tests/disks_drives.php
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

declare(strict_types=1);

require_once "../autoload.php";

use ASCOOS\FRAMEWORK\Kernel\Core\TError;


/**
 * Use this for $driveInfo = new TDriveInfo;
 * 
 * UnEnabled the [ $PDriveInfo = new TDriveInfo; ] 
 * to the end of class "TDriveInfo" in file "kernel/coreDisks.php"
 */ 
use ASCOOS\FRAMEWORK\Kernel\Disks\TDriveInfo;


$user = null; // OR User. If null, in Linux = /home/

//  $driveInfo = clone $PDriveInfo;           // Create Clone of Class Object Pointer Variable
$driveInfo = new TDriveInfo;                    // Create Class Object Pointer Variable
try {            
    $driveInfo->setUser($user);           // Set user
    $info = $driveInfo->execute();              // Execute and return Drives data    
    echo "CLASS : ". $driveInfo . "<br>";       // Return namespace = ASCOOS\FRAMEWORK\Kernel\Disks\TDriveInfo
    echo "PHP VERSION : ".PHP_VERSION."<hr>";   


    foreach ($info as $drive => $sizes) {
        if (is_array($sizes)) {
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')         
                echo "<br><b>Drive $drive </b><br>";
            else
                echo "<br><b>Directory $drive </b><br>";  

            echo "Total Size: " . $sizes['total'] . "<br>";
            echo "Used space: " . $sizes['used'] . "<br>";
            echo "Free space: " . $sizes['free'] . "<br>";
            echo "<br>";
        } else {
            echo "<br><b>Drive $drive </b>" . $sizes . "<br>";
        }
    }  
} catch (TError $te) {
    echo $te;
    $te->Free($te);
} finally {
    try {
        $driveInfo->Free($driveInfo); // Free Memory for Clone object
    } catch (TError $e) {     
        echo "Memory for object <b>[". vn($driveInfo)."]</b> of class <b>[$driveInfo]</b> has not been released" . "<br>";
        echo $e;
        $e->Free($e);
    } finally {
        echo "Memory for object <b>[". vn($driveInfo)."]</b> of class <b>[$driveInfo]</b> have is released" . "<br>";
    }
}

/**
 * Releases memory for master class Object . 
 * If use as Cron, then not release memory of the class pointer
 */
//$PDriveInfo->Free($PDriveInfo);     

?>