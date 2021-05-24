# laravel application testing

Tests need to be develop at the same pace than the code. It is usualy a huge effort to try to catch up and most teams are never able to catch up.

## Type of test

* unit tests
  * they check the class public method both for nominal inputs and erroneous input
  * We use them for models and controllers
  * coverage is measured in covered line of code
  * white box testing
  
* Feature tests
  * they check the capacity of several classes to implement a feature
  * grey box testing
  
* End to End tests
  * mostly black box testing
  * For WEB application us a controlled WEB browser
  * May require the control of all of the system interfaces


## Current features

* A CRUD to manage games
* some authentication mechanism

Unit tests check all the public class method

Games CRUD required tests
    * model test
        * create test case
        * read test case
        * update test case
        * delete test case
    * controller test case
    * WEB browser test cases
    

## Testing model

Create a factory

    php artisan make:factory GameFactory
    
Complete it
    
    https://github.com/fzaninotto/Faker#basic-usage