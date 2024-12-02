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
 * @subpackage         	: Core Disks Library
 * @source             	: afw/kernel/coreDisks.php
 * @fileNo             	: 
 * @version            	: 24.0.3
 * @created            	: 2024-07-01 20:00:00 UTC+3 
 * @updated            	: 2024-12-02 07:00:00 UTC+3 
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


/**
 * @class TDriveInfo
 * @extends parent<TObject>
 * 
 * @desc <English>  This class manages disk information.
 * @desc <Greek>    Η κλάση αυτή διαχειρίζεται τις πληροφορίες των δίσκων.
 * 
 * 
 * [ PROPERTIES]
 * It has only private properties
 * 
 * [ METHODS ] 
 * @method  public  function __construct($User=null)
 * @method  public  function execute(): array 
 * @method  private function detectDrives($User): array 
 * @method  private function formatBytes($bytes, $precision = 2): string
 * @method  public  function getDriveInfo(): array
 * @method  public function getDrivesSize(): array
 * @method  public  function setUser($User=null): void 
 * 
 * [ INHERITANCE ]
 * @method string __toString()                      Returns a string containing the name of this class.
 * @method bool Free(object $object)                Frees the memory of the Object or its clone.
 * @method bool FreeProperties(object $object)      Delete and Frees up memory for all class properties.
 * @method bool getClassDeprecated()                Returns true if class is deprecated, otherwise false.
 * @method int getClassVersion()                    We get the version of the class.
 * @method array getProperties()                    Returns the table of class properties.
 * @method mixed getProperty(string $property)      Returns the content of the requested property.
 * @method ?array getPublicProperties()             Returns an array of the public properties of the class.
 * @method int|false getVersion(string $property)   Get the version as an integer.       
 * @method string|false getVersionStr(string $property)     Get the version as a formatted string.
 * @method bool isExecutable(int $currentVersion, int $currentPHPVersion)  Checks whether the current version of the class is executable according to the minimum and maximum versions you specify.
 * @method void setProjectVersion(int|string $version = -1)     Sets the project version.
 * @method void setProperties(array $properties)    Set the properties of the class.
 * @method void setProperty(string $property, mixed $value)   Set a single property of the class.
 */
use ASCOOS\FRAMEWORK\Kernel\Implementation\TDriveInfo\CoreDisks_TDriveInfo_implementation;
use ASCOOS\FRAMEWORK\Kernel\Implementation\Methods\func_formatBytes;
class TDriveInfo extends TObject 
{
    // [ PROPERTIES]   
    private array $drives = [];
    private ?string $user = null;

    // [ METHODS ]

    /**
     * Constructor.
     * 
     * @desc <English>  Initialize the class. It must be called by the offspring if the classes are initialized.
     * @desc <Greek>    Αρχικοποιεί την κλάση. Πρέπει να καλείται από τα παραγόμενα αν οι κλάσεις αρχικοποιούνται.
     * 
     * @param array $properties   <English>  An associative array of properties to initialize the class with.
     *                            <Greek>    Ένας συσχετιστικός πίνακας ιδιοτήτων για την αρχικοποίηση της κλάσης.
     */     
    public function __construct(?string $User=null, array $properties = []) 
    {
        /*
        <English>
            If there are new properties for the class, we pass them to the properties table 
            by calling the parent constructor.
        </English>
        <Greek>
            Εάν υπάρχουν νέες ιδιότητες για την κλάση, τις περνάμε στον πίνακα ιδιοτήτων 
            καλώντας τον προγονικό κατασκευαστή.
        </Greek>
        */
        parent::__construct($properties);
        
        /*
        <English>
            I If the $User is blank we simply update the internal property of the user, 
            otherwise we update the internal property of the user and perform 
            the predefined functions of the class
        </English>
        <Greek>
            Εάν το $User είναι κενό απλώς ενημερώνουμε την εσωτερική ιδιότητα του χρήστη,
            αλλιώς ενημερώνουμε την εσωτερική ιδιότητα του χρήστη 
            και εκτελούμε τις προκαθορισμένες λειτουργίες της κλάσης.
        </Greek>
        */
        if (is_null($User)) {
            $this->user = null;
        } else {
            $this->setUser($User);
            $this->execute();
        }
    }

    USE CoreDisks_TDriveInfo_implementation;
    USE func_formatBytes;
}
//$PDriveInfo = new TDriveInfo;   // Class Object Pointer Variable

?>