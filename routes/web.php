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

Auth::routes(['reset' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test', [App\Http\Controllers\TestController::class, 'index'])->name('test');


