![Ascoos Cms](https://dl.ascoos.com/images/ascoos.png)

# ASCOOS Framework 25'

[![Website](https://img.shields.io/website?url=https%3A%2F%2Fwww.ascoos.com)](https://www.ascoos.com)
![GitHub top language](https://img.shields.io/github/languages/top/ascoos/afw)
![GitHub Downloads (all assets, all releases)](https://img.shields.io/github/downloads/ascoos/afw/total?color=%230E80C0) 
![GitHub Release](https://img.shields.io/github/v/release/ascoos/afw) 
![GitHub Release Date](https://img.shields.io/github/release-date/ascoos/afw?color=%230E80C0)
![GitHub repo size](https://img.shields.io/github/repo-size/ascoos/afw) 

## Description

This package is a very small part of the `Ascoos Cms` custom core for use with `PHP 8.2` or later.

`Ascoos Cms 25` consists of several core code blocks, one of which is the `Ascoos Framework 25`, as well as [phpBCL8](https://github.com/ascoos/phpbcl8).

In older versions, the `Ascoos Framework` was integrated into the `Ascoos Cms` core, but in the new version 25 it becomes independent and is now one of the many main components of the Cms core.

In the modern way of programming, the ability of a core code to be modular, gives it the ability to adapt to modern methods and requirements.
`Ascoos Cms` has had this to a large extent in its core since the first releases in the distant 2008. In 2010 it was almost a complete modular core code block.

Now, the new version 25 is now coming to create new data in its modular core.

Version 25 only works on `PHP 8.2 or later`, as the core has been redesigned from the ground up to support modern programming methods and features.

Part of the `Ascoos Framework`, it is provided as source code to make it easier for Web Developers to understand how to write the extensions they will create for `Ascoos Cms`.


### SOURCEFORGE
[![Download ascoos-framework](https://img.shields.io/sourceforge/dt/ascoos-fw.svg)](https://sourceforge.net/projects/ascoos-fw/files/latest/download)
[![Download ascoos-framework](https://img.shields.io/sourceforge/dm/ascoos-fw.svg)](https://sourceforge.net/projects/ascoos-fw/files/latest/download)
[![Download ascoos-framework](https://img.shields.io/sourceforge/dw/ascoos-fw.svg)](https://sourceforge.net/projects/ascoos-fw/files/latest/download)
[![Download ascoos-framework](https://img.shields.io/sourceforge/dd/ascoos-fw.svg)](https://sourceforge.net/projects/ascoos-fw/files/latest/download)

[![Download Ascoos Framework 24'](https://a.fsdn.com/con/app/sf-download-button)](https://sourceforge.net/projects/ascoos-fw/files/latest/download)



## Contributing

`Ascoos Cms`, of which this `Ascoos Framework` is a part, contains encrypted source code, but a small part of it is given as source code for educational purposes.

Contributions are welcome [github](https://github.com/ascoos/afw)


## Feedback

Please send any feedback or suggestions to [@ascoos](https://twitter.com/ascoos) (Twitter) or [create an issue](https://issues.ascoos.com) on Ascoos Official site.

## License

[![AGL-F](https://img.shields.io/badge/License-AGLF-blue.svg)](http://docs.ascoos.com/lics/ascoos/AGL-F.html)



## Download

[![OFFICIAL ASCOOS DOWNLOAD SITE](https://img.shields.io/website?url=https://dl.ascoos.com/pub/afw)](https://dl.ascoos.com/pub/afw/afw-latest.zip) 
[![Download Ascoos Framework 24 from GitHub](https://img.shields.io/badge/GitHub-afw-blue.svg)](https://github.com/ascoos/afw/releases) 
[![Download Ascoos Framework 24 from PHPClasses](https://img.shields.io/badge/php-classes-blue.svg)](https://www.phpclasses.org/package/13408.html) 



# Installation and use

1. Download latest release
1. Unzip package in your root working directory
1. Add in index.php or master php file the below code :

```php
$path = '[YOUR SITE PATH]';
include $path . '/afw/autoload.php';
```



## Ascoos Framework Namespace
```php
    namespace ASCOOS\FRAMEWORK;
```

use...

```php
    use ASCOOS\FRAMEWORK\Kernel\Core\TObject;
```

