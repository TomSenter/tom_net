<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
 use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   protected $redirectTo = RouteServiceProvider::HOME;

   
 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


//     public function authenticated($request,$user)
//    {
//        return redirect('/feed/' . $user->id);
//    }


    
    // protected function redirectTo($request) {
    //     $id = Auth::id(); 
    //     // return '/feed/'.$id;
    
    //     return  route('/');
    // }


// // check if authenticated, then redirect to dashboard
//   protected function authenticated() {
// 	if (Auth::check()) {
// 		return redirect()->route('home');
// 	}
//  }
}
