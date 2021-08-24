<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Chats;
use App\Models\Users;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.Users.{id}', function (Users $user, $id) {
    return (int) $user->user_id === (int) $id;
});


Broadcast::channel('chat.{chat_id}', function (Users $user, $chat_id) {

   // check that the user is part of the chat, as well as authorised
  $array_of_people = json_decode(Chats::find($chat_id)->chat_people);


    // want this to be only people in the chat and authorsided
    return in_array($user->user_id,$array_of_people);//Auth::check();
  });