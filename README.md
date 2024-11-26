<p align="center"><img src="https://dl.ascoos.com/images/ascoos.png" /></p>

# ASCOOS Framework

![GitHub Downloads (all assets, all releases)](https://img.shields.io/github/downloads/ascoos/afw/total?color=%230E80C0) 
![GitHub Release](https://img.shields.io/github/v/release/ascoos/afw) 
![GitHub Release Date](https://img.shields.io/github/release-date/ascoos/afw?color=%230E80C0)
![GitHub repo size](https://img.shields.io/github/repo-size/ascoos/afw) 
[![Ascoos Framework 24 - total lines](https://tokei.rs/b1/github/ascoos/afw?category=lines)](https://github.com/ascoos/afw)
[![Ascoos Framework 24 - source code lines](https://tokei.rs/b1/github/ascoos/afw?category=code)](https://github.com/ascoos/afw) 
[![Ascoos Framework 24 - files in repository](https://tokei.rs/b1/github/ascoos/afw?category=files)](https://github.com/ascoos/afw)



## Description

This package is a very small part of the `Ascoos Cms` custom core for use with `PHP 8.2` or later.

`Ascoos Cms 24` consists of several core code blocks, one of which is the `Ascoos Framework 24`, as well as [phpBCL](https://github.com/ascoos/phpBCL).

In older versions, the `Ascoos Framework` was integrated into the `Ascoos Cms` core, but in the new version 24 it becomes independent and is now one of the many main components of the Cms core.

In the modern way of programming, the ability of a core code to be modular, gives it the ability to adapt to modern methods and requirements.
`Ascoos Cms` has had this to a large extent in its core since the first releases in the distant 2008. In 2010 it was almost a complete modular core code block.
Now, the new version 24 is now coming to create new data in its modular core.

Version 24 only works on `PHP 8.2 or later`, as the core has been redesigned from the ground up to support modern programming methods and features.

Part of the `Ascoos Framework`, it is provided as source code to make it easier for Web Developers to understand how to write the extensions they will create for `Ascoos Cms`.

***

### SOURCEFORGE
[![Download ascoos-framework](https://img.shields.io/sourceforge/dt/ascoos-fw.svg)](https://sourceforge.net/projects/ascoos-fw/files/latest/download)
[![Download ascoos-framework](https://img.shields.io/sourceforge/dm/ascoos-fw.svg)](https://sourceforge.net/projects/ascoos-fw/files/latest/download)
[![Download ascoos-framework](https://img.shields.io/sourceforge/dw/ascoos-fw.svg)](https://sourceforge.net/projects/ascoos-fw/files/latest/download)
[![Download ascoos-framework](https://img.shields.io/sourceforge/dd/ascoos-fw.svg)](https://sourceforge.net/projects/ascoos-fw/files/latest/download)

***

## Awards

No Exists now

***

## Contributing

`Ascoos Cms`, of which this `Ascoos Framework` is a part, contains encrypted source code, but a small part of it is given as source code for educational purposes.

Contributions are welcome [github](https://github.com/ascoos/afw)


## Feedback

Please send any feedback or suggestions to [@ascoos](https://twitter.com/ascoos) (Twitter) or [create an issue](https://issues.ascoos.com) on Ascoos Official site.

## License

[![AGL-F](https://img.shields.io/badge/License-AGLF-blue.svg)](http://docs.ascoos.com/lics/ascoos/AGL-F.html)

***

## Download

[![OFFICIAL ASCOOS DOWNLOAD SITE](https://img.shields.io/website?url=https://dl.ascoos.com/pub/afw)](https://dl.ascoos.com/pub/afw/afw-latest.zip) 
[![Download Ascoos Framework 24 from GitHub](https://img.shields.io/badge/GitHub-afw-blue.svg)](https://github.com/ascoos/afw/releases) 
[![Download Ascoos Framework 24 from PHPClasses](https://img.shields.io/badge/php-classes-blue.svg)](https://www.phpclasses.org/package/12926.html) 
[![Download Ascoos Framework 24 from Sourceforge](https://img.shields.io/badge/SourceForge-ascoos-fw-blue.svg)](https://sourceforge.net/projects/ascoos-fw/files/latest/download)


***

<br>

# Installation and use

1. Download latest release
1. Unzip package in your root working directory
1. Add in index.php or master php file the below code :

```php
$path = '[YOUR SITE PATH]';
include $path . '/afw/autoload.php';
```

<br>

***

<br>

## Ascoos Framework Namespace
```php
    namespace ASCOOS\FRAMEWORK;
```

use...

```php
    use ASCOOS\FRAMEWORK\Kernel\Core\TObject;
```

***

<br>

## Core File : `coreKernel.php`

The file contains the basic parent classes of the `Ascoos Framework`.


### Namespace

```php
namespace ASCOOS\FRAMEWORK\Kernel\Core;
```

| Ascoos<br>Version |   TYPE    |          NAME           |                DESCRIPTION
|--------|-----------|-------------------------|-----------------------------------------
| 24.0.0 | Class     | `TError`                | Implements the error management class.
| 24.0.0 | Interface | `TCoreHandler`          | Stringable Interface Class
| 24.0.0 | Class     | `TObject`               | The base class on which all classes in the framework are based.

***

<br>

## Disks Handler File : `coreDisks.php`

It contains the implementation of support and management of disks, files, and folders.

### Namespace

```php
namespace ASCOOS\FRAMEWORK\Kernel\Disks;
```

use...

```php
use ASCOOS\FRAMEWORK\Kernel\Disks\TDriveInfo;
```

| Ascoos<br>Version | TYPE | NAME | DESCRIPTION
|-|-|--|-
| 24.0.0 | Class | `TDriveInfo` | Information about Drives, such as size, usable and free space, etc.


***

<br>

## Functions File : `coreFunctions.php`

This file implements several global functions that are either used by other framework code or created for user use.


| Ascoos<br>Version | TYPE | NAME | DESCRIPTION
|-|-|--|-
| 24.0.0 | Function | `formatBytes` | Returns the size of bytes in a formatted string e.g. 20.4 KB, 230.2 MB, 20.5 GB, etc.
| 24.0.0 | Function | `vn` | Returns the name of a variable as a string. Otherwise it returns false

***

<br>

