<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Chats;
use App\Models\Messages;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;


class ChatsController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $data = [];
        // in the future this will be filtered based on available friends

        $users = Users::all();

        $data['your_id'] = Auth::id();

        foreach($users as $u){
            if($u->user_id != Auth::id()){
                $data['users'][] = $u;

            }
           
        }


        return view('pages.chats',$data);
    }

    public function makeChat(){
        // set up a chat between two people, will just show the same chat if already exists

        $post_data =  file_get_contents('php://input'); // this contains people in the chat, if these two already exist together , return that chat, if not make a new one and return that one
      
        // add a chat people to database
        // always sort the people in ascending order
        
        $people_array = get_object_vars(json_decode($post_data));

        sort($people_array);

       $chat =  Chats::updateOrCreate(
            ['chat_people'=>json_encode($people_array)]
           
        );


        $chat_id = $chat->chat_id;

        $messages = Messages::where('chat_id',$chat_id)->get();
        $messages_array = [];


        // get the chat name
        if (($key = array_search(Auth::id(), $people_array)) !== false) {
             unset($people_array[$key]);
        }


        $users_names = [];

        // names of everyone but the account user i the chat

        foreach($people_array as $p){
            $users_names[] = Users::find($p)->name;

        }


        //unset($people_array[0]);
       
        

        if(count($messages) !== 0){

            //return response(json_encode('Message'));

            foreach($messages as $m){
                $messages_array['messages'][] = [
                    'active'=>'true',
                    'message_id'=>$m->message_id,
                    'content' => $m->message_content,
                    'sender'=>$m->sender,
                    'receiver'=>$m->receiver,
                    'user_id'=>Auth::id(),
                    'sender_name'=>Users::find($m->sender)->name
                    
    
                ];
            }

            $messages_array['chat_names'] = $users_names;
            $messages_array['chat_id'] =  $chat_id;
            


        }else{

           // return response(json_encode('else'));
            $messages_array['messages'][] = [
                'active'=>'false'
                

            ];

            $messages_array['chat_names'] = $users_names;
            $messages_array['chat_id'] =  $chat_id;
        }

      
        $messages_array['user_id'] = Auth::id();


       // return response($messages_array);


       return response()->view('pages.chat_box',$messages_array);
             

    }


    public function send(){
        $user = Auth::user();



        $post_data =  file_get_contents('php://input'); // this contains people in the chat, if these two already exist together , return that chat, if not make a new one and return that one

        $decoded_data = get_object_vars(json_decode($post_data));

        $sender_id = Auth::id();

        // get the receriver id
        $chat_id =  $decoded_data['chat_id'];

        $chat_people = json_decode(Chats::find($chat_id)->chat_people);

        // remove the sender from the array
        if (($key = array_search($sender_id, $chat_people)) !== false) {
            unset($chat_people[$key]);
       }

      // receiver will go into positions 0
       $receiver_id = array_values($chat_people);




        // get the messsage content
        $message_content =  $decoded_data['message_content'];


        // add sender receiver and message content to messages 
      $last_message_id =   Messages::create(
            [
                'chat_id'=>$chat_id,
                'message_content'=>$message_content,
                'sender'=>$sender_id,
                'receiver'=>$receiver_id[0]
            ]
        )->message_id;

        // here can send the sent message back to the chat
      

        // return message back
        // $final_message =  [
        //     'active'=>'true',
        //     'message_id'=>$last_message_id,
        //     'content' => $message_content,
        //     'sender'=>$sender_id,
        //     'receiver'=>$receiver_id[0],
        //     'user_id'=>Auth::id(),
        //     'sender_name'=>Users::find($sender_id)->name
            

        // ];

        $final_message = Messages::find($last_message_id);

      
        // it wouldn;t broadcast it to me if it said toOthers()
        broadcast(new MessageSent($user,$final_message));

        return ['status' => 'Message Sent!'];

        


    }


    // public function newMessages(){

    //     $post_data =  file_get_contents('php://input'); // this contains people in the chat, if these two already exist together , return that chat, if not make a new one and return that one
      
        
        
    //     $decoded_array = get_object_vars(json_decode($post_data));
    //     $chat_id = $decoded_array['chat_id'];

    //     $message_id_array = $decoded_array['message_id_array'];

    //     // get latest messages from database
    //    $messages =  Messages::where('chat_id',$chat_id)->get();

    //    $db_id_array = [];

    //    foreach($messages as $m){
    //        $db_id_array[] = $m->message_id;
    //    }


    //    // there will be new ones in db array compared to message id array, and those are the ones i need to send back
    //    $new_messages_id_array =  array_diff($message_id_array,$db_id_array);

    //    // return alll message data if there is any
    //    $new_messages_array = [];

    //    if(count($new_messages_id_array) != 0){

    //     foreach($new_messages_id_array as $n){

    //         $this_user_message =  Messages::find($n);

    //         $new_messages_array['messages'][] = [
    //             'active'=>'true',
    //             'message_id'=>$this_user_message->message_id,
    //             'content' => $this_user_message->message_content,
    //             'sender'=>$this_user_message->sender,
    //             'receiver'=>$this_user_message->receiver,
    //             'user_id'=>Auth::id(),
    //             'sender_name'=>Users::find($this_user_message->sender)->name
                
    
    //         ];
    
    
    
    //        }
            
    //         return response($new_messages_array);

    //    }else{
    //        return response($new_messages_id_array);
    //    }

       

    // }


    // public function send(){
       
    //     // here can post a message to the database

    //     $post_data =  file_get_contents('php://input'); // this contains people in the chat, if these two already exist together , return that chat, if not make a new one and return that one

    //     $decoded_data = get_object_vars(json_decode($post_data));

    //     $sender_id = Auth::id();

    //     // get the receriver id
    //     $chat_id =  $decoded_data['chat_id'];

    //     $chat_people = json_decode(Chats::find($chat_id)->chat_people);

    //     // remove the sender from the array
    //     if (($key = array_search($sender_id, $chat_people)) !== false) {
    //         unset($chat_people[$key]);
    //    }

    //    // receiver will go into positions 0
    //    $receiver_id = array_values($chat_people);




    //     // get the messsage content
    //     $message_content =  $decoded_data['message_content'];


    //     // add sender receiver and message content to messages 
    //   $last_message_id =   Messages::create(
    //         [
    //             'chat_id'=>$chat_id,
    //             'message_content'=>$message_content,
    //             'sender'=>$sender_id,
    //             'receiver'=>$receiver_id[0]
    //         ]
    //     )->message_id;

    //     // here can send the sent message back to the chat
      

    //     // return message back
    //     $final_message =  [
    //         'active'=>'true',
    //         'message_id'=>$last_message_id,
    //         'content' => $message_content,
    //         'sender'=>$sender_id,
    //         'receiver'=>$receiver_id[0],
    //         'user_id'=>Auth::id(),
    //         'sender_name'=>Users::find($sender_id)->name
            

    //     ];

    //     return response($final_message);

    // }


    // public function getAllMessages(){
    //     // when a chat is selected, all the messages will be taken fromm here

    //     return response($content, $status);

    // }


    
}
