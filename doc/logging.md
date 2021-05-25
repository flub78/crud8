# Logging

## Usage

Logging is done with the Log facade.

    use Illuminate\Support\Facades\Log;
    
and invoked by

    Log::debug('GameController.create');
    
by default logs are written in storage/logs/laravel.log


## Recommendations

It is recommended to log

* User login and logout
* model creation, modification and delete call (all the calls that change the database). If possible log the modified data.

It is also recommended to store the user who performed the action.

If all database changes are logged by the model, it is useless to clutter the log files with controller entries. 

## Logs files rotation

The log file rotation on a Linux server can be handled by the operating system. No needs
to implement anything at the application level.

    https://www.jesusamieiro.com/how-to-rotate-the-laravel-logs/