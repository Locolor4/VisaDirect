<?php

use App\Http\Controllers\VisaController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('createPullFunds', [VisaController::class, 'createPullFunds'])->name('createPullFunds');
Route::get('readPullFunds', [VisaController::class, 'readPullFunds'])->name('readPullFunds');
