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
* controller entry points
* model creation, modification and delete call (all the calls that change the database). If possible log the modified data.

It is also recommended to store the user who did the action.