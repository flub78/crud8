# Database backup and restore

Even if it can be managed outside of the application, it can be convenient for admin users to be able trigger a backup and  to restore it from the application.

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
