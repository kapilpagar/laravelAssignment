<?php

use App\Http\Controllers\AuthController;
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
Route::group(['middleware'=>'guest'],function(){
Route::get('login',[AuthController::class,"index"])->name('login');
Route::get('register',[AuthController::class,"register_view"])->name('register');

Route::post('login',[AuthController::class,"login"])->name('login');
Route::post('register',[AuthController::class,"register"])->name('register');

Route::post('/getState',[AuthController::class,"getState"]);
Route::post('/getCity',[AuthController::class,"getCity"]);

Route::get('/mailtest', function () {
    return view('mailtest');
});
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('home',[AuthController::class,"home"])->name('home');
    Route::get('logout',[AuthController::class,"logout"])->name('logout');

});

