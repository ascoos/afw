# Class `TError`

***Implements the error management class.***

>### Extends `Error`


## Use:
```php
use ASCOOS\FRAMEWORK\Kernel\Core\TError;

throw new TError("Message");

// OR

try {
    echo "Run Ascoos Framework";
} catch (TError $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
    $e->Free($e);
}


try {
    throw new TError("Some error message");
} catch(TError $e) {
    echo $e->getError(AFW_ERROR_ARGUMENT_INVALID_TYPE); // Νεά μέθοδος εμφάνισης λάθους. Περνάει όλα τα λάθη στον δημόσιο πίνακα $_ERRORS
} finally {
    if (is_object($e)) $e->Free($e);
}

```

## `Methods`
* `__construct(string $message = "", int $code = 0, ?Throwable $previous = null)` : Initialize the class.
* `string __toString()` : Returns a string containing the error.
* `bool Free(object $object)` : Frees the memory of the Object or its clone 
* `bool FreeProperties(object $object): bool` : Delete and Frees up memory for all class properties.

***

<details>
<summary>🟠 INHERITANCES </summary>

- `PROPERTIES`
    * protected   string $message = ""; 
    * protected   int $code;
    * protected   string $file = "";
    * protected   int $line;

- `METHODS`
    * final public getMessage(): string
    * final public getPrevious(): ?Throwable 
    * final public getCode(): int 
    * final public getFile(): string
    * final public getLine(): int
    * final public getTrace(): array
    * final public getTraceAsString(): string
   
</details>