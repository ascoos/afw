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
 * @subpackage         	: ASCOOS FRAMEWORK Core Disks Drives Information Implementation File
 * @source             	: [ASCOOS FRAMEWORK (AFW)]/kernel/implementation/TDriveInfo.php
 * @fileNo             	: 
 * @version            	: 24.0.1
 * @created            	: 2024-07-01 20:00:00 UTC+3 
 * @updated            	: 2024-11-27 07:00:00 UTC+3
 * @author             	: Drogidis Christos
 * @authorSite         	: www.alexsoft.gr
 * @license 			: AGL-F
 * 
 * @since PHP 8.2.0
 */
namespace ASCOOS\FRAMEWORK\Kernel\Implementation\TDriveInfo;
defined ("ALEXSOFT_RUN_CMS") or die("Prohibition of Access.");
defined ("ASCOOS_FRAMEWORK_RUN") or die("Prohibition of Access.");

trait CoreDisks_TDriveInfo_implementation 
{
    public function __construct($User=null) {
        if (is_null($User)) {
            $this->user = null;
        } else {
            $this->setUser($User);
            $this->execute();
        }
    }

    public function setUser($User=null): void 
    {
        $this->user = $User;
    }
    
    public function execute(): array 
    {
        $this->drives = $this->detectDrives($this->user);
        return $this->getDriveInfo();
    }

    private function detectDrives($User): array 
    {
        $drives = [];

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // Windows
            exec('wmic logicaldisk get caption', $output);
            foreach ($output as $line) {
                if (preg_match('/([A-Z]:)/', $line, $matches)) {
                    $drives[] = $matches[1];
                }
            }
        } else {
            // Linux και macOS
            if (!is_null($User) && (is_string($User) && !empty($User)))
                $homeDirs = ['/home/'.$User, getenv('HOME/'.$User)];
            else
                $homeDirs = ['/home', getenv('HOME')];

            foreach ($homeDirs as $dir) {
                if (is_dir($dir)) {
                    $drives[] = $dir;
                }
            }
        }

        return $drives;
    }

    public function getDriveInfo(): array
    {
        $driveInfo = [];
        foreach ($this->drives as $drive) {
            $totalSpace = @disk_total_space($drive);
            $freeSpace = @disk_free_space($drive);
            if ($totalSpace !== false && $freeSpace !== false) {
                $usedSpace = $totalSpace - $freeSpace;
                $driveInfo[$drive] = [
                    'total' => $this->formatBytes($totalSpace),
                    'used' => $this->formatBytes($usedSpace),
                    'free' => $this->formatBytes($freeSpace)
                ];
            } else {
                if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
                    $driveInfo[$drive] = 'It is not a valid disk or its size cannot be read.';
                else
                    $driveInfo[$drive] = 'It is not a valid directory or its size cannot be read.';
            }
        }
        return $driveInfo;
    } 
    
    
    public function getDrivesSize(): array
    {
        $driveSize = [];
        foreach ($this->drives as $drive) {
            $totalSpace = @disk_total_space($drive);
            $freeSpace = @disk_free_space($drive);
            if ($totalSpace !== false && $freeSpace !== false) {
                $usedSpace = $totalSpace - $freeSpace;
                $driveSize[$drive] = [
                    'total' => $totalSpace,
                    'used' => $usedSpace,
                    'free' => $freeSpace
                ];
            } else {
                if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
                    $driveSize[$drive] = 'It is not a valid disk or its size cannot be read.';
                else
                    $driveSize[$drive] = 'It is not a valid directory or its size cannot be read.';
            }
        }
        return $driveSize;
    }     

}

?>