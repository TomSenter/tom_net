<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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



        $data = ['name'=>$name,'email'=>$email];
       return view('pages.feed',$data);
    }
}
