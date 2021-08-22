<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Posts;
use App\Models\Users;


class FeedController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){      
        // can add to the data array and pass it to the view
        // $id = Auth::id();
        // var_dump($id);

        $user =  Auth::user();
        $name =  $user->name;
        $email = $user->email;


          
        $id = Auth::id();

      //  var_dump(Posts::where('user_id',$id)->get());
      $posts_array =[];

        foreach(Posts::orderByRaw('updated_at DESC')->get() as $c){
            $poster = Users::find($c->user_id)->name ;
           $posts_array[] = [
               'post'=>$c,
               'poster'=>$poster
            
            ];
        }


        


        





        $data = ['name'=>$name,'email'=>$email,'posts'=>$posts_array,'id'=>$id];
       return view('pages.feed',$data);
    }


    public function post(Request $request){


        // put the post into the database of posts


        $user_id =  Auth::id();
        $content =  $request->input('post_content');

        Posts::create(
            [
                'user_id'=>$user_id,
                'post_content'=>$content,
            ]
        );





        //event(new MyEvent('hello world'));
      // var_dump($request->input('post_content'));

      return redirect('/feed');
    

    }


    public function delete_posts(){

        // var_dump($_GET['post_id']);
 
         // delete and redirect
 
         $id = $_GET['post_id'];
 
         $post = Posts::find( $id );
 
         $post->delete();
 
 
 
         return redirect('feed');
 
     }


}
