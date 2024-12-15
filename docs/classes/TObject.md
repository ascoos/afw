# Class `TObject`

***The base class on which all classes in the framework are based.***

>### Extends `stdClass`
>### Implements `TCoreHandler` ***< Stringable >*** 

## Use:
```php
    use ASCOOS\FRAMEWORK\Kernel\Core\TObject;

    class TNameClass extends TObject {...}
```


## `Methods`
* `void __construct(array $properties=[])` : Initialize the class. It must be called by the offspring if the classes are initialized.
* `string __toString()` : Returns a string containing the name of this class.
* `bool Free(object $object)` : Frees the memory of the Object or its clone.
* `bool FreeProperties(object $object)` : Delete and Frees up memory for all class properties.
* `bool getClassDeprecated()` : Returns true if class is deprecated, otherwise false.
* `int getClassVersion()` : We get the version of the class.
* `mixed getDeepProperty(array $keys, ?array $array = null)` : Gets a property at any depth within the properties array.
* `array getProperties()` : Returns the table of class properties.
* `mixed getProperty(string $property)` : Returns the content of the requested property.
* `?array getPublicProperties()` : Returns an array of the public properties of the class.
* `int|false getVersion(string $property)` : Get the version as an integer.       
* `string|false getVersionStr(string $property)` : Get the version as a formatted string.
* `bool isExecutable(int $currentVersion, int $currentPHPVersion)` : Checks whether the current version of the class is executable according to the minimum and maximum versions you specify.
* `void setDeepProperty(array $keys, mixed $value, ?array &$array = null)` : Sets a property at any depth within the properties array.
* `void setProjectVersion(int|string $version = -1)` : Sets the project version.
* `bool setProperties(array $properties, string|int|null $property_key=null)` : Recursively sets properties of the class, merging sub-arrays without overwriting other data.
* `bool setProperty(string|int $property, mixed $value, string|int|null $property_key=null)` : Set a single property of the class.


***

<details>
<summary>🟠 INHERITANCES</summary>

>inherits only method __toString which it exceeds to return new data

</details>