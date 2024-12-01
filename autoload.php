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
 * @subpackage         	: ASCOOS FRAMEWORK Core Autoload Files
 * @source             	: [ASCOOS FRAMEWORK (AFW)]/autoload.php
 * @fileNo             	: 
 * @version            	: 24.0.2
 * @created            	: 2024-07-01 20:00:00 UTC+3 
 * @updated            	: 2024-11-29 07:00:00 UTC+3 
 * @author             	: Drogidis Christos
 * @authorSite         	: www.alexsoft.gr
 * @license 			: AGL-F
 * 
 * @since PHP 8.2.0
 */
//declare(strict_types=1);
defined ("ALEXSOFT_RUN_CMS") OR define ("ALEXSOFT_RUN_CMS", True);
defined('ASCOOS_RUN') OR define('ASCOOS_RUN', True);
define('ASCOOS_FRAMEWORK_RUN', True);

// Φορτώνουμε την βιβλιοθήκη υποστήριξης παλαιότερων εκδόσεων.
if (file_exists('libs/phpBCL8/autoload.php')) require_once "libs/phpBCL8/phpbcl8_autoload.php";

require_once "autoloader.php";
require_once "kernel/implementation/Methods.php";
require_once "kernel/coreKernel.php";



use ASCOOS\FRAMEWORK\Autoloader\TAutoloader;

// Δημιουργούμε αντικείμενο της κλάσης TAutoloader
$autoloader = new TAutoloader();

// Συμπεριλαμβάνουμε τα αρχεία *.php από τον φάκελο kernel/implementation 
$autoloader->includeImplementationFiles();

// Συμπεριλαμβάνουμε τα αρχεία core*.php από τον φάκελο kernel
$autoloader->includeCoreFiles();

// Συμπεριλαμβάνουμε τα αρχεία autoload.php από τους υποφακέλους των βιβλιοθηκών
$autoloader->includeLibraries();



?>