# Class `TDatesHandler`

***This class handles dates operations***

>### Extends `TObject`

## Use:
```php
use ASCOOS\FRAMEWORK\Kernel\Dates\TDatesHandler;
   
$objDates = new TDatesHandler('Europe/Athens');

$date = $objDates->getCurrentDate("Y-m-d");
echo "Current Date: $date \n";  // Output: Current Date: YYYY-MM-DD
$daysToAdd = 10;
$newDate = $objDates->addDays($date, $daysToAdd);
echo "New Date after adding $daysToAdd days: $newDate \n";

$objDates->Free($objDates);
```

***

## `Properties`
* Protected `DateTime $timezone` : Timezone
* Protected `DateTime $currentDate` : Current Date
* Protected `DateTime $targetDate` : Date for compare days


## `Methods`
* `void __construct(string $timezone='Europe/Athens', array $properties = [])` : The constructor method for the class. It must always be overridden.
* `string addDays(string $date, int $days, string $format='Y-m-d')` : Add a specified number of days to a date.
* `int calculateWeeksBetween(string $from, string $to)` : Calculate the number of weeks between two dates.
* `int calculateWeekendsBetween(string $from, string $to)` : Calculate the number of weekends between two dates.
* `int calculateWorkingDaysBetween(string $from, string $to, string $format='Y-m-d')` : Calculate the number of working days between two dates.
* `string convertFromTimestamp(int $timestamp, string $format='Y-m-d H:i:s')` : Convert the timestamp to a date.
* `int convertToTimestamp(string $date)` : Convert the date to a timestamp.
* `int daysUntilNextWeekday(string $date, int $weekday)` : Calculate days until the next specified weekday. 
* `int|false diff_days(string $from, string $to = "now")` : Finds the difference in days between two dates.
* `string diff_time(string $from, string $to, bool $full_days=false)` : Calculate the difference in time between two dates.
* `string formatDate(string $date, string $format)` : Format the date with the specified format.
* `int getAge(string $birthdate)` : Calculate the age.
* `string getBlackFriday(int $year, string $format='Y-m-d')` : Calculate the date of Black Friday.
* `string getCatholicEaster(int $year)` : Calculate the Catholic Easter date.
* `string getCleanMonday(int $year, string $format='Y-m-d')` : Calculate the date of Clean Monday. 
* `string getCurrentDate(string $format = 'Y-m-d')` : Get the current date.
* `string getCurrentTime(string $format='H:i:s')` : Get the current time.
* `string getFirstDayOfCurrentYear(string $format='Y-m-d')` : Get the first day of the current year. 
* `string getFirstDayOfMonth(string $date, string $format='Y-m-d')` : Get the first day of the month for a given date.
* `string getGoodFriday(int $year, string $format='Y-m-d')` : Calculate the date of Good Friday.
* `string getLastDayOfCurrentYear(string $format='Y-m-d')` : Get the last day of the current year.
* `string getLastDayOfMonth(string $date, string $format='Y-m-d')` : Get the last day of the month for a given date.
* `array getNationalHolidays(?int $year=null, array $holidays = [])` : Get national holidays for a given year.
* `int getWeekNumber(string $date)` : Get the week number of the year for a given date.
* `string getOrthodoxEaster(int $year, bool $old=false, string $format='Y-m-d')` : Calculate the Orthodox Easter date.
* `string getWeekday(string $date)` : Get the day of the week.
* `string gregorianToJulian(string $gregorianDate, string $format='Y-m-d')` : Convert Gregorian date to Julian date.
* `bool isLeapYear(int $year)` : Check if a year is a leap year.
* `bool isWorkingDay(string $date)` : Check if a date is a working day. 
* `string julianToGregorian(string $julianDate, string $format='Y-m-d')` : Convert Julian date to Gregorian date.
* `string subtractDays(string $date, int $days, string $format='Y-m-d')` : Subtract a specified number of days from a date.

***

<details>
<summary>🟠 INHERITANCES</summary>

- `TObject Methods` 
    * `string __toString()` : Returns a string containing the name of this class.
    * `bool Free(object $object)` : Frees the memory of the Object or its clone.
    * `bool FreeProperties(object $object)` : Delete and Frees up memory for all class properties.
    * `bool getClassDeprecated()` : Returns true if class is deprecated, otherwise false.
    * `int getClassVersion()` : We get the version of the class.
    * `array getProperties()` : Returns the table of class properties.
    * `mixed getProperty(string $property)` : Returns the content of the requested property.
    * `?array getPublicProperties()` : Returns an array of the public properties of the class.
    * `int|false getVersion(string $property)` : Get the version as an integer.       
    * `string|false getVersionStr(string $property)` : Get the version as a formatted string.
    * `bool isExecutable(int $currentVersion, int $currentPHPVersion)` : Checks whether the current version of the class is executable according to the minimum and maximum versions you specify.
    * `void setProjectVersion(int|string $version = -1)` : Sets the project version.
    * `void setProperties(array $properties, string|int|null $property_key=null)` : Set the properties of the class.
    * `bool setProperty(string $property, mixed $value, string|int|null $property_key=null)` : Set a single property of the class.

</details>