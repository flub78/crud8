# Database backup and restore

Even if it can be managed outside of the application, it can be convenient for admin users to trigger and restore backup from the application.

https://www.codecheef.org/article/laravel-7-daily-monthly-weekly-automatic-database-backup-tutorial

## Use cases
* Immediate backup of the current state (download the backup)
* Automatic backup (periodic)
* Download of a previous automated backup
* Backup restore

--------------------------------------------------------------------------------
## Use case Name : Immediate Backup
## Actors : admin
## Description

As an admin I want to perform a backup so that I can restore the current state
 
## Pre-Conditions

Logged as admin.

## Post-Conditions

A backup is stored on the werver and can be downloaded.

## Main Scenario
* Trigger the backup
* Wait until completion

--------------------------------------------------------------------------------
# Implementation

## Creating artisan commands

    php artisan make:command BackupCreate
    php artisan make:command BackupDelete

## Usage

    php artisan backup:create
    php artisan backup:list
    php artisan backup:delete 2
    php artisan backup:delete backup-2021-05-26_075112.gz
    php artisan backup:restore 3
    php artisan backup:restore backup-2021-05-26_075112.gz

## The backup controller

* backup.index          list locally stored backups
* backup.create         create a new backup by calling the artisan command
* backup.destroy (n)    delete a local backup
* backup.restore (n)    restore a local backup

## S3 storage

not implemented yet but it could be interresting to support AWS S3 cloud storage (or others)

options to specify the storage:
* -local (default)
* -s3, AWS S3 storage

    php artisan backup:create -s3
    php artisan backup:list -local
    php artisan backup:delete 2 -s3
    php artisan backup:delete -s3 backup-2021-05-26_075112.gz
    php artisan backup:restore -local 3
    php artisan backup:restore -s3 backup-2021-05-26_075112.gz
    
    php artisan backup:copy local:backup-2021-05-26_075112.gz s3:
    php artisan backup:copy local:backup-2021-05-26_075112.gz s3:
    php artisan backup:copy backup-2021-05-26_075112.gz backup_tp_keep.gz
    
## Restore backups

### Unzip

gzip is used to compress and uncompress backups. It must be available
in the path.
    
# Testing

As the controller reuse the artisan command implementation the test can be done at the controller level

Test cases:

Nominal:
* get a signature/hash of the database
* backup current database state (check that a new backup is created)
* change the database
* restore the previous state
* check that the database is back in its initial state
* delete the backup
* check that there is one less backup in the local storage

Error test case:
* delete a non existing backup
* restore a non existing backup

* attempt to create, restore or delete a backup as non admin

