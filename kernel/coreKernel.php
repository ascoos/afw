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
 * @subpackage         	: Main ASCOOS FRAMEWORK Core File
 * @source             	: [ASCOOS FRAMEWORK (AFW)]/kernel/coreKernel.php
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
namespace ASCOOS\FRAMEWORK\Kernel\Core;
defined ("ALEXSOFT_RUN_CMS") or die("Prohibition of Access.");
defined ("ASCOOS_FRAMEWORK_RUN") or die("Prohibition of Access.");

use stdClass;
use Stringable;
use Error;
use ASCOOS\FRAMEWORK\Kernel\Implementation\Methods\func_free;
use ASCOOS\FRAMEWORK\Kernel\Implementation\Methods\func_FreeProperties;


/**
 * @class TError
 * @extends parent<Error>
 * 
 * @summary     Implements the error management class.
 * 
 * @method final public Free(object $object): bool;          Frees the memory of the Object or its clone 
 * @method final public function FreeProperties(object $object): bool;
 * 
 * [ INHERITANCE PROPERTIES ]
 * @protected   string $message = ""; 
 * @private     string $string = "";
 * @protected   int $code;
 * @protected   string $file = "";
 * @protected   int $line;
 * @private     array $trace = [];
 * @private     ?Throwable $previous = null;
 * 
 * [ INHERITANCE METHODS ]
 * @method public __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
 * @method final public getMessage(): string
 * @method final public getPrevious(): ?Throwable 
 * @method final public getCode(): int 
 * @method final public getFile(): string
 * @method final public getLine(): int
 * @method final public getTrace(): array
 * @method final public getTraceAsString(): string
 * @method public __toString(): string
 * @method private __clone(): void
 */
class TError extends Error 
{
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
 * 
 * @summary     Stringable Interface Class
 * 
 * [ METHODS ] 
 * @method  string  __toString()            Returns a string containing the name of this class.
 * @method  bool    Free()                  Frees the memory of the Object or its clone 
 */
interface TCoreHandler extends Stringable
{
    public function Free(object $object): bool;
    public function FreeProperties(object $object): bool;

    /**
     * ............... Others TCoreHandler methods  .................
     */    
}
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
 * @method  string  __toString()            Returns a string containing the name of this class.
 * @method  bool    Free()                  Frees the memory of the Object or its clone 
 * @method boll FreeProperties()            Deletes all properties of the object.
 * ..........
 * ..........
 */
#[\AllowDynamicProperties]
class TObject extends stdClass implements TCoreHandler
{

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
     * Returns a string containing the name of this class.
     * 
     * @return string
     */
    public function __toString():string 
    {
        return get_class($this);
    }

    /**
     * ............... Others TObject methods  .................
     */ 

}
/******************************************************************************
 * @endcode TObject
 *****************************************************************************/
?>