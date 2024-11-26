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
 * @subpackage         	: ASCOOS FRAMEWORK Core Autoloader Files
 * @source             	: [ASCOOS FRAMEWORK (AFW)]/autoloader.php
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
namespace ASCOOS\FRAMEWORK\Autoloader;

defined ("ALEXSOFT_RUN_CMS") or die("Prohibition of Access.");
defined ("ASCOOS_FRAMEWORK_RUN") or die("Prohibition of Access.");

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class TAutoloader {    
    private $libDir;
    private $kernelDir;

    public function __construct($libDir = __DIR__.'/libs/', $kernelDir = __DIR__.'/kernel/') {
        $this->libDir = $libDir;
        $this->kernelDir = $kernelDir;
    }

    public function includeLibraries() {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->libDir));
        foreach ($iterator as $file) {
            if ($file->isFile() && basename($file) === 'autoload.php') {
                require_once str_replace('\\', '/', $file->getPathname());
            }
        }
    }

    public function includeCoreFiles() {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->kernelDir));
        foreach ($iterator as $file) {
            if ($file->isFile() && preg_match('/^core.*\.php$/', $file->getFilename())) {
                require_once str_replace('\\', '/', $file->getPathname());
            }
        }
    }

    public function includeImplementationFiles() {
        $implementationDir = $this->kernelDir . 'implementation/';
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($implementationDir));
        foreach ($iterator as $file) {
            if ($file->isFile() && preg_match('/.*\.php$/', $file->getFilename())) {
                require_once str_replace('\\', '/', $file->getPathname());
            }
        }
    }   
}

?>
