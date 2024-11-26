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
 * @subpackage         	: ASCOOS FRAMEWORK Core Disks Library File
 * @source             	: [ASCOOS FRAMEWORK (AFW)]/kernel/coreDisks.php
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
namespace ASCOOS\FRAMEWORK\Kernel\Disks;

defined ("ALEXSOFT_RUN_CMS") or die("Prohibition of Access.");
defined ("ASCOOS_FRAMEWORK_RUN") or die("Prohibition of Access.");


use ASCOOS\FRAMEWORK\Kernel\Core\TObject;

require_once "implementation/TDriveInfo.php";



/**
 * @class TDriveInfo
 * @extends parent<TObject>
 * 
 * [ PROPERTIES]
 * @private array $drives = [];
 * @private ?string $user = null;
 * 
 * [ METHODS ] 
 * @method  public  function __construct($User=null)
 * @method  public  function execute(): array 
 * @method  private function detectDrives($User): array 
 * @method  private function formatBytes($bytes, $precision = 2): string
 * @method  public  function getDriveInfo(): array
 * @method  public  function setUser($User=null): void 
 */
use ASCOOS\FRAMEWORK\Kernel\Implementation\TDriveInfo\CoreDisks_TDriveInfo_implementation;
use ASCOOS\FRAMEWORK\Kernel\Implementation\Methods\func_formatBytes;
class TDriveInfo extends TObject 
{
    // [ PROPERTIES]   
    private array $drives = [];
    private ?string $user = null;

    // [ METHODS ]
    USE CoreDisks_TDriveInfo_implementation;
    USE func_formatBytes;
}
//$PDriveInfo = new TDriveInfo;   // Class Object Pointer Variable

?>