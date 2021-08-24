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

// feed and profile routes

Route::get('/feed', [App\Http\Controllers\Pages\FeedController::class, 'index']);

Route::post('/profile/post',[App\Http\Controllers\Pages\ProfileController::class,'post']);

Route::post('/feed/post',[App\Http\Controllers\Pages\FeedController::class,'post']);

Route::post('/profile/album_photos',[App\Http\Controllers\Pages\ProfileController::class,'photos']);

Route::get('/profile/post_delete',[App\Http\Controllers\Pages\ProfileController::class,'delete_posts']);


Route::get('/profile/photo_delete',[App\Http\Controllers\Pages\ProfileController::class,'delete_photos']);

Route::get('/feed/post_delete',[App\Http\Controllers\Pages\FeedController::class,'delete_posts']);

Route::get('/profile',[App\Http\Controllers\Pages\ProfileController::class,'index']);

Route::post('/profile/upload',[App\Http\Controllers\Pages\ProfileController::class,'upload']);


// message and chat routes
// have chat page, with hidden 'chat box', with profiles down the side, then click on person, set up chat, insert or update, then set up messages
Route::get('/chats',[App\Http\Controllers\Pages\ChatsController::class,'index']);


Route::post('/make_chat',[App\Http\Controllers\Pages\ChatsController::class,'makeChat']);


Route::post('/chat/send_message',[App\Http\Controllers\Pages\ChatsController::class,'send']);

//Route::post('/chat/new_messages',[App\Http\Controllers\Pages\ChatsController::class,'newMessages']);


// broadcasting events
// Route::get('/fire',function(){
//     event(new App\Events\TestEvent());
//     return 'ok';
// });


// page search

Route::get('/search',[App\Http\Controllers\Pages\SearchController::class,'index']);