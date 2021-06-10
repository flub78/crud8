# Calendar

(still a project)

A calendar is a basic feature for a lot of Web application. This porject will provide the basic features.

* Calendar views per month/week/day
* events CRUD callable from the calendar view.

It will also provide a framework for extensions with the possibility to add new types of events and to add business logic.
For example it will be possible to create a reservation system with several type of resources (for example a classsroom, a teacher and a limited number of student, etc.).

## Database ERD

    Event
        title           String
        description     String - Multiline
        all_deay_event  Boolean
        start_date      date
        start_time      time
        end_date        date
        end_time        time
        color           string
        
    Repetition
        event
        every day|week|month|year
        repeat_on Monday|Tuesday|Wednesday|Thursday|Friday|Saturday|Sunday
        End_Type    never|at_date|after_number
        end_date
        number_of
        
    Notification
        event
        type    application|email|SMS
        number
        unit    minute|hours|days|weeks
        
    

# Maybe later

* connection with Google Calendar
