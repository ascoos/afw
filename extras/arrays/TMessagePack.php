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
 * @subpackage         	: Main ASCOOS FRAMEWORK Core Array Handles File
 * @source             	: [ASCOOS FRAMEWORK (AFW)]/extras/arrays/TMessagePack.php
 * @fileNo             	: 
 * @version            	: 24.0.2
 * @created            	: 2024-07-01 20:00:00 UTC+3 
 * @updated            	: 2024-12-01 07:00:00 UTC+3 
 * @author             	: Drogidis Christos
 * @authorSite         	: www.alexsoft.gr
 * @license 			: AGL-F
 * 
 * @since PHP 8.2.0
 * @since 
 */
namespace ASCOOS\FRAMEWORK\Extras\Arrays\MessagePack;

use ASCOOS\FRAMEWORK\Kernel\Arrays\TArrayHandler;

/******************************************************************************
 * @startcode TMessagePackArrayHandler
 *****************************************************************************/
/**
 * @class   TMessagePackArrayHandler
 * @extends TArrayHandler
 * 
 * @summary Handles MessagePack format arrays.
 * 
 * [ METHODS ]
 * @method void toMessagePack(string $filePath)     Converts array to MessagePack format and saves to file.
 * @method void fromMessagePack(string $filePath)   Converts MessagePack format to array.
 */
 class TMessagePackArrayHandler extends TArrayHandler
 {
     /**
      * Converts array to MessagePack format and saves to file.
      * 
      * @desc <English>  Converts the internal array to MessagePack format and saves it to a specified file.
      * @desc <Greek>    Μετατρέπει τον εσωτερικό πίνακα σε μορφή MessagePack και τον αποθηκεύει σε ένα καθορισμένο αρχείο.
      * 
      * @param string $filePath <English>  The path to the file where the MessagePack content will be saved.
      *                         <Greek>    Η διαδρομή προς το αρχείο όπου θα αποθηκευτεί το περιεχόμενο MessagePack.
      * @return void
      */
     public function toMessagePack(string $filePath): void
     {
         /*
         <English>
             Convert the internal array to MessagePack format.
         </English>
         <Greek>
             Μετατρέπει τον εσωτερικό πίνακα σε μορφή MessagePack.
         </Greek>
         */
         $messagePack = msgpack_pack($this->array);
 
         /*
         <English>
             Write the MessagePack content to the specified file.
         </English>
         <Greek>
             Εγγράφει το περιεχόμενο MessagePack στο καθορισμένο αρχείο.
         </Greek>
         */
         file_put_contents($filePath, $messagePack);
     }
 
     /**
      * Converts MessagePack format to array.
      * 
      * @desc <English>  Converts a MessagePack file to an array and assigns it to the internal array.
      * @desc <Greek>    Μετατρέπει ένα αρχείο MessagePack σε πίνακα και το αναθέτει στον εσωτερικό πίνακα.
      * 
      * @param string $filePath <English>  The path to the MessagePack file to convert.
      *                         <Greek>    Η διαδρομή προς το αρχείο MessagePack που θα μετατραπεί.
      * @return void
      */
     public function fromMessagePack(string $filePath): void
     {
         /*
         <English>
             Read the MessagePack file and convert it to an array.
         </English>
         <Greek>
             Διαβάζει το αρχείο MessagePack και το μετατρέπει σε πίνακα.
         </Greek>
         */
         $messagePack = file_get_contents($filePath);
         $this->array = msgpack_unpack($messagePack);
     }
 }
/******************************************************************************
 * @endcode TMessagePackArrayHandler
 *****************************************************************************/
?>