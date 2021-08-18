<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;



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

        $data = [
            'name'=> $name,
            'email'=>$email,
            'username'=>$username,
            'profile_pic'=>'/storage/profile_images/'.$profile_pic
        ];


        return view('pages.profile',$data);
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


             



        }else{
            echo 'No image received';
        }

        
        //var_dump($_POST);


       return redirect('/profile');

    }
}
