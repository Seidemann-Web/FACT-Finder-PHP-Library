FACT-Finder-PHP-Library
=======================

This is a modified version of the original [FACT-Finder-PHP-Library](https://github.com/FACT-Finder/FACT-Finder-PHP-Library) for the oxid module swFactFinder.
It includes some modifications to allow its compatibility with OXID.

This is a complete rewrite of and replaces the old
[FACT Finder PHP Library](https://github.com/FACT-Finder/FACT-Finder-PHP-Framework).

For usage, see the [**demo**](https://github.com/FACT-Finder/FACT-Finder-PHP-Library-Demo).

For documentation please see [the library's GitHub wiki](https://github.com/FACT-Finder/FACT-Finder-PHP-Library/wiki) as well as [the demo's GitHub wiki](https://github.com/FACT-Finder/FACT-Finder-PHP-Library-Demo/wiki). There is also source documentation generated with [phpDocumentor](http://www.phpdoc.org/), which you can view if you clone the repository.

If you want to contribute to the library, please see our [guide for contributors](https://github.com/FACT-Finder/FACT-Finder-PHP-Library/wiki/Guide-for-contributors).


Motivation & Goals
------------------

- No longer support multiple FACT-Finder versions and interfaces at once, as
  legacy code and deep inheritance trees make the project increasingly hard to
  maintain.
- Use the recommended FACT-Finder interface (JSON) instead of providing every
  possibility.
- Make the API clearer and more easily accessible to give developers more
  control over the requests to FACT-Finder.

Documentation ToDos
-------------------

- PHPDoc of the code
- General documentation in GitHub wiki
  - How to use
