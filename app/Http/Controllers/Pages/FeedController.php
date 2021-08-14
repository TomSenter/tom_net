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
        // $id = Auth::id();
        // var_dump($id);

        $user =  Auth::user();
        $name =  $user->name;

       return view('pages.feed',['name'=>$name]);
    }
}
