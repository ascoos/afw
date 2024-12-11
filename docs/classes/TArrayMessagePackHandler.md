# Class `TArrayMessagePackHandler`

***This class handles MessagePack format arrays.***

>### Extends `TArrayHandler`

## Use:
```php
    use ASCOOS\FRAMEWORK\Extras\Arrays\MessagePack\TArrayMessagePackHandler;
    
    $filePath = 'data.msg';
    $arrayData = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    $objArray = new TArrayMessagePackHandler($arrayData); // Initialize TArrayMessagePackHandler class
    $objArray->toMessagePack(string $filePath); // Converts array to MessagePack format and saves to file.
    $objArray->Free($objArray); // Destructs and frees memory of object    
```


## `Methods`
* `void toMessagePack(string $filePath)` : Converts array to MessagePack format and saves to file.
* `void fromMessagePack(string $filePath)` : Converts MessagePack format to array.

***

<details>
<summary>🟠 INHERITANCES</summary>


- `TArrayHandler Methods`
    * `void __construct(array $array = [], array $properties = [])` : The constructor method for the class.
    * `string toJSON ()` : Converts array to JSON string.
    * `void fromJSON(string $json)` : Converts JSON string to array.
    * `string toXML()` : Converts array to XML string.
    * `void fromXML(string $xml)` : Converts XML string to array.
    * `object toObject()` : Converts array to an object.
    * `void fromObject(object $object)` : Converts an object to array.
    * `void toINI(string $filePath)` : Converts array to INI format and saves to file.
    * `void fromINI(string $filePath)` : Converts INI file to array.
    * `string toRSS()` : Converts array to RSS feed format.
    * `void fromRSS(string $rss)` : Converts RSS feed format to array.
    * `void toPHPArrayFile(string $filePath)` : Creates a PHP file that returns the array.
    * `void fromPHPArrayFile(string $filePath)` : Reads a PHP file that returns an array and assigns it to the internal array.
    * `void toPHPVariablesFile(string $filePath)` : Creates a PHP file that defines variables for the array elements.
    * `void fromPHPVariablesFile(string $filePath)` : Reads a PHP file that defines variables and assigns them to the internal array.
    * `void toCSV(string $filePath)` : Converts array to CSV format and saves to file.
    * `void fromCSV(string $filePath)` : Converts CSV format to array.
    * `void toYAML(string $filePath)` : Converts array to YAML format and saves to file.
    * `void fromYAML(string $filePath)` : Converts YAML format to array.
    * `void toBSON(string $filePath)` : Converts array to a binary-like format and saves to file.
    * `void fromBSON(string $filePath)` : Converts binary-like format to array.
    * `void toTOML(string $filePath)` : Converts array to TOML format and saves to file.
    * `void fromTOML(string $filePath)` : Converts TOML format to array.
    * `void toPlainText(string $filePath)` : Converts array to plain text format and saves to file.
    * `void fromPlainText(string $filePath)` : Converts plain text format to array.
    * `bool empty(array $array)` : Checks if an array is empty.
    * `array filter(callable $callback)` : Filters the array based on a callback function.
    * `mixed reduce(callable $callback, mixed $initial)` : Reduces the array to a single value using a callback function.
    * `void reverse()` : Reverses the array.
    * `void sortAsc()` : Sorts the array in ascending order.
    * `void sortDesc()` : Sorts the array in descending order.
    * `bool find(mixed $element)` : Finds an element in the array.
    * `array map(callable $callback)` : Applies a callback function to each element in the array.
    * `array unique()` : Removes duplicate values from the array.
    * `array keys()` : Returns the keys of the array.
    * `array values()` : Returns the values of the array.
    * `array slice(int $offset, int $length = null)` : Returns a slice of the array.
    * `array chunk(int $size)` : Splits the array into chunks.
    * `array combine(array $keys)` : Combines two arrays into an associative array.
    * `array diff(array $array)` : Returns the difference between two arrays.
    * `array intersect(array $array)` : Returns the intersection of two arrays.
    * `array flip()` : Flips the array keys and values.
    * `bool walkRecursive(callable $callback)` : Applies a callback function to each element in the array recursively.
    * `bool validateNotEmpty()` : Validates the array for empty elements.
    * `bool validateDataType(string $type)` : Validates the array for specific data types.
    * `bool validateUnique()` : Validates the array for unique elements.
    * `bool validateRange(float $min, float $max)` : Validates the array for elements within a specific range.
    * `bool validatePattern(string $pattern)` : Validates the array for elements matching a specific pattern.
    * `void cleanEmptyElements()` : Cleans the array by removing empty elements.
    * `void cleanInvalidDataTypes(string $type)` : Cleans the array by removing elements of invalid data types.
    * `void cleanSpecialCharacters(string $pattern = '/[^A-Za-z0-9]/')` : Cleans the array by removing special characters from elements.
    * `void cleanWhitespace()` : Cleans the array by trimming whitespace from elements.
    * `void cleanHTMLTags()` : Cleans the array by removing HTML tags from elements.
    * `void cleanValidURLs()` : Validates and cleans the array for valid URLs.

***

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