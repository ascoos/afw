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
 * @subpackage         	: Main Core Handles
 * @source             	: afw/kernel/coreKernel.php
 * @fileNo             	: 
 * @version            	: 24.0.5
 * @created            	: 2024-07-01 20:00:00 UTC+3 
 * @updated            	: 2024-12-10 07:00:00 UTC+3 
 * @author             	: Drogidis Christos
 * @authorSite         	: www.alexsoft.gr
 * @license 			: AGL-F
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);
namespace ASCOOS\FRAMEWORK\Kernel\Core;
defined ("ALEXSOFT_RUN_CMS") or die("Prohibition of Access.");
defined ("ASCOOS_FRAMEWORK_RUN") or die("Prohibition of Access.");

use stdClass;
use Stringable;
use Error;
use ReflectionClass;
use ReflectionProperty;
use Throwable;

use ASCOOS\FRAMEWORK\Kernel\Implementation\Methods\{
    func_free, 
    func_FreeProperties, 
    func_toString
};
use Exception;

/**
 * @class TError
 * @extends parent<Error>
 * 
 * @summary     Implements the error management class.
 * 
 * @method public __construct(string $message = "", int $code = 0, ?Throwable $previous = null)  Initialize the class.
 * @method public __toString(): string                              Returns a string containing the error.
 * @method public Free(object $object): bool;                       Frees the memory of the Object or its clone 
 * @method public function FreeProperties(object $object): bool;    Delete and Frees up memory for all class properties.
 * 
 * [ INHERITANCE PROPERTIES ]
 * @protected   string $message = ""; 
 * @protected   int $code;
 * @protected   string $file = "";
 * @protected   int $line;
 * 
 * [ INHERITANCE METHODS ]
 * @method final public getMessage(): string
 * @method final public getPrevious(): ?Throwable 
 * @method final public getCode(): int 
 * @method final public getFile(): string
 * @method final public getLine(): int
 * @method final public getTrace(): array
 * @method final public getTraceAsString(): string
 */
class TError extends Error 
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }


    /**
     * Frees the memory of the Object or its clone 
     * 
     * @param object $object    Object of class for free
     * @return bool
     */
    USE func_free; 

    /**
     * Deletes all properties of the object.
     * 
     * @param object $object    Object of class for free
     * @return bool
     */
    USE func_FreeProperties;

    
    /**
     * Returns a string containing the error.
     * 
     * @return string
     */
    public function __toString():string 
    {
        return 'Error: File=[' . $this->getFile() .'] --> Line=['. $this->getLine() .'] --> Code=['.$this->getCode().'] --> Message=['.$this->getMessage().']';
    }    

}   



/******************************************************************************
 * @startcode TCoreHandler
 *****************************************************************************/
/**
 * @interface TCoreHandler
 * @extends parent<Stringable> 
 * @summary                                 Stringable Interface Class
 * @method  string  __toString()            Returns a string containing the name of this class.
 */
interface TCoreHandler extends Stringable {}
/******************************************************************************
 * @endcode TCoreHandler
 *****************************************************************************/


/******************************************************************************
 * @startcode TObject
 *****************************************************************************/
/**
 * @class   TObject
 * @extends parent<stdClass>
 * @implements TCoreHandler
 * 
 * @summary The base class on which all classes in the framework are based.
 * 
 * [ METHODS ]
 * @method void __construct(array $properties=[])   Initialize the class. It must be called by the offspring if the classes are initialized.
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
 * @method void setProperties(array $properties, string|int|null $property_key=null)    Set the properties of the class.
 * @method void setProperty(string|int $property, mixed $value, string|int|null $property_key=null)   Set a single property of the class.
 */
#[\AllowDynamicProperties]
class TObject extends stdClass implements TCoreHandler
{
	/** [ PROPERTIES ] */

	/**
	 * @property array $defaults
	 * 
	 * Περιέχει τις προκαθορισμένες τιμές των ιδιοτήτων της κλάσης. Δεν μπορεί να αλλάξει από τους απογόνους.
	 * 
	 * @since 24.0.2
	 */
	private array $defaults = [
		'deprecated' => false, 			    // Indicates whether this class is deprecated.
        'deprecatedAtAscoosVersion' => -1,  // The version of Ascoos Cms in which the class has been declared deprecated.
		'removedAtVersion' => -1,		    // The class will be deleted in version ... If it is -1 then it will not be deleted.
		'version' => 10000,				    // Class Version
		'MinAscoosVersion' => 2400000000,	// The minimum version of Ascoos Cms that this class can run.
		'MaxAscoosVersion' => -1,		    // The maximum version of Ascoos Cms that this class can run.
		'MinPHPVersion' => 80200,		    // The minimum version of PHP that this class can run.
		'MaxPHPVersion' => -1,			    // The maximum version of PHP that this class can run.
        'ProjectVersion' => -1	            // The version of the product you make.
	];    
    

    /**
     * Summary of properties
     * @var array
     */
    protected array $properties=[];


    /**  [ METHODS ]  */

    /**
     * Constructor.
     * 
     * @desc <English>  Initialize the class. It must be called by the offspring if the classes are initialized.
     * @desc <Greek>    Αρχικοποιεί την κλάση. Πρέπει να καλείται από τα παραγόμενα αν οι κλάσεις αρχικοποιούνται.
     * 
     * @param array $properties   <English>  An associative array of properties to initialize the class with.
     *                            <Greek>    Ένας συσχετιστικός πίνακας ιδιοτήτων για την αρχικοποίηση της κλάσης.
     */    
    public function __construct(array $properties = []) {
        /*
        <English>
            Set the properties to the default values.
        </English>
        <Greek>
            Ορισμός των ιδιοτήτων στις προεπιλεγμένες τιμές.
        </Greek>
        */
        $this->properties = $this->defaults;

        /*
        <English>
            Use the setProperties method to override default properties with provided values, if any.
        </English>
        <Greek>
            Χρήση της μεθόδου setProperties για αντικατάσταση των προεπιλεγμένων ιδιοτήτων με τις παρεχόμενες τιμές, εάν υπάρχουν.
        </Greek>
        */
        $this->setProperties($properties);    
    }



    /**
     * @method  __toString()
     * 
     * Returns a string containing the name of this class.
     * 
     * @return string 
     * @desc <English>  Returns a string containing the name of this class.
     * @desc <Greek>    Επιστρέφει μια συμβολοσειρά που περιέχει το όνομα αυτής της κλάσης.
     */
    USE func_toString;
       


    /**
     * Returns true if class is deprecated, otherwise false
     * @return bool
     */
    final public function getClassDeprecated(): bool
	{
		return (bool) $this->properties['deprecated'];
	}


    /**
     * We get the version of the class
     * 
     * @return int
     */
	final public function getClassVersion(): int
	{
		return (int) $this->properties['version'];
	}

    

    /**
     * @desc <English>  Returns an array of the public properties of the class.
     * @desc <Greek>    Επιστρέφει έναν πίνακα με τις καθολικές ιδιότητες της κλάσης.
     * 
     * @return array|null <English>  An array of the public properties of the class, or null if there are none.
     *                      <Greek>    Ένας πίνακας με τις καθολικές ιδιότητες της κλάσης ή null αν δεν υπάρχουν.
     * 
     * @access public
     * @version 24.0.0
     */    
    public function getPublicProperties(): ?array {
        static $cache = null;

        /*
        <English>
            Initialize cache if it is null. This ensures that the property list is 
            only generated once and stored for future calls.
        </English>
        <Greek>
            Αρχικοποιεί την κρυφή μνήμη εάν είναι μηδενική. Αυτό διασφαλίζει ότι 
            η λίστα ιδιοτήτων δημιουργείται μόνο μία φορά και αποθηκεύεται για μελλοντικές κλήσεις.
        </Greek>
        */
        if (is_null($cache)) {
            $cache = [];
        
            /*
            <English>
                Create a ReflectionClass instance to inspect the current class.
            </English>
            <Greek>
                Δημιουργεί ένα αντικείμενο ReflectionClass για να εξετάσει την τρέχουσα κλάση.
            </Greek>
            */
            $reflectionClass = new ReflectionClass($this);
        
            /*
            <English>
                Get all public properties of the current class.
            </English>
            <Greek>
                Λαμβάνει όλες τις δημόσιες ιδιότητες της τρέχουσας κλάσης.
            </Greek>
            */
            $properties = $reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC);

            /*
            <English>
                Loop through each property and add its name to the cache array.
            </English>
            <Greek>
                Διατρέχει κάθε ιδιότητα και προσθέτει το όνομά της στο πίνακα της κρυφής μνήμης.
            </Greek>
            */
            foreach ($properties as $property) {
                $cache[] = $property->getName();
            }

            /*
            <English>
                Use the Free method to explicitly unset the reflection object to release resources.
            </English>
            <Greek>
                Χρήση της μεθόδου Free για ρητή αποδέσμευση του αντικειμένου reflection για απελευθέρωση πόρων.
            </Greek>
            */
            $this->Free($reflectionClass);
        }

        /*
        <English>
            Return the cached array of public property names.
        </English>
        <Greek>
            Επιστρέφει τον αποθηκευμένο πίνακα με τα ονόματα των δημόσιων ιδιοτήτων.
        </Greek>
        */
        return $cache;
    }
      


    
    /**
     * Returns the table of class properties.
     * @return array
     */
    public function getProperties() : array 
	{
		return (array) $this->properties;
	}



    /**
     * @desc <English>  Returns the content of the requested property
     * @desc <Greek>    Επιστρέφει το περιεχόμενο της ιδιότητας που ζητήθηκε
     * 
     * @param string $property  <English> The name of the property we request to get its data
     *                              <Greek> Το όνομα της ιδιότητας που ζητάμε να πάρουμε τα δεδομένα της
     * @return mixed            <English> Returns the content of the requested property
     *                              <Greek> Επιστρέφει το περιεχόμενο της ιδιότητας που ζητήθηκε
     */
    public function getProperty(string $property): mixed  
	{
		return $this->properties[$property];
	}


    /**
     * Get the version as an integer.
     * 
     * @desc <English>  Retrieves the version of a property as an integer.
     * @desc <Greek>    Λαμβάνει την έκδοση μιας ιδιότητας ως ακέραιο.
     * 
     * @param string $property   <English>  The property name whose version is to be retrieved.
     *                            <Greek>    Το όνομα της ιδιότητας της οποίας η έκδοση θα ληφθεί.
     * @return int|false <English>  Returns the version as an integer if it is set and valid, otherwise false.
     *                   <Greek>    Επιστρέφει την έκδοση ως ακέραιο αν είναι ορισμένη και έγκυρη, αλλιώς false.
     */    
    public function getVersion(string $property): int|false {
        /*
        <English>
            Check if the property is set and is an integer. Return the version if valid, otherwise false.
        </English>
        <Greek>
            Ελέγχει αν η ιδιότητα είναι ορισμένη και αν είναι ακέραιος. Επιστρέφει την έκδοση αν είναι έγκυρη, αλλιώς false.
        </Greek>
        */
        if (is_int($this->properties[$property])) {
            return $this->properties[$property];
        } else {
            return false;
        }
    }


    /**
     * Get the version as a formatted string.
     * 
     * @desc <English>  Retrieves the version of a property as a formatted string.
     * @desc <Greek>    Λαμβάνει την έκδοση μιας ιδιότητας ως μορφοποιημένη συμβολοσειρά.
     * 
     * @param string $property   <English>  The property name whose version is to be retrieved.
     *                            <Greek>    Το όνομα της ιδιότητας της οποίας η έκδοση θα ληφθεί.
     * @return string|false <English>  Returns the formatted version string if the version is set and valid, otherwise false.
     *                       <Greek>    Επιστρέφει τη μορφοποιημένη συμβολοσειρά της έκδοσης αν είναι ορισμένη και έγκυρη, αλλιώς false.
     */
    public function getVersionStr(string $property): string|false {
        /*
        <English>
            Retrieve the property value. If it is an integer, format it as a version string, otherwise return false.
        </English>
        <Greek>
            Λαμβάνει την τιμή της ιδιότητας. Αν είναι ακέραιος, τη μορφοποιεί ως συμβολοσειρά έκδοσης, αλλιώς επιστρέφει false.
        </Greek>
        */
        $int = $this->properties[$property];
        if (is_int($int)) {
            return intToVersionString($int);
        } else {
            return false;
        }
    }



    /**
     * @desc <English>  Checks whether the current version of the class is executable according 
     *                  to the minimum and maximum versions you specify.
     * @desc <Greek>    Ελέγχει αν η τρέχουσα έκδοση της κλάσης είναι εκτελέσιμη σύμφωνα 
     *                  με τις ελάχιστες και μέγιστες εκδόσεις που έχεις ορίσει.
     * 
     * @param int $currentVersion       <English>   The current version of the Ascoos Cms
     *                                      <Greek>     Η τρέχουσα έκδοση του Ascoos Cms
     * @param int $currentPHPVersion    <English>   The current version of PHP 
     *                                      <Greek>     Η τρέχουσα έκδοση της PHP 
     * @return bool     <English>   Returns true if execution support exists, otherwise false.
     *                      <Greek>     Επιστρέφει true εάν υπάρχει υποστήριξη εκτέλεσης, αλλιώς false.
     * 
     * @access public
     * @final
     * 
     * @since 24.0.0
     */
    public function isExecutable(int $currentVersion, int $currentPHPVersion): bool {
        $minVersion = $this->properties['MinAscoosVersion'];
        $maxVersion = $this->properties['MaxAscoosVersion'];
        $minPHPVersion = $this->properties['MinPHPVersion'];
        $maxPHPVersion = $this->properties['MaxPHPVersion'];

        /*
        <English>
            If the version of the Ascoos Cms is less than the minimum mandatory, 
            then it returns false = Unsupported version. 
        </English>
        <Greek>
            Εάν η έκδοση του Ascoos Cms είναι μικρότερη από την ελάχιστη υποχρεωτική, 
            τότε επιστρέφει false = Μη υποστηριζόμενη έκδοση. 
        </Greek>
        */
        if ($currentVersion < $minVersion) {
            return false;
        }

        /*
        <English>
            If the version of the Ascoos Cms is greater than the maximum allowed (and the maximum is not unlimited), 
            then it returns false = Unsupported version.
        </English>
        <Greek>
            Εάν η έκδοση του Ascoos Cms είναι μεγαλύτερη από τη μέγιστη επιτρεπτή (και η μέγιστη δεν είναι απεριόριστη), 
            τότε επιστρέφει false = Μη υποστηριζόμενη έκδοση.
        </Greek>
        */
        if ($maxVersion != -1 && $currentVersion > $maxVersion) {
            return false;
        }

        /*
        <English>
            If the version of PHP is less than the minimum mandatory, 
            then it returns false = Unsupported PHP version.
        </English>
        <Greek>
            Εάν η έκδοση της PHP είναι μικρότερη από την ελάχιστη υποχρεωτική, 
            τότε επιστρέφει false = Μη υποστηριζόμενη έκδοση PHP.
        </Greek>
        */
        if ($currentPHPVersion < $minPHPVersion) {
            return false;
        }

        /*
        <English>
            If the version of PHP is greater than the maximum allowed (and the maximum is not unlimited), 
            then it returns false = Unsupported PHP version.
        </English>
        <Greek>
            Εάν η έκδοση της PHP είναι μεγαλύτερη από τη μέγιστη επιτρεπτή (και η μέγιστη δεν είναι απεριόριστη), 
            τότε επιστρέφει false = Μη υποστηριζόμενη έκδοση PHP.
        </Greek>
        */
        if ($maxPHPVersion != -1 && $currentPHPVersion > $maxPHPVersion) {
            return false;
        }

        /*
        <English>
            If all the conditions are met, it returns true = Supported version.
        </English>
        <Greek>
            Εάν πληρούνται όλες οι προϋποθέσεις, επιστρέφει true = Υποστηριζόμενη έκδοση.
        </Greek>
        */        
        return true;
    }


    /**
     * Sets the project version.
     * 
     * @param int|string $version The version to set. If string, it should be in the format 'x.y.z'.
     * 
     * @desc <English> Sets the project version. Converts string versions to integer.
     * @desc <Greek>   Ορίζει την έκδοση του project. Μετατρέπει τις συμβολοσειρές εκδόσεων σε ακέραιους αριθμούς.
     * 
     * @access public
     * @final
     */
    final public function setProjectVersion(int|string $version = -1) {
        if (is_string($version)) {
            $version = versionStringToInt($version);
        }
        $this->properties['ProjectVersion'] = intval($version);
    }



    /**
     * Set the properties of the class.
     * 
     * @desc <English>  Sets the properties of the class. If the properties array is not empty, it overrides the default properties with the provided values.
     * @desc <Greek>    Ορίζει τις ιδιότητες της κλάσης. Εάν ο πίνακας ιδιοτήτων δεν είναι κενός, αντικαθιστά τις προεπιλεγμένες ιδιότητες με τις παρεχόμενες τιμές.
     * 
     * @param array $properties   <English>  An associative array of properties to set.
     *                            <Greek>    Ένας συσχετιστικός πίνακας ιδιοτήτων που θα οριστούν.
     */    
    public function setProperties(array $properties, string|int|null $property_key=null) 
    {
        /*
        <English>
            If the properties array is not empty, override the default properties with the provided values.
        </English>
        <Greek>
            Εάν ο πίνακας ιδιοτήτων δεν είναι κενός, αντικατάσταση των προεπιλεγμένων ιδιοτήτων με τις παρεχόμενες τιμές.
        </Greek>
        */
        if (!empty($properties)) {
            foreach ($properties as $key => $val) {
                if (is_null($property_key)) 
                {
                    $this->properties[$key] = $val;
                } else {
                    $this->properties[$property_key][$key] = $val;
                }
            }
        }
    }


    /**
     * Set a single property of the class.
     * 
     * @desc <English>  Sets a single property of the class.
     * @desc <Greek>    Ορίζει μία ιδιότητα της κλάσης.
     * 
     * @param string $property   <English>  The property name to set.
     *                           <Greek>    Το όνομα της ιδιότητας που θα οριστεί.
     * @param mixed $value       <English>  The value to set for the property.
     *                           <Greek>    Η τιμή που θα οριστεί για την ιδιότητα.
     */    
    public function setProperty(string|int $property, mixed $value, string|int|null $property_key=null): bool 
    {
        /*
        <English>
            Check if the property name is a string and set the property value.
        </English>
        <Greek>
            Ελέγχει αν το όνομα της ιδιότητας είναι συμβολοσειρά και ορίζει την τιμή της ιδιότητας.
        </Greek>
        */
        if (is_null($property_key)) {
            if (is_string($property) || is_int($property)) {
                $this->properties[$property] = $value;
                return true;
            } else {
                throw new TError('The property must have an integer or string as its key.');
            }
        } else {
            if (is_string($property_key) || is_int($property_key)) {
                $this->properties[$property_key][$property] = $value;
                return true;
            } else {
                throw new TError('The property must have an integer or string as its key.');
            }            
        }

    }


    /**
     * @method final public function Free(object $object): bool
     * 
     * Frees the memory of the Object or its clone 
     * 
     * @param object $object    Object of class for free
     * @return bool
     */
    USE func_free; 

    

    /**
     * @method final public function FreeProperties(object $object): bool
     * 
     * Deletes all properties of the object.
     * 
     * @param object $object    Object of class for properties free
     * @return bool
     */
    USE func_FreeProperties;

   

    /**
     * ............... Others TObject methods  .................
     */ 



}
/******************************************************************************
 * @endcode TObject
 *****************************************************************************/


/**
 * ............... Others coreKernel.php Class and datas  .................
 */ 
?>