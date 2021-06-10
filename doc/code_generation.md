# Code generation

Former projects who have inspired this one were already data driven. They were using the database schema, completed with some additional meta data to define how to display, input or validate object attributes or database columns.

By generating the code based on metadata the code has to be written once for every data type. It saves a lot of time if your application handle a lot of data of the same type.


## Principles

The idea is to analyze the database schema to determine how to handle data types. For example if a table has a column with a date, it defines how to display or input the data.

The database schema is not sufficient to determine how to handle all type of data. For example a string can handle a name, the hash for a password, or an email address. So the information fetched from the database schema must be completed by some additional metadata description.

The existing code generator, uses the mustache logic-less template engine.

[mustache](https://mustache.github.io/)

It was using pystache, but I should likely upgrade to [chevron](https://github.com/noahmorrison/chevron).

Second principle, completing the first one. You usually can find a lot of scaffolding methods for CRUD. If you manage a single table, it is possible to find a way to automatically generates the code. It is another mater when managing jointures and complex select, where you usually end up writing everything manually.

So the second fundamental principle of this design is to save all the complex views and select result in the database itself and generating the code the same way by analyzing the metadata in the database.

The objective of this approach is that, once you have carefully designed the database schema, it becomes extremely fast to generate a WEB application to handle it or to serve it through REST APIs.

## Previous implementation

When I started two years ago on Laravel 5.x the code generator written in python was already working fine.



It had however a few limitations:

* It was written in python, which implies to handle two programming languages in the same project. (It is not so important). 

* It was not embedded in a artisan command, which would make it more Laravelish.

* It was handling the additional metadata inside python scripts. For homogeneity, it would be more elegant to handle the metadata as a table inside the database itself.

* Templates were stored on a flat directory structure and the place to generate the results were hard coded in the scripts. It make them not suitable for Laravel 8 without modifications. It is more flexible to manage the template into a directory hierarchy and to mimic this hierarchy in the result output or installation directories.

In order to save time, I'll start by adapting the existing code generator. Then I'll improve it, before maybe to rewrite it in php.

## Installation

Install python modules

    pip install pystache
    pip install mysqlclient

## Execution

    python mustache.py --help
    
 