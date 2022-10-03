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

Route::get('/', function () {
    return view('home');
});

Route::get('login', [\App\Http\Controllers\Auth\LoginController::class,'login']);
Route::post('login', [\App\Http\Controllers\Auth\LoginController::class,'store'])->name('login');
Route::get('logout', [\App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');
Route::middleware('auth')->group(function (){
    Route::get('home', [\App\Http\Controllers\HomeController::class,'index'])->name('home');
    Route::resource('clinics',\App\Http\Controllers\ClinicController::class);
    Route::resource('users',\App\Http\Controllers\UserController::class);
});
