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
 * @version            	: 24.0.7
 * @created            	: 2024-07-01 20:00:00 UTC+3
 * @updated            	: 2024-12-18 07:00:00 UTC+3
 * @author             	: Drogidis Christos
 * @authorSite         	: www.alexsoft.gr
 * @license 			: AGL-F (Free Edition)
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);
namespace ASCOOS\FRAMEWORK\Kernel\Core;
defined ("ALEXSOFT_RUN_CMS") or die("Prohibition of Access.");
defined ("ASCOOS_FRAMEWORK_RUN") or die("Prohibition of Access.");

use stdClass, Stringable, Error, ReflectionClass, ReflectionProperty, Throwable;

use ASCOOS\FRAMEWORK\Kernel\Implementation\Methods\{
    func_free, 
    func_FreeProperties, 
    func_toString
};


/**
 * Δημόσιος πίνακας που περιέχει τα λάθη. 
 * Χρησιμοποιείται για να δημιουργήσει ιδιωτικά αρχεία αναφορών μορφοποιημένα κατάλληλα.
 * 
 * @license AGL (Commercial)
 */
$_ERRORS = [];


/******************************************************************************
 * @startcode TError
 *****************************************************************************/
/**
 * @class TError
 * @extends Error
 * 
 * @summary     Implements the error management class.
 * 
 * @method public __construct(string $message = "", int $code = 0, ?Throwable $previous = null, bool $free_on_return = true)  Initialize the class.
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
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null, bool $free_on_return = true) {
        parent::__construct($message, $code, $previous);
    }


    /**
     * Frees the memory of the Object or its clone 
     * 
     * @param object $object    Object of class for free
     * @return bool
     * 
     * @version 24.0.0
     */
    USE func_free; 

    /**
     * Deletes all properties of the object.
     * 
     * @param object $object    Object of class for free
     * @return bool
     * 
     * @version 24.0.0
     */
    USE func_FreeProperties;

    
    /**
     * Returns a string containing the error.
     * 
     * @return string
     * 
     * @version 24.0.0
     */
    public function __toString():string 
    {
        $trace = '<table style="border: 2px solid #373737; border-radius: 5px; margin:0; padding:0;">'.
        '<thead style="ymargin:0; padding:0;">'.
        '<tr style="background-color:#8a030e; color:#ffffff; font-weight: bold; font-size: 1.2em;">'.
            '<th colspan="1" style="padding:4px;">'.$this->getCode().'</th>'.
            '<th colspan="3" style="padding:4px;">'.$this->getMessage().'</th>'.
        '</tr>'.
        '<tr>'.
            '<th colspan="4" style="padding:2px; background-color:#ffa755; color:#000; font-weight: bold; font-size: 1.1em;">File: '. $this->getFile().' [Line: '.$this->getLine().']</th>'.
        '</tr>'.  
        '<tr>'.
            '<th colspan="4" style="padding:2px; background-color:#dcd8d8; color:#373737; font-weight: bold; font-size: 1.1em;">Call Stack</th>'.
        '</tr>'.        
        '<tr>'.
            '<th style="padding:5px; border: 1px solid black; text-align:center;">#</th>'.
            '<th style="padding:5px; border: 1px solid black;text-align:left;">Function</th>'.
            '<th style="padding:5px; border: 1px solid black;text-align:left;">File</th>'.
            '<th style="padding:5px; border: 1px solid black;text-align:left;">Line</th>'.
        '</tr>'.
        '</thead><tbody>';

        $traces = $this->getTrace();

        foreach ($traces as $key => $value) 
        {
            $trace .= '<tr>'.
            '<td style="padding:5px; border: 1px solid black; width: 20px; text-align:center;">'.$key.'</td>'.
            '<td style="padding:5px; border: 1px solid black;text-align:left;">'.$value['function'].'</td>'.
            '<td style="padding:5px; border: 1px solid black;text-align:left;">'.$value['file'].'</td>'.
            '<td style="padding:5px; border: 1px solid black;text-align:left;">'.$value['line'].'</td>'.
          '</tr>';
        }
        $trace .= '</tbody></table>';
        return $trace;
    }    


    /**
     * 
     * 
     * 
     * @return array
     * 
     * @license AGL (Commercial License)
     * @version 24.0.0
     */
    public function getError(): array|false
    {
        return false;
    }

}   
/******************************************************************************
 * @endcode TError
 *****************************************************************************/



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
 * [ PROPERTIES ]
 * @property array $properties [protected]          Class Properties
 * 
 * [ METHODS ]
 * @method void __construct(array $properties=[])                          Initialize the class. It must be called by the offspring if the classes are initialized.
 * @method string __toString()                                             Returns a string containing the name of this class.
 * @method bool Free(object $object)                                       Frees the memory of the Object or its clone.
 * @method bool FreeProperties(object $object)                             Delete and Frees up memory for all class properties.
 * @method array getChildren(object|string|null $object_or_class = null)   Return the child classes of the given class or object
 * @method bool getClassDeprecated()                                       Returns true if class is deprecated, otherwise false.
 * @method int getClassVersion()                                           We get the version of the class.
 * @method mixed getDeepProperty(array $keys, ?array $array = null)        Gets a property at any depth within the properties array.
 * @method array getDescendantsTree(object|string|null $object_or_class = null)     Return a tree array of all descendants of the given class or object
 * @method array|false getParents(object|string|null $object_or_class = null, bool $autoload = true)     Return the parent classes of the given class or object
 * @method array getProperties()                                           Returns the table of class properties.
 * @method mixed getProperty(string $property)                             Returns the content of the requested property.
 * @method ?array getPublicProperties()                                    Returns an array of the public properties of the class.
 * @method int|false getVersion(string $property)                          Get the version as an integer.       
 * @method string|false getVersionStr(string $property)                    Get the version as a formatted string.
 * @method bool isExecutable(int $currentVersion, int $currentPHPVersion)  Checks whether the current version of the class is executable according to the minimum and maximum versions you specify.
 * @method void setDeepProperty(array $keys, mixed $value, ?array &$array = null)                       Sets a property at any depth within the properties array.
 * @method void setProjectVersion(int|string $version = -1)                                             Sets the project version.
 * @method bool setProperties(array $properties, string|int|null $property_key = null)                  Recursively sets properties of the class, merging sub-arrays without overwriting other data.
 * @method bool setProperty(string|int $property, mixed $value, string|int|null $property_key = null)   Set a single property of the class.
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
		'version' => 2400070000,		    // Class Version
		'MinAscoosVersion' => 2400070000,	// The minimum version of Ascoos Cms that this class can run.
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
     * 
     * @version 24.0.0
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
        
        // NOT DELETE. USED FOR CHECK VERSIONS
        $this->properties['defaults'] = $this->defaults;

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
     * 
     * @version 24.0.0
     */
    USE func_toString;
       

    /**
     * Return the child classes of the given class or object
     * 
     * @desc <English>  Return the child classes of the given class or object
     * @desc <Greek>    Επιστροφή των παιδικών κλάσεων της δεδομένης κλάσης ή αντικειμένου
     * 
     * @param object|string|null $object_or_class   <English>  An object (class instance) or a string (class name).
     *                                              <Greek>    Ένα αντικείμενο (παρουσία κλάσης) ή μια συμβολοσειρά (όνομα κλάσης).
     * @return array  <English>  An array of child classes, empty array when there are no children.
     *                  <Greek>    Ένας πίνακας με τις παιδικές κλάσεις, κενός πίνακας αν δεν υπάρχουν παιδιά.
     */
    public function getChildren(object|string|null $object_or_class = null): array {
        $object_or_class = (!is_null($object_or_class)) ? $object_or_class : $this;
        $parent_class = is_object($object_or_class) ? get_class($object_or_class) : $object_or_class;
    
        $child_classes = [];
        $this->findChildren($parent_class, $child_classes);
    
        return array_unique($child_classes);
    }
    

    
    

    /**
     * Returns true if class is deprecated, otherwise false
     * @return bool
     * 
     * @version 24.0.0
     */
    final public function getClassDeprecated(): bool
	{
		return (bool) $this->properties['deprecated'];
	}


    /**
     * We get the version of the class
     * 
     * @return int
     * 
     * @version 24.0.0
     */
	final public function getClassVersion(): int
	{
		return (int) $this->properties['version'];
	}

      
    /**
     * Gets a property at any depth within the properties array.
     * 
     * @desc <English>  Gets a property at any depth within the properties array.
     * @desc <Greek>    Ανακτά μία ιδιότητα σε οποιοδήποτε βάθος εντός του πίνακα ιδιοτήτων.
     * 
     * @param array $keys     <English>  An array representing the path to the property.
     *                        <Greek>    Ένας πίνακας που αντιπροσωπεύει τη διαδρομή προς την ιδιότητα.
     * @param array|null $array   <English>  The array to get the property from (used internally for recursion).
     *                               <Greek>    Ο πίνακας από τον οποίο θα ανακτηθεί η ιδιότητα (χρησιμοποιείται εσωτερικά για αναδρομή).
     * @return mixed
     * 
     * @version 24.0.6
     */
    public function getDeepProperty(array $keys, ?array $array = null): mixed
    {
        if ($array === null) {
            $array = $this->properties;
        }

        $key = array_shift($keys);

        if (empty($keys)) {
            return $array[$key] ?? null;
        }

        if (!isset($array[$key]) || !is_array($array[$key])) {
            return null;
        }

        return $this->getDeepProperty($keys, $array[$key]);
    }


    /**
     * Return a tree array of all descendants of the given class or object
     * 
     * @desc <English>  Return a tree array of all descendants of the given class or object
     * @desc <Greek>    Επιστροφή ενός πίνακα δέντρου με όλους τους απογόνους της δεδομένης κλάσης ή αντικειμένου
     * 
     * @param object|string|null $object_or_class   <English>  An object (class instance) or a string (class name).
     *                                              <Greek>    Ένα αντικείμενο (παρουσία κλάσης) ή μια συμβολοσειρά (όνομα κλάσης).
     * @return array  <English>  An array representing the descendants tree.
     *                  <Greek>    Ένας πίνακας που αναπαριστά το δέντρο των απογόνων.
     */
    public function getDescendantsTree(object|string|null $object_or_class = null): array {
        $object_or_class = (!is_null($object_or_class)) ? $object_or_class : $this;
        $parent_class = is_object($object_or_class) ? get_class($object_or_class) : $object_or_class;

        $tree = [];
        $this->buildDescendantsTree($parent_class, $tree);

        return $tree;
    }


    /**
     * Return the parent classes of the given class or object
     * 
     * @desc <English>  Return the parent classes of the given class or object
     * @desc <Greek>    Επιστροφή των γονικών κλάσεων της δεδομένης κλάσης ή αντικειμένου
     * 
     * @param object|string|null $object_or_class   <English>  An object (class instance) or a string (class name). 
     *                                              <Greek>    Ένα αντικείμενο (παρουσία κλάσης) ή μια συμβολοσειρά (όνομα κλάσης).
     * @param bool $autoload    <English>  Whether to autoload if not already loaded.
     *                          <Greek>    Εάν θα γίνει αυτόματη φόρτωση εάν δεν έχει ήδη φορτωθεί. 
     * @return array|false  <English>  An array on success, or false when the given class doesn't exist. 
     *                      <Greek>    Ένας πίνακας για την επιτυχία, ή ψευδής όταν η δεδομένη κλάση δεν υπάρχει. 
     */
    public function getParents(object|string|null $object_or_class = null, bool $autoload = true): array|false {
        $object_or_class = (!is_null($object_or_class)) ? $object_or_class : $this;
        return  class_parents($object_or_class, $autoload);
    }


    /**
     * Returns the table of class properties.
     * 
     * @desc <English>  Returns the table of class properties.
     * @desc <Greek>    Επιστρέφει τον πίνακα ιδιοτήτων της κλάσης.
     * 
     * @return array <English>  The properties array.
     *               <Greek>    Ο πίνακας ιδιοτήτων.
     * 
     * @version 24.0.0
     */
    public function getProperties() : array 
	{
		return $this->properties;
	}


    /**
     * @desc <English>  Returns the content of the requested property
     * @desc <Greek>    Επιστρέφει το περιεχόμενο της ιδιότητας που ζητήθηκε
     * 
     * @param string $property  <English> The name of the property we request to get its data
     *                              <Greek> Το όνομα της ιδιότητας που ζητάμε να πάρουμε τα δεδομένα της
     * @return mixed            <English> Returns the content of the requested property
     *                              <Greek> Επιστρέφει το περιεχόμενο της ιδιότητας που ζητήθηκε
     * @version 24.0.0
     */
    public function getProperty(string $property): mixed  
	{
		return $this->properties[$property];
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
     * Get the version as an integer.
     * 
     * @desc <English>  Retrieves the version of a property as an integer.
     * @desc <Greek>    Λαμβάνει την έκδοση μιας ιδιότητας ως ακέραιο.
     * 
     * @param string $property   <English>  The property name whose version is to be retrieved.
     *                            <Greek>    Το όνομα της ιδιότητας της οποίας η έκδοση θα ληφθεί.
     * @return int|false <English>  Returns the version as an integer if it is set and valid, otherwise false.
     *                   <Greek>    Επιστρέφει την έκδοση ως ακέραιο αν είναι ορισμένη και έγκυρη, αλλιώς false.
     * 
     * @version 24.0.0
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
     * 
     * @version 24.0.0
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
     * @version 24.0.0
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
     * Validation if property is string or integer.
     * 
     * @desc <English> Validation if property is string or integer.
     * @desc <Greek>   Ορίζει την έκδοση του project. Μετατρέπει τις συμβολοσειρές εκδόσεων σε ακέραιους αριθμούς.
     * 
     * @param mixed $property   <English>  The property name to set.
     *                          <Greek>    Το όνομα της ιδιότητας που θα οριστεί.
     * 
     * @access public
     * @final
     * @version 24.0.0
     */
    final public function propertyValidation($property): bool 
    {
        if (is_string($property) || is_int($property)) 
            return true;
        else 
            return false;
    }


    /**
     * Sets a property at any depth within the properties array.
     * 
     * @desc <English>  Sets a property at any depth within the properties array.
     * @desc <Greek>    Ορίζει μία ιδιότητα σε οποιοδήποτε βάθος εντός του πίνακα ιδιοτήτων.
     * 
     * @param array $keys     <English>  An array representing the path to the property.
     *                        <Greek>    Ένας πίνακας που αντιπροσωπεύει τη διαδρομή προς την ιδιότητα.
     * @param mixed $value    <English>  The value to set for the property.
     *                        <Greek>    Η τιμή που θα οριστεί για την ιδιότητα.
     * @param array|null $array   <English>  The array to set the property in (used internally for recursion).
     *                               <Greek>    Ο πίνακας στον οποίο θα οριστεί η ιδιότητα (χρησιμοποιείται εσωτερικά για αναδρομή).
     * @return void
     * 
     * @version 24.0.6
     */
    public function setDeepProperty(array $keys, mixed $value, ?array &$array = null): void 
    {
        if ($array === null) {
            $array = &$this->properties;
        }

        $key = array_shift($keys);

        if (empty($keys)) {
            $array[$key] = $value;
        } else {
            if (!isset($array[$key]) || !is_array($array[$key])) {
                $array[$key] = [];
            }
            $this->setDeepProperty($keys, $value, $array[$key]);
        }
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
     * @version 24.0.0
     */
    final public function setProjectVersion(int|string $version = -1) {
        if (is_string($version)) {
            $version = versionStringToInt($version);
        }
        $this->properties['ProjectVersion'] = intval($version);
    }


    /**
     * Recursively sets properties of the class, merging sub-arrays without overwriting other data.
     * 
     * @desc <English>  Recursively sets properties of the class, merging sub-arrays without overwriting other data.
     * @desc <Greek>    Αναδρομικά ορίζει τις ιδιότητες της κλάσης, συγχωνεύοντας τους υποπίνακες χωρίς να αντικαθιστά τα υπόλοιπα δεδομένα.
     * 
     * @param array $properties   <English>  An associative array of properties to set.
     *                            <Greek>    Ένας συσχετιστικός πίνακας ιδιοτήτων που θα οριστούν.
     * @param string|int|null $property_key <English>  The key of the property to set.
     *                                      <Greek>    Το κλειδί της ιδιότητας που θα οριστεί.
     * @return bool <English>  Returns true if properties were set, false otherwise.
     *               <Greek>   Επιστρέφει true αν οι ιδιότητες ορίστηκαν, αλλιώς επιστρέφει false.
     * 
     * @version 24.0.6
     */    
    public function setProperties(array $properties, string|int|null $property_key = null): bool 
    {
        if (empty($properties)) {
            return false;
        }

        if (!is_null($property_key) && array_key_exists($property_key, $this->properties)) {
            $this->properties[$property_key] = $this->mergeRecursive($this->properties[$property_key], $properties);
        } else {
            $this->properties = $this->mergeRecursive($this->properties, $properties);
        }

        return true;
    }


    /**
     * Set a single property of the class.
     * 
     * @desc <English>  Sets a single property of the class.
     * @desc <Greek>    Ορίζει μία ιδιότητα της κλάσης.
     * 
     * @param string|int $property   <English>  The property name to set.
     *                               <Greek>    Το όνομα της ιδιότητας που θα οριστεί.
     * @param mixed $value       <English>  The value to set for the property.
     *                           <Greek>    Η τιμή που θα οριστεί για την ιδιότητα.
     * @param string|int|null $property_key   <English>  The name of the property in which it will be inserted.
     *                                        <Greek>    Το όνομα της ιδιότητας στην οποία θα εισαχθεί.
     * @return bool <English>  Returns true if the property was set, false otherwise.
     *               <Greek>   Επιστρέφει true αν η ιδιότητα ορίστηκε, αλλιώς επιστρέφει false.
     * 
     * @version 24.0.6
     */    
    public function setProperty(string|int $property, mixed $value, string|int|null $property_key = null): bool 
    {
        if (is_null($property_key)) {
            $this->properties[$property] = $value;
            return true;
        } elseif (is_string($property_key) || is_int($property_key)) {
            $this->properties[$property_key][$property] = $value;
            return true;
        }

        return false;
    }


    /**
     * @method final public function Free(object $object): bool
     * 
     * Frees the memory of the Object or its clone 
     * 
     * @param object $object    Object of class for free
     * @return bool
     * 
     * @version 24.0.0
     */
    USE func_free; 

    
    /**
     * @method final public function FreeProperties(object $object): bool
     * 
     * Deletes all properties of the object.
     * 
     * @param object $object    Object of class for properties free
     * @return bool
     * 
     * @version 24.0.0
     */
    USE func_FreeProperties;

   

    /**
     * ............... Private TObject methods  .................
     */ 


    /**
     * Recursively build a tree array of all descendants of the given class or object
     * 
     * @desc <English>  Recursively build a tree array of all descendants of the given class or object
     * @desc <Greek>    Δημιουργία αναδρομικά ενός πίνακα δέντρου με όλους τους απογόνους της δεδομένης κλάσης ή αντικειμένου
     * 
     * @param string $parent_class   <English>  The name of the parent class.
     *                                <Greek>    Το όνομα της γονικής κλάσης.
     * @param array &$tree  <English>  The array to which the descendants will be added.
     *                   <Greek>    Ο πίνακας στον οποίο θα προστεθούν οι απόγονοι.
     */
    private function buildDescendantsTree(string $parent_class, array &$tree): void {
        foreach (get_declared_classes() as $class) {
            if (is_subclass_of($class, $parent_class)) {
                $tree[$class] = [];
                $this->buildDescendantsTree($class, $tree[$class]);
            }
        }
    }


    /**
     * Get the direct child classes of the given parent class.
     * 
     * @desc <English>  Get the direct child classes of the given parent class.
     * @desc <Greek>    Λήψη των άμεσων παιδικών κλάσεων της δεδομένης γονικής κλάσης.
     * 
     * @param string $parent_class   <English>  The name of the parent class.
     *                                <Greek>    Το όνομα της γονικής κλάσης.
     * @return array   <English>  An array of direct child classes.
     *                 <Greek>    Ένας πίνακας με τις άμεσες παιδικές κλάσεις.
     */
    private function getDirectChildren(string $parent_class): array {
        $child_classes = []; // Αρχικοποίηση ενός πίνακα για την αποθήκευση των παιδικών κλάσεων
        foreach (get_declared_classes() as $class) {
            // Ελέγχει αν η κλάση είναι υποκλάση της γονικής κλάσης
            if (is_subclass_of($class, $parent_class)) {
                $child_classes[] = $class; // Προσθήκη της παιδικής κλάσης στον πίνακα
            }
        }
        return $child_classes; // Επιστροφή του πίνακα με τις παιδικές κλάσεις
    }
     

    /**
     * Recursively find all child classes of the given parent class and add them to the provided array.
     * 
     * @desc <English>  Recursively find all child classes of the given parent class and add them to the provided array.
     * @desc <Greek>    Βρίσκει αναδρομικά όλες τις παιδικές κλάσεις της δεδομένης γονικής κλάσης και τις προσθέτει στον δοσμένο πίνακα.
     * 
     * @param string $parent_class   <English>  The name of the parent class.
     *                                <Greek>    Το όνομα της γονικής κλάσης.
     * @param array &$child_classes  <English>  The array to which the child classes will be added.
     *                                <Greek>    Ο πίνακας στον οποίο θα προστεθούν οι παιδικές κλάσεις.
     */
    private function findChildren(string $parent_class, array &$child_classes): void {
        foreach (get_declared_classes() as $class) {
            // Ελέγχει αν η κλάση είναι υποκλάση της γονικής κλάσης και αν δεν είναι ήδη στον πίνακα
            if (is_subclass_of($class, $parent_class) && !in_array($class, $child_classes)) {
                $child_classes[] = $class; // Προσθήκη της παιδικής κλάσης στον πίνακα
                $this->findChildren($class, $child_classes); // Αναδρομική κλήση για εύρεση των παιδικών κλάσεων της παιδικής κλάσης
            }
        }
    }



    /**
     * Helper function to recursively merge two arrays.
     * 
     * @param array $array1 <English>  The base array.
     *                      <Greek>    Ο βασικός πίνακας.
     * @param array $array2 <English>  The array to merge into the base array.
     *                      <Greek>    Ο πίνακας που θα συγχωνευτεί στον βασικό πίνακα.
     * @return array <English>  The merged array.
     *               <Greek>    Ο συγχωνευμένος πίνακας.
     * 
     * @version 24.0.6
     */
    private function mergeRecursive(array $array1, array $array2): array
    {
        foreach ($array2 as $key => $value) {
            if (is_array($value) && isset($array1[$key]) && is_array($array1[$key])) {
                $array1[$key] = $this->mergeRecursive($array1[$key], $value);
            } else {
                $array1[$key] = $value;
            }
        }
        return $array1;
    }    
   
    /**
     * ............... End Private TObject methods  .................
     */ 


    // __________________________________________________________________________________
    // ............... Others methods and properties of TObject Class  .................
    // __________________________________________________________________________________

}
/******************************************************************************
 * @endcode TObject
 *****************************************************************************/



// ________________________________________________________________________
// ............... Others coreKernel.php Class and datas  .................
// ________________________________________________________________________
?>