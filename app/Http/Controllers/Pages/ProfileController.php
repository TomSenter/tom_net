<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\Posts;
use App\Models\Photos;



class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

        $user =  Auth::user();

        $name = $user->name;
        $username = $user->username;
        $email = $user->email;
        $profile_pic = $user->profile_picture;


        // get posts and add to data

        
        $id = Auth::id();

      //  var_dump(Posts::where('user_id',$id)->get());
      $posts_array =[];

        foreach(Posts::where('user_id',$id)->orderByRaw('updated_at DESC')->get() as $c){
           $posts_array[] = $c;
        }

        //var_dump($posts_array);exit;


        // get photos for album
        $albums_array = [];
       // var_dump(Photos::where('user_id',$id)->orderByRaw('created_at DESC')->get());
        foreach(Photos::where('user_id',$id)->orderByRaw('created_at DESC')->get() as $p){
           $albums_array[] = [
               'photo'=>'/storage/user'.$id.'_album_images/'.$p->photo,
               'id'=>$p->photo_id
           ];
        }

        

        // end of get photos for album

        $data = [
            'name'=> $name,
            'email'=>$email,
            'username'=>$username,
            'profile_pic'=>'/storage/profile_images/'.$profile_pic,
            'posts'=>$posts_array,
            'album_photos'=>$albums_array
        ];


        return view('pages.profile',$data);
    }


    public function delete_photos(){

      $id =  $_GET['photo_id'];

        $photos = Photos::find( $id );

        $photos->delete();



        return redirect('profile');

    }

    public function delete_posts(){

       // var_dump($_GET['post_id']);

        // delete and redirect

        $id = $_GET['post_id'];

        $post = Posts::find( $id );

        $post->delete();



        return redirect('profile');

    }


    public function upload(Request $request){

        

        if ($request->hasFile('profile_img')) {

            //echo 'yes';

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            $fileNameWithExt = $request->file('profile_img')->getClientOriginalName();

            // get filename
            $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME); 

            // get extension
            $extension = $request->file('profile_img')->getClientOriginalExtension();

            // make uniique filename
            $file_name_to_store = $filename.'_'.time().'.'.$extension;

            // upload image
            $path = $request->file('profile_img')->storeAs('public/profile_images',$file_name_to_store);


            // save to database 

            $users = Users::find(Auth::id());

            $users->profile_picture = $file_name_to_store;

            $users->save();


             


            return redirect('/profile');

        }else{
            echo 'No image received';
        }

        
        //var_dump($_POST);


      

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





      // var_dump($request->input('post_content'));

      return redirect('/profile');
    

    }


    


    public function photos(Request $request){

        $user_id = Auth::id();
        // upload any photo to the album here

        if ($request->hasFile('album_img')) {

            //echo 'yes';

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            $fileNameWithExt = $request->file('album_img')->getClientOriginalName();

            // get filename
            $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME); 

            // get extension
            $extension = $request->file('album_img')->getClientOriginalExtension();

            // make uniique filename
            $file_name_to_store = $filename.'_'.time().'.'.$extension;

            // upload image
            $path = $request->file('album_img')->storeAs('public/user'.$user_id.'_album_images',$file_name_to_store);


            // save to database  user posts database 


            // $users = Users::find($id);

            // $users->profile_picture = $file_name_to_store;

            // $users->save();

            
                Photos::create(
                    [
                        'user_id'=>$user_id,
                        'photo'=>$file_name_to_store,
                        'position'=>'profile_album'
                    ]
        );


             


            return redirect('/profile');

        }else{
            echo 'No image received';
        }

        



    }

    // public function getPosts(){
    //     // get the posts for that user id

    //     $id = Auth::id();

    //   //  var_dump(Posts::where('user_id',$id)->get());

    //     foreach(Posts::where('user_id',$id)->get() as $c){
    //         var_dump($c->post_content);
    //     }
    // }


}


