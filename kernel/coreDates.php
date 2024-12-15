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
 * @subpackage         	: Handles Dates operations.
 * @source             	: afw/kernel/coreDates.php
 * @fileNo             	: 
 * @version            	: 24.0.6
 * @created            	: 2024-07-01 20:00:00 UTC+3 
 * @updated            	: 2024-12-15 07:00:00 UTC+3 
 * @author             	: Drogidis Christos
 * @authorSite         	: www.alexsoft.gr
 * @license 			: AGL-F
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);
namespace ASCOOS\FRAMEWORK\Kernel\Dates;

defined ("ALEXSOFT_RUN_CMS") or die("Prohibition of Access.");
defined ("ASCOOS_FRAMEWORK_RUN") or die("Prohibition of Access.");


use ASCOOS\FRAMEWORK\Kernel\Core\TObject;

use DateTime;
use DateTimeZone;
use Exception;


/******************************************************************************
 * @startcode TDatesHandler
 *****************************************************************************/
/**
 * @class   TDatesHandler
 * @extends TObject
 * 
 * @summary Handles dates operations.
 * 
 * 
 * [ VARIABLES ]
 * @var DateTime $timezone         Timezone
 * @var DateTime $currentDate      Current Date
 * @var DateTime $targetDate       Date for compare days 
 * @var DateTime $date 
 * 
 * 
 * [ METHODS ] 
 * @method void __construct(string $timezone='Europe/Athens', array $properties = [])  The constructor method for the class. It must always be overridden.
 * @method string addDays(string $date, int $days, string $format='Y-m-d')      Add a specified number of days to a date.
 * @method int calculateWeeksBetween(string $from, string $to)                  Calculate the number of weeks between two dates.
 * @method int calculateWeekendsBetween(string $from, string $to)               Calculate the number of weekends between two dates.
 * @method int calculateWorkingDaysBetween(string $from, string $to, string $format='Y-m-d') Calculate the number of working days between two dates.
 * @method string convertFromTimestamp(int $timestamp, string $format='Y-m-d H:i:s')  Convert the timestamp to a date.
 * @method int convertToTimestamp(string $date)                                 Convert the date to a timestamp.
 * @method int daysUntilNextWeekday(string $date, int $weekday)                 Calculate days until the next specified weekday. 
 * @method int|false diff_days(string $from, string $to = "now")                Finds the difference in days between two dates.
 * @method string diff_time(string $from, string $to, bool $full_days=false)    Calculate the difference in time between two dates.
 * @method string formatDate(string $date, string $format)                      Format the date with the specified format.
 * @method int getAge(string $birthdate)                                        Calculate the age.
 * @method string getBlackFriday(int $year, string $format='Y-m-d')             Calculate the date of Black Friday.
 * @method string getCatholicEaster(int $year)                                  Calculate the Catholic Easter date.
 * @method string getCleanMonday(int $year, string $format='Y-m-d')             Calculate the date of Clean Monday. 
 * @method string getCurrentDate(string $format = 'Y-m-d')                      Get the current date.
 * @method string getCurrentTime(string $format='H:i:s')                        Get the current time.
 * @method string getFirstDayOfCurrentYear(string $format='Y-m-d')              Get the first day of the current year. 
 * @method string getFirstDayOfMonth(string $date, string $format='Y-m-d')      Get the first day of the month for a given date.
 * @method string getGoodFriday(int $year, string $format='Y-m-d')              Calculate the date of Good Friday.
 * @method string getLastDayOfCurrentYear(string $format='Y-m-d')               Get the last day of the current year.
 * @method string getLastDayOfMonth(string $date, string $format='Y-m-d')       Get the last day of the month for a given date.
 * @method array getNationalHolidays(?int $year=null, array $holidays = [])     Get national holidays for a given year.
 * @method int getWeekNumber(string $date)                                      Get the week number of the year for a given date.
 * @method string getOrthodoxEaster(int $year, bool $old=false, string $format='Y-m-d') Calculate the Orthodox Easter date.
 * @method string getWeekday(string $date)                                      Get the day of the week.
 * @method string gregorianToJulian(string $gregorianDate, string $format='Y-m-d')  Convert Gregorian date to Julian date.
 * @method bool isLeapYear(int $year)                                           Check if a year is a leap year.
 * @method bool isWorkingDay(string $date)                                      Check if a date is a working day. 
 * @method string julianToGregorian(string $julianDate, string $format='Y-m-d')   Convert Julian date to Gregorian date.
 * @method string subtractDays(string $date, int $days, string $format='Y-m-d')   Subtract a specified number of days from a date.
 * 
 * [ INHERITANCE METHODS ]
 * @method string __toString()                                             Returns a string containing the name of this class.
 * @method bool Free(object $object)                                       Frees the memory of the Object or its clone.
 * @method bool FreeProperties(object $object)                             Delete and Frees up memory for all class properties.
 * @method bool getClassDeprecated()                                       Returns true if class is deprecated, otherwise false.
 * @method int getClassVersion()                                           We get the version of the class.
 * @method mixed getDeepProperty(array $keys, ?array $array = null)        Gets a property at any depth within the properties array.
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
class TDatesHandler extends TObject {
    // [ PROPERTIES]
    protected DateTimeZone $timezone;     // Timezone
    protected DateTime $currentDate;      // Current Date
    protected DateTime $targetDate;       // Date for compare days 

    private DateTime $date;  


    // [ METHODS ] 


    /**
     * Constructor.
     * 
     * @desc <English>  The constructor method for the class. It must always be overridden.
     * @desc <Greek>    Η μέθοδος κατασκευαστής της κλάσης. Πρέπει πάντα να ανακαθορίζεται.
     * 
     * @param string $timezone      <English>  The Timezone.
     *                               <Greek>    Η ζώνη ώρας.
     * @param array $properties      <English>  The properties to initialize the parent class with.
     *                               <Greek>    Οι ιδιότητες για την αρχικοποίηση της γονικής κλάσης.
     */    
    public function __construct(string $timezone='Europe/Athens', array $properties = [])     
    {
        /*
        <English>
            Initialize class properties with default values.
        </English>
        <Greek>
            Αρχικοποιούμε τις ιδιότητες της κλάσης με τις προκαθορισμένες τιμές.
        </Greek>
        */
        parent::__construct($properties);

        /*
        <English>
            Override properties with provided values if any.
        </English>
        <Greek>
            Αντικαθιστά τις ιδιότητες με τις παρεχόμενες τιμές, εάν υπάρχουν.
        </Greek>
        */
        if (!empty($properties)) {
            parent::setProperties($properties);
        }

        /*
        <English>
            We create the internal time zone object
        </English>
        <Greek>
            Δημιουργούμε το εσωτερικό αντικείμενο ζώνης ώρας
        </Greek>
        */ 
        $this->timezone = new DateTimeZone($timezone);


        /*
        <English>
            We create the object of the current date and time.
        </English>
        <Greek>
            Δημιουργούμε το αντικείμενο της τρέχουσας ημερομηνίας και ώρας.
        </Greek>
        */        
        $this->currentDate = new DateTime("now", $this->timezone);
    }


    /**
     * Add days to a date.
     * 
     * @desc <English>  Add a specified number of days to a date.
     *       <Greek>    Προσθήκη ενός συγκεκριμένου αριθμού ημερών σε μια ημερομηνία.
     * 
     * @param string $date <English>  The initial date.
     *                     <Greek>    Η αρχική ημερομηνία.
     * @param int    $days <English>  The number of days to add.
     *                     <Greek>    Ο αριθμός των ημερών που θα προστεθούν.
     * 
     * @return string      <English>  The new date.
     *                     <Greek>    Η νέα ημερομηνία.
     */
    public function addDays(string $date, int $days, string $format='Y-m-d'): string {
        $this->date = new DateTime($date, $this->timezone);
        $this->date->modify("+{$days} days");
        return $this->date->format($format);
    }


    /**
     * Calculate the number of weeks between two dates.
     * 
     * @desc <English>  Calculate the number of weeks between two dates.
     *       <Greek>    Υπολογισμός του αριθμού εβδομάδων μεταξύ δύο ημερομηνιών.
     * 
     * @param string $from <English>  The start date.
     *                     <Greek>    Η ημερομηνία έναρξης.
     * @param string $to   <English>  The end date.
     *                     <Greek>    Η ημερομηνία λήξης.
     * 
     * @return int        <English>  The number of weeks.
     *                    <Greek>    Ο αριθμός των εβδομάδων.
     */
    public function calculateWeeksBetween(string $from, string $to): int {
        $startDate = new DateTime($from, $this->timezone);
        $endDate = new DateTime($to, $this->timezone);
        $interval = $startDate->diff($endDate);
        return (int) floor($interval->days / 7);
    }


    /**
     * Calculate the number of weekends between two dates.
     * 
     * @desc <English>  Calculate the number of weekends between two dates.
     *       <Greek>    Υπολογισμός του αριθμού των Σαββατοκύριακων μεταξύ δύο ημερομηνιών.
     * 
     * @param string $from <English>  The start date.
     *                     <Greek>    Η ημερομηνία έναρξης.
     * @param string $to   <English>  The end date.
     *                     <Greek>    Η ημερομηνία λήξης.
     * 
     * @return int         <English>  The number of weekends.
     *                     <Greek>    Ο αριθμός των Σαββατοκύριακων.
     */
    public function calculateWeekendsBetween(string $from, string $to): int {
        $startDate = new DateTime($from, $this->timezone);
        $endDate = new DateTime($to, $this->timezone);
        $weekends = 0;

        while ($startDate <= $endDate) {
            if ($startDate->format('N') >= 6) { // N returns 6 for Saturday and 7 for Sunday
                $weekends++;
            }
            $startDate->modify('+1 day');
        }

        return $weekends;
    }


    /**
     * Calculate the number of working days between two dates.
     * 
     * @desc <English>  Calculate the number of working days between two dates.
     *       <Greek>    Υπολογισμός του αριθμού των εργάσιμων ημερών μεταξύ δύο ημερομηνιών.
     * 
     * @param string $from     <English>  The start date.
     *                         <Greek>    Η ημερομηνία έναρξης.
     * @param string $to       <English>  The end date.
     *                         <Greek>    Η ημερομηνία λήξης.
     * 
     * @return int             <English>  The number of working days.
     *                         <Greek>    Ο αριθμός των εργάσιμων ημερών.
     */
    public function calculateWorkingDaysBetween(string $from, string $to, string $format='Y-m-d'): int 
    {
        $startDate = new DateTime($from, $this->timezone);
        $endDate = new DateTime($to, $this->timezone);
        $workingDays = 0;

        while ($startDate <= $endDate) {
            if ($this->isWorkingDay($startDate->format($format))) {
                $workingDays++;
            }
            $startDate->modify('+1 day');
        }

        return $workingDays;
    }



    /**
     * Convert timestamp to date.
     * 
     * @desc <English>  Convert the timestamp to a date.
     *       <Greek>    Μετατροπή του timestamp σε ημερομηνία.
     * 
     * @param int $timestamp <English>  The timestamp to convert.
     *                       <Greek>    Το timestamp προς μετατροπή.
     * 
     * @param string $format <English>  The date format to use.
     *                       <Greek>    Ο μορφότυπος ημερομηνίας που θα χρησιμοποιηθεί.
     * 
     * @return string       <English>  The date.
     *                      <Greek>    Η ημερομηνία.
     */
    public function convertFromTimestamp(int $timestamp, string $format = 'Y-m-d H:i:s'): string
    {
        $this->date = (new DateTime())->setTimestamp($timestamp);
        return $this->date->format($format);
    }


    /**
     * Convert date to timestamp.
     * 
     * @desc <English>  Convert the date to a timestamp.
     *       <Greek>    Μετατροπή της ημερομηνίας σε timestamp.
     * 
     * @param string $date <English>  The date to convert.
     *                     <Greek>    Η ημερομηνία προς μετατροπή.
     * 
     * @return int         <English>  The timestamp.
     *                     <Greek>    Το timestamp.
     */
    public function convertToTimestamp(string $date): int
    {
        $this->date = new DateTime($date, $this->timezone);
        return $this->date->getTimestamp();
    }


    /**
     * Calculate days until the next specified weekday.
     * 
     * @desc <English>  Calculate the number of days until the next specified weekday.
     *       <Greek>    Υπολογισμός του αριθμού ημερών μέχρι την επόμενη καθορισμένη ημέρα της εβδομάδας.
     * 
     * @param string $date     <English>  The starting date.
     *                         <Greek>    Η ημερομηνία έναρξης.
     * @param int    $weekday  <English>  The target weekday (1 for Monday, 7 for Sunday).
     *                         <Greek>    Η καθορισμένη ημέρα της εβδομάδας (1 για Δευτέρα, 7 για Κυριακή).
     * 
     * @return int             <English>  The number of days until the next specified weekday.
     *                         <Greek>    Ο αριθμός ημερών μέχρι την επόμενη καθορισμένη ημέρα της εβδομάδας.  
     */
    public function daysUntilNextWeekday(string $date, int $weekday): int {
        $this->date = new DateTime($date, $this->timezone);
        $currentWeekday = (int) $this->date->format('N');
        $daysUntilNext = ($weekday - $currentWeekday + 7) % 7;
        return $daysUntilNext === 0 ? 7 : $daysUntilNext;  // Αν είναι η ίδια ημέρα, επιστρέφει 7 ημέρες μετά
    }

    
    /**
     * Finds the difference in days between two dates
     * 
     * @desc <English>  It finds the difference in days between two dates and returns it as an integer, otherwise False.
     * @desc <Greek>    Βρίσκει την διαφορά ημερών ανάμεσα σε δύο ημερομηνίες και την επιστρέφει ως ακέραιο, αλλίως False.
     * 
     * @param string $from      <English>  The target date for the comparison. 
     *                          <Greek>    Η ημερομηνία στόχος για την σύγκριση. 
     * @param string $to        <English>  The starting date for the comparison. (Usually the current date and time)
     *                          <Greek>    Η ημερομηνία αφετερία για την σύγκριση. (Συνήθως η τρέχουσα ημερομηνία και ώρα)
     * 
     * @return int|false        <English>  Returns the difference of days as an integer, otherwise False
     *                          <Greek>    Επιστρέφει την διαφορά ημερών ως ακέραιο, αλλίως False
     */
    public function diff_days(string $from, string $to = "now"): int|false
    {        
        /*
        <English>
            Target date e.g. "Fri, 11 Oct 2024 17:49:23 GMT"
        </English>
        <Greek>
            Δημιουργούμε το αντικείμενο της ημερομηνίας στόχου, π.χ. "Fri, 11 Oct 2024 17:49:23 GMT".
        </Greek>
        */           
        $this->targetDate = new DateTime($from);

        /*
        <English>
            We recreate the object of the current date and time or the date of the user.
        </English>
        <Greek>
            Επαναδημιουργούμε το αντικείμενο της τρέχουσας ημερομηνίας και ώρας ή της ημερομηνίας του χρήστη.
        </Greek>
        */           
        if ($to !== 'now')         
            $this->currentDate = new DateTime($to, $this->timezone);
        else
            $this->reNow();
    
        /*
        <English>
            Calculation of difference
        </English>
        <Greek>
            Υπολογίζουμε την διαφορά ημερομηνίας.
        </Greek>
        */           
        $interval = $this->currentDate->diff($this->targetDate);
    
        /*
        <English>
            Return difference in days
        </English>
        <Greek>
            Επιστρέφουμε την διαφορά σε ημέρες
        </Greek>
        */           
        return $interval->days;
    }


    /**
     * Calculate difference in time.
     * 
     * @desc <English>  Calculate the difference in time between two dates.
     *       <Greek>    Υπολογισμός της διαφοράς ώρας ανάμεσα σε δύο ημερομηνίες.
     * 
     * @param string $from <English>  The start date.
     *                     <Greek>    Η ημερομηνία έναρξης.
     * @param string $to   <English>  The end date.
     *                     <Greek>    Η ημερομηνία λήξης.
     * 
     * @return string      <English>  The difference in hours, minutes, and seconds.
     *                     <Greek>    Η διαφορά σε ώρες, λεπτά και δευτερόλεπτα.
     */
    public function diff_time(string $from, string $to, bool $full_days=false): string
    {
        $startDate = new DateTime($from, $this->timezone);
        $endDate = new DateTime($to, $this->timezone);
        $interval = $startDate->diff($endDate);
        unset($startDate);
        unset($endDate);

        if ($full_days)
            return $interval->format("%H:%I:%S (Full days: %a)");
        else
            return $interval->format("%H:%I:%S");
    }


    /**
     * Format the date.
     * 
     * @desc <English>  Format the date with the specified format.
     *       <Greek>    Μορφοποίηση της ημερομηνίας με το καθορισμένο μοτίβο.
     * 
     * @param string $date   <English>  The date to format.
     *                       <Greek>    Η ημερομηνία προς μορφοποίηση.
     * @param string $format <English>  The format to apply.
     *                       <Greek>    Το μοτίβο που θα εφαρμοστεί.
     * 
     * @return string        <English>  The formatted date.
     *                       <Greek>    Η μορφοποιημένη ημερομηνία.
     */
    public function formatDate(string $date, string $format): string {
        $this->date = new DateTime($date, $this->timezone);
        return $this->date->format($format);
    }


    /**
     * Calculate the age.
     * 
     * @desc <English>  Calculate age in years from the given birthdate.
     *       <Greek>    Υπολογισμός της ηλικίας σε έτη από την δοθείσα ημερομηνία γέννησης.
     * 
     * @param string $birthdate <English>  The birthdate.
     *                          <Greek>    Η ημερομηνία γέννησης.
     * 
     * @return int              <English>  The age in years.
     *                          <Greek>    Η ηλικία σε έτη.
     */
    public function getAge(string $birthdate): int
    {
        $birthDate = new DateTime($birthdate, $this->timezone);
        $this->reNow();
        $interval = $this->currentDate->diff($birthDate);
        return (int) $interval->y;
    }    


    /**
     * Calculate the date of Black Friday.
     * 
     * @desc <English>  Calculate the date of Black Friday for the given year.
     *       <Greek>    Υπολογισμός της ημερομηνίας της Black Friday για το δοθέν έτος.
     * 
     * @param int $year <English>  The year to calculate Black Friday for.
     *                  <Greek>    Το έτος για τον υπολογισμό της Black Friday.
     * 
     * @return string   <English>  The date of Black Friday.
     *                  <Greek>    Η ημερομηνία της Black Friday.
     */
    public function getBlackFriday(int $year, string $format='Y-m-d'): string {
        $region = $this->properties['region'] ?? 'US';
        
        if ($region === 'US') {
            // Black Friday στις ΗΠΑ είναι η επόμενη ημέρα της Ημέρας των Ευχαριστιών
            $thanksgiving = new DateTime("fourth thursday of november $year", $this->timezone);
            $blackFriday = clone $thanksgiving;
            $blackFriday->modify('+1 day');
        } elseif ($region === 'EU') {
            // Black Friday στην Ευρώπη είναι η τελευταία Παρασκευή του Νοεμβρίου
            $blackFriday = new DateTime("last friday of november $year", $this->timezone);
        } else {
            throw new Exception("Region not supported for Black Friday calculation.");
        }
        
        return $blackFriday->format($format);
    }


    /**
     * Calculate the Catholic Easter date.
     * 
     * @desc <English>  Calculate the Catholic Easter date for the given year.
     *       <Greek>    Υπολογισμός της ημερομηνίας του Καθολικού Πάσχα για το δοθέν έτος.
     * 
     * @param int $year <English>  The year to calculate Easter for.
     *                  <Greek>    Το έτος για τον υπολογισμό του Πάσχα.
     * 
     * @return string   <English>  The date of Catholic Easter.
     *                  <Greek>    Η ημερομηνία του Καθολικού Πάσχα.
     */
    public function getCatholicEaster(int $year): string {
        $a = $year % 19;
        $b = intdiv($year, 100);
        $c = $year % 100;
        $d = intdiv($b, 4);
        $e = $b % 4;
        $f = intdiv($b + 8, 25);
        $g = intdiv($b - $f + 1, 3);
        $h = (19 * $a + $b - $d - $g + 15) % 30;
        $i = intdiv($c, 4);
        $k = $c % 4;
        $l = (32 + 2 * $e + 2 * $i - $h - $k) % 7;
        $m = intdiv($a + 11 * $h + 22 * $l, 451);
        $month = intdiv($h + $l - 7 * $m + 114, 31);
        $day = (($h + $l - 7 * $m + 114) % 31) + 1;
        return sprintf("%04d-%02d-%02d", $year, $month, $day);
    }


    /**
     * Calculate the date of Clean Monday.
     * 
     * @desc <English>  Calculate the date of Clean Monday for the given year.
     *       <Greek>    Υπολογισμός της ημερομηνίας της Καθαράς Δευτέρας για το δοθέν έτος.
     * 
     * @param int $year <English>  The year to calculate Clean Monday for.
     *                  <Greek>    Το έτος για τον υπολογισμό της Καθαράς Δευτέρας.
     * 
     * @return string   <English>  The date of Clean Monday.
     *                  <Greek>    Η ημερομηνία της Καθαράς Δευτέρας.
     */
    public function getCleanMonday(int $year, string $format='Y-m-d'): string {
        $easterSunday = new DateTime($this->getOrthodoxEaster($year), $this->timezone);
        $cleanMonday = clone $easterSunday;
        $cleanMonday->modify('-48 days');  // Καθαρά Δευτέρα είναι 48 ημέρες πριν το Ορθόδοξο Πάσχα
        return $cleanMonday->format($format);
    }   


    /**
     * Get the current date.
     * 
     * @desc <English>  Get the current date in the specified format.
     *       <Greek>    Επιστροφή της τρέχουσας ημερομηνίας στο καθορισμένο μορφότυπο.
     * 
     * @param string $format <English>  The date format to use.
     *                       <Greek>    Ο μορφότυπος ημερομηνίας που θα χρησιμοποιηθεί.
     * 
     * @return string        <English>  The current date in the specified format.
     *                       <Greek>    Η τρέχουσα ημερομηνία στο καθορισμένο μορφότυπο.
     */
    public function getCurrentDate(string $format = 'Y-m-d'): string {
        $this->reNow();
        return $this->currentDate->format($format);
    }


    /**
     * Get current time.
     * 
     * @desc <English>  Get the current time.
     *       <Greek>    Επιστροφή της τρέχουσας ώρας.
     * 
     * @return string   <English>  The current time.
     *                  <Greek>    Η τρέχουσα ώρα.
     */
    public function getCurrentTime(string $format='H:i:s'): string {
        $this->reNow();
        return $this->currentDate->format($format);
    }


    /**
     * Get the first day of the current year.
     * 
     * @desc <English>  Get the first day of the current year.
     *       <Greek>    Επιστροφή της πρώτης ημέρας του τρέχοντος έτους.
     * 
     * @return string   <English>  The first day of the current year.
     *                  <Greek>    Η πρώτη ημέρα του τρέχοντος έτους.
     */
    public function getFirstDayOfCurrentYear(string $format='Y-m-d'): string {
        $this->reNow();
        $this->date = new DateTime($this->currentDate->format('Y').'-01-01', $this->timezone);
        return $this->date->format($format);
    }


    /**
     * Get the first day of the month for a given date.
     * 
     * @desc <English>  Get the first day of the month for the given date.
     *       <Greek>    Επιστροφή της πρώτης ημέρας του μήνα για την δοθείσα ημερομηνία.
     * 
     * @param string $date <English>  The date to check.
     *                     <Greek>    Η ημερομηνία προς έλεγχο.
     * 
     * @return string      <English>  The first day of the month.
     *                     <Greek>    Η πρώτη ημέρα του μήνα.
     */
    public function getFirstDayOfMonth(string $date, string $format='Y-m-d'): string
    {
        $this->date = new DateTime($date, $this->timezone);
        $this->date->modify('first day of this month');
        return $this->date->format($format);
    }


    /**
     * Calculate the date of Good Friday.
     * 
     * @desc <English>  Calculate the date of Good Friday for the given year.
     *       <Greek>    Υπολογισμός της ημερομηνίας της Μεγάλης Παρασκευής για το δοθέν έτος.
     * 
     * @param int $year <English>  The year to calculate Good Friday for.
     *                  <Greek>    Το έτος για τον υπολογισμό της Μεγάλης Παρασκευής.
     * 
     * @return string   <English>  The date of Good Friday.
     *                  <Greek>    Η ημερομηνία της Μεγάλης Παρασκευής.
     */
    public function getGoodFriday(int $year, string $format='Y-m-d'): string {
        $easterSunday = new DateTime($this->getOrthodoxEaster($year), $this->timezone);
        $goodFriday = clone $easterSunday;
        $goodFriday->modify('-2 days');  // Μεγάλη Παρασκευή είναι 2 ημέρες πριν το Ορθόδοξο Πάσχα
        return $goodFriday->format($format);
    }


    /**
     * Get the last day of the current year.
     * 
     * @desc <English>  Get the last day of the current year.
     *       <Greek>    Επιστροφή της τελευταίας ημέρας του τρέχοντος έτους.
     * 
     * @return string   <English>  The last day of the current year.
     *                  <Greek>    Η τελευταία ημέρα του τρέχοντος έτους.
     */
    public function getLastDayOfCurrentYear(string $format='Y-m-d'): string {
        $this->reNow();
        $this->date = new DateTime($this->currentDate->format('Y').'-12-31', $this->timezone);
        return $this->date->format($format);
    }
        

    /**
     * Get the last day of the month for a given date.
     * 
     * @desc <English>  Get the last day of the month for the given date.
     *       <Greek>    Επιστροφή της τελευταίας ημέρας του μήνα για την δοθείσα ημερομηνία.
     * 
     * @param string $date <English>  The date to check.
     *                     <Greek>    Η ημερομηνία προς έλεγχο.
     * 
     * @return string      <English>  The last day of the month.
     *                     <Greek>    Η τελευταία ημέρα του μήνα.
     */
    public function getLastDayOfMonth(string $date, string $format='Y-m-d'): string {
        $this->date = new DateTime($date, $this->timezone);
        $this->date->modify('last day of this month');
        return $this->date->format($format);
    }


    /**
     * Get national holidays for a given year.
     * 
     * @desc <English>  Get the list of national holidays for the specified year.
     *       <Greek>    Επιστροφή της λίστας εθνικών αργιών για το καθορισμένο έτος.
     * 
     * @param int $year    <English>  The year to get holidays for.
     *                     <Greek>    Το έτος για το οποίο θα ληφθούν οι αργίες.
     * 
     * @return array       <English>  The list of national holidays.
     *                     <Greek>    Η λίστα των εθνικών αργιών.
     */
    public function getNationalHolidays(?int $year=null, array $holidays = []): array
    {
        if (is_null($year))
        {
            $year = $this->properties['year'] ?? $this->getCurrentDate('Y');
        }
        

        // $holidays = $this->properties['holidays'] ?? [];
        if (empty($holidays)) {
            $holidays = $this->properties['holidays'] ?? [];
        }

        // Προσθήκη Ορθόδοξου Πάσχα εάν δηλώνεται
        if ( 
            key_exists('have_holidays_orthodox_easter', $this->properties) 
                && ($this->properties['have_holidays_orthodox_easter'] !== false)
        )
        {
            // Προσθήκη Ορθόδοξου Πάσχα αν δεν υπάρχει
            if (!isset($holidays["Orthodox Easter"])) {
                $holidays["Orthodox Easter"] = $this->getOrthodoxEaster($year);
            }
            // Προσθήκη 2ης ημέρας Ορθόδοξου Πάσχα αν δεν υπάρχει
            if (!isset($holidays["Orthodox Easter 2st Day"])) {
                $secondDay = $this->addDays($holidays["Orthodox Easter"], 1);
                $holidays["Orthodox Easter 2st Day"] = $secondDay;
            }            
        }

        // Προσθήκη Καθολικού Πάσχα εάν δηλώνεται
        if ( 
            key_exists('have_holidays_catholic_easter', $this->properties) 
                && ($this->properties['have_holidays_catholic_easter'] !== false)
        )        
        {
            // Προσθήκη Καθολικού Πάσχα αν δεν υπάρχει
            if (!isset($holidays["Catholic Easter"])) {
                $holidays["Catholic Easter"] = $this->getCatholicEaster($year);
            }           
        }
        
        // Προσθήκη 2ης ημέρας του Καθολικού Πάσχα εάν δηλώνεται
        if ( 
            key_exists('have_holidays_catholic_easter_second_day', $this->properties) 
                && ($this->properties['have_holidays_catholic_easter_second_day'] !== false)
        )        
        {
            // Προσθήκη 2ης ημέρας Καθολικού Πάσχα αν δεν υπάρχει
            if (!isset($holidays["Catholic Easter 2st Day"]))
            {
                $secondDay = $this->addDays($holidays["Catholic Easter"], 1);
                $holidays["Catholic Easter 2st Day"] = $secondDay;
            }           
        }

        // Προσθήκη Καθολικού Πάσχα εάν δηλώνεται
        if (key_exists('have_holidays_topic', $this->properties) && ($this->properties['have_holidays_topic'] !== false))         
        {
            $topic_holidays = $this->properties['topic_holidays'] ?? [];
            foreach ($topic_holidays as $holiday => $date) {
                $holidays[$holiday] = $date;
            }
         
        }

        return $holidays;
    }    

    /**
     * Calculate the Orthodox Easter date.
     * 
     * @desc <English>  Calculate the Orthodox Easter date for the given year.
     *       <Greek>    Υπολογισμός της ημερομηνίας του Ορθόδοξου Πάσχα για το δοθέν έτος.
     * 
     * @param int $year <English>  The year to calculate Easter for.
     *                  <Greek>    Το έτος για τον υπολογισμό του Πάσχα.
     * @param bool $old <English>  True for old Julian calendar, false for Gregorian.
     *                  <Greek>    True για το παλαιό Ιουλιανό ημερολόγιο, false για το Γρηγοριανό.
     * 
     * @return string   <English>  The date of Orthodox Easter.
     *                  <Greek>    Η ημερομηνία του Ορθόδοξου Πάσχα.
     */
    public function getOrthodoxEaster(int $year, bool $old = false, string $format='Y-m-d'): string {
        // Υπολογισμός της ημερομηνίας του Ορθόδοξου Πάσχα
        $easter = (19 * ($year % 19) + 16) % 30 + (2 * ($year % 4) + 4 * ($year % 7) + 6 * ((19 * ($year % 19) + 16) % 30)) % 7 + 3;

        if ($easter > 30) {
            $month = 5;
            $day = $easter - 30;
        } else {
            $month = 4;
            $day = $easter;                
        }        
        $this->date = new DateTime("$year-$month-$day", $this->timezone);
        if ($old) {
            $this->date->modify('-13 days');  // Αφαίρεση 13 ημερών για μετατροπή από Γρηγοριανό σε Ιουλιανό.
        }
        return $this->date->format($format);
    }


    /**
     * Get the day of the week.
     * 
     * @desc <English>  Get the day of the week for the specified date.
     *       <Greek>    Εύρεση της ημέρας της εβδομάδας για την καθορισμένη ημερομηνία.
     * 
     * @param string $date <English>  The date to check.
     *                     <Greek>    Η ημερομηνία που θα ελεγχθεί.
     * 
     * @return string      <English>  The day of the week.
     *                     <Greek>    Η ημέρα της εβδομάδας.
     */
    public function getWeekday(string $date): string {
        $this->date = new DateTime($date, $this->timezone);
        return $this->date->format('l');
    }


    /**
     * Get the week number of the year for a given date.
     * 
     * @desc <English>  Get the week number of the year for the given date.
     *       <Greek>    Επιστροφή του αριθμού εβδομάδας του έτους για την δοθείσα ημερομηνία.
     * 
     * @param string $date <English>  The date to check.
     *                     <Greek>    Η ημερομηνία προς έλεγχο.
     * 
     * @return int         <English>  The week number of the year.
     *                     <Greek>    Ο αριθμός εβδομάδας του έτους.
     */
    public function getWeekNumber(string $date): int {
        $this->date = new DateTime($date, $this->timezone);
        return (int) $this->date->format('W');
    }


    /**
     * Convert Gregorian date to Julian date.
     * 
     * @desc <English>  Convert a Gregorian date to a Julian date.
     *       <Greek>    Μετατροπή μιας Γρηγοριανής ημερομηνίας σε Ιουλιανή ημερομηνία.
     * 
     * @param string $gregorianDate <English>  The Gregorian date to convert.
     *                              <Greek>    Η Γρηγοριανή ημερομηνία προς μετατροπή.
     * 
     * @return string               <English>  The Julian date.
     *                              <Greek>    Η Ιουλιανή ημερομηνία.
     */
    public function gregorianToJulian(string $gregorianDate, string $format='Y-m-d'): string {
        $gregorian = new DateTime($gregorianDate, $this->timezone);
        $gregorian->modify('-13 days');  // Αφαίρεση 13 ημερών για τη μετατροπή από Γρηγοριανό σε Ιουλιανό
        return $gregorian->format($format);
    }    


    /**
     * Check if a year is a leap year.
     * 
     * @desc <English>  Check if the specified year is a leap year.
     *       <Greek>    Έλεγχος αν το καθορισμένο έτος είναι δίσεκτο.
     * 
     * @param int $year <English>  The year to check.
     *                  <Greek>    Το έτος που θα ελεγχθεί.
     * 
     * @return bool     <English>  True if it's a leap year, otherwise false.
     *                  <Greek>    True αν είναι δίσεκτο έτος, αλλιώς false.
     */
    public function isLeapYear(int $year): bool {
        return ($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0);
    }


    /**
     * Check if a date is a working day.
     * 
     * @desc <English>  Check if a date is a working day.
     *       <Greek>    Έλεγχος αν μια ημερομηνία είναι εργάσιμη ημέρα.
     * 
     * @param string $date     <English>  The date to check.
     *                         <Greek>    Η ημερομηνία προς έλεγχο.
     * 
     * @return bool            <English>  True if the date is a working day, false otherwise.
     *                         <Greek>    True αν η ημερομηνία είναι εργάσιμη ημέρα, αλλιώς false.
     */
    public function isWorkingDay(string $date, string $format='Y-m-d'): bool {
        $holidays = $this->properties['holidays'] ?? [];
        $this->date = new DateTime($date, $this->timezone);

        // Check if it's a weekend
        if ($this->date->format('N') >= 6) {
            return false;
        }

        // Check if it's a holiday
        if (in_array($this->date->format($format), $holidays)) {
            return false;
        }

        return true;
    }


    /**
     * Convert Julian date to Gregorian date.
     * 
     * @desc <English>  Convert a Julian date to a Gregorian date.
     *       <Greek>    Μετατροπή μιας Ιουλιανής ημερομηνίας σε Γρηγοριανή ημερομηνία.
     * 
     * @param string $julianDate <English>  The Julian date to convert.
     *                           <Greek>    Η Ιουλιανή ημερομηνία προς μετατροπή.
     * 
     * @return string            <English>  The Gregorian date.
     *                           <Greek>    Η Γρηγοριανή ημερομηνία.
     */
    public function julianToGregorian(string $julianDate, string $format='Y-m-d'): string 
    {
        $julian = new DateTime($julianDate, $this->timezone);
        $julian->modify('+13 days');  // Προσθήκη 13 ημερών για τη μετατροπή από Ιουλιανό σε Γρηγοριανό
        return $julian->format($format);
    }


    /**
     * Create Current date and time
     * 
     * @return void
     */
    private function reNow() 
    {
        // Current date and time
        $this->currentDate = new DateTime("now", $this->timezone);        
    }



    /**
     * Subtract days from a date.
     * 
     * @desc <English>  Subtract a specified number of days from a date.
     *       <Greek>    Αφαίρεση ενός συγκεκριμένου αριθμού ημερών από μια ημερομηνία.
     * 
     * @param string $date <English>  The initial date.
     *                     <Greek>    Η αρχική ημερομηνία.
     * @param int    $days <English>  The number of days to subtract.
     *                     <Greek>    Ο αριθμός των ημερών που θα αφαιρεθούν.
     * 
     * @return string      <English>  The new date.
     *                     <Greek>    Η νέα ημερομηνία.
     */
    public function subtractDays(string $date, int $days, string $format='Y-m-d'): string {
        $this->date = new DateTime($date, $this->timezone);
        $this->date->modify("-{$days} days");
        return $this->date->format($format);
    }  

}
/******************************************************************************
 * @endcode TDatesHandler
 *****************************************************************************/
?>