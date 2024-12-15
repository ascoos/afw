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
 * @subpackage         	: ASCOOS FRAMEWORK Core TObject Example File
 * @source             	: afw/tests/TObject.getDeepProperty.php
 * @fileNo             	: 
 * @version            	: 24.0.6
 * @created            	: 2024-12-15 07:00:00 UTC+3 
 * @updated            	: 
 * @author             	: Drogidis Christos
 * @authorSite         	: www.alexsoft.gr
 * @license 			: AGL-F
 * 
 * @since PHP 8.2.0
 */

declare(strict_types=1);

require_once "../autoload.php";

use ASCOOS\FRAMEWORK\Kernel\Core\TObject;


class TExampleObject extends TObject
{
    /**
     * Constructor.
     * 
     * @desc <English>  Initialize the class with given properties.
     * @desc <Greek>    Αρχικοποιεί την κλάση με τις παρεχόμενες ιδιότητες.
     * 
     * @param array $properties   <English>  An associative array of properties to initialize the class with.
     *                            <Greek>    Ένας συσχετιστικός πίνακας ιδιοτήτων για την αρχικοποίηση της κλάσης.
     */
    public function __construct(array $properties = [])
    {
        parent::__construct($properties);
    }
}

/*
<English>   Example of use the TExampleObject class
<Greek>     Παράδειγμα χρήσης της κλάσης TExampleObject
*/
$example = new TExampleObject([
    'config' => [
        'extensions' => [
            'subExtension1' => ['version' => '1.0.0'],
            'subExtension2' => ['enabled' => true]
        ],
        'newProperty' => 'newValue'
    ]
]);

/*
<English>   Get a deep property 'version' for 'subExtension1' in the 'extensions' array.
<Greek>     Ανάκτηση μιας βαθιάς ιδιότητας 'version' για το 'subExtension1' στον πίνακα 'extensions'.
*/
$version = $example->getDeepProperty(['config', 'extensions', 'subExtension1', 'version']);
echo "Version: $version\n";

/*
<English>   Get a deep property 'enabled' for 'subExtension2' in the 'extensions' array.
<Greek>     Ανάκτηση μιας βαθιάς ιδιότητας 'enabled' για το 'subExtension2' στον πίνακα 'extensions'.
*/
$enabled = $example->getDeepProperty(['config', 'extensions', 'subExtension2', 'enabled']);
echo "Enabled: " . ($enabled ? 'true' : 'false') . "\n";

/*
<English>   Get a deep property 'newProperty' at the 'config' level.
<Greek>     Ανάκτηση μιας βαθιάς ιδιότητας 'newProperty' στο επίπεδο του 'config'.
*/
$newProperty = $example->getDeepProperty(['config', 'newProperty']);
echo "New Property: $newProperty\n";

/*
<English>   Print the properties for control
<Greek>     Εκτύπωση των ιδιοτήτων για έλεγχο
*/
print_r($example->getProperties());

?>