<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

### DISABLED BECAUSE WE DO NOT WANT TO RUN FULL DB UPDATE UNLESS ABSOLUTELY NECESSARY.
### DAILY UPDATES ARE RUN DIRECTLY FROM SCHEDULED TASK / CRON.
//Route::get('/gmrs-weekly-dn', [\App\Http\Controllers\WeeklyGmrsController::class, 'dn']);
//Route::get('/gmrs-weekly-hd', [\App\Http\Controllers\WeeklyGmrsController::class, 'hd']);
//Route::get('/gmrs-weekly-en', [\App\Http\Controllers\WeeklyGmrsController::class, 'en']);
////
//Route::get('/gmrs-daily-hd', [\App\Http\Controllers\DailyGmrsController::class, 'hd']);
//Route::get('/gmrs-daily-en', [\App\Http\Controllers\DailyGmrsController::class, 'en']);
