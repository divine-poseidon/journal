<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
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

Route::group(['before' => 'auth'], function() {
    /*TODO: access to table only for admins*/
    Route::get('/presence-table', [Controller::class, 'show'])->name('presenceTable');
    Route::get('/presence-form', [Controller::class, 'form'])->name('presenceForm');
    Route::post('/fill-presence', [Controller::class, 'processForm'])->name('processForm');
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

Auth::routes();
