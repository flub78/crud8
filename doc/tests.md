# laravel application testing

Tests need to be develop at the same pace than the code. It is usualy a huge effort to try to catch up and most teams are never able to catch up.

## Type of test

### unit tests
  * they check the class public method both for nominal inputs and erroneous input
  * We use them for models and controllers
  * coverage is measured in covered line of code
  * white box testing
  * they refresh the database before execution
  
### Feature tests
  * they check the capacity of several classes to implement a feature
  * grey box testing
  * They may start execution with the restoration of a test database
  
### End to End tests
  * mostly black box testing
  * For WEB application us a controlled WEB browser
  * May require the control of all of the system interfaces
  
### Performance tests

### Endurance tests

### Deployment tests

# Test Coverage

It is possible to measure test coverage while running phpunit tests. See coverage.bat

## Initial coverage measure of the project
![First coverage measure of the project](images/initial_coverage.png) 

## Initial coverage dashboard
![alt text](images/coverage_dashboard.png) 

## Current status

[Project test coverage](coverage/index.html)
## How to test a model

Create a factory

    php artisan make:factory GameFactory
    
Complete it
    
    https://github.com/fzaninotto/Faker#basic-usage