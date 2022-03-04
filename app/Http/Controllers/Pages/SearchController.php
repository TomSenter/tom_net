<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;

class SearchController extends Controller
{
    //

    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request){

        $results = null;


        if($query = $request->get('query')){
            

           $results =  Users::search($query)->get();

           
        }

        $image_path = '/storage/profile_images/';



        return view('pages.search',[
            'results'=>$results,
            'image_path'=>$image_path
        ]);
    }
}
