# Multi-tenancy

One of the biggest drawback of this project origin was the lack of multi tenancy.

Requiring a relatively complex installation for every tenant has deterred potential users.

In the context of this project, tenants data separation is important, as well as for each tenant the capacity to save and backup his own database. Backups and restore are used more than to preserve data integrity as a roll back mechanism when some undesired operations have been performed. In this case it is easier to roll back to a previous state and start to work again than to undo the individual changes.

The most logical architecture is to manage a simple database to handle the tenant information and one for each tenant to contain application data.

## To do

* Experiment on multi database connections (done)
* Experiment on database backup and restore
* Experiment on the database selection according to tenant sub domain (done)

## References

* [Tenancy for Laravel](https://tenancyforlaravel.com/)

* [Multi-tenancy package comparison](https://tenancyforlaravel.com/docs/v3/package-comparison/)