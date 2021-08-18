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
    return view('auth.login');
});

Auth::routes();

// can name the route for named routes

Route::get('/feed', [App\Http\Controllers\Pages\FeedController::class, 'index']);

Route::get('/profile',[App\Http\Controllers\Pages\ProfileController::class,'index']);

Route::post('/profile/upload',[App\Http\Controllers\Pages\ProfileController::class,'upload']);