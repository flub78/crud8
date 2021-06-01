<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Experiment on extracting tenant id
Route::domain('{tenant}.flub78.com')->group(function () {
    
    Route::get('/', function ($tenant) {
        echo "tenant = " . $tenant;
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::resource('games', 'GameController')->middleware('auth');
Route::resource('users', 'UserController')->middleware('auth');

// Backup controller is not a full resource
Route::get('/backup', [App\Http\Controllers\BackupController::class, 'index'])->name('backup.index')->middleware('auth');
Route::get('/backup/create', [App\Http\Controllers\BackupController::class, 'create'])->name('backup.create')->middleware('auth');
Route::get('/backup/{backup}/restore', [App\Http\Controllers\BackupController::class, 'restore'])->name('backup.restore')->middleware('auth');
Route::delete('/backup/{backup}', [App\Http\Controllers\BackupController::class, 'destroy'])->name('backup.destroy')->middleware('auth');


Auth::routes(['reset' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test', [App\Http\Controllers\TestController::class, 'index'])->name('test');


