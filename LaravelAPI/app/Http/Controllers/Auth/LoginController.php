<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;

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

    /**
     * Logs in the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
       $input = $request->all();
       $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
       ]);
       $email = $request->input('email');
       $user= User::where('email',$email)->firstOrFail();
       //Token creation
       $token = $user->createToken('auth_token')->plainTextToken;
       //Returns different response based on type of user
       if (auth()->attempt(array('email'=>$input['email'],'password'=>$input['password'])))
       {
        if (auth()->user()->is_admin==1)
        {
            return response()->json(['user'=> auth()->user(),
                                    'token'=> $token,
                                    'tip'=> 'admin'], 200, [], JSON_PRETTY_PRINT);
        } else 
        {
            return response()->json(['user'=> auth()->user(),
                                    'token'=> $token,
                                    'tip'=> 'korisnik'], 200, [], JSON_PRETTY_PRINT);
        }
       } else 
       {
        $errorMessage ='Input proper email/password';
        return response()->json($errorMessage, 200, [], JSON_PRETTY_PRINT);
       }
    }

    /**
     * Logs out the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json(['Msg' => 'Odjavljeni ste'], 200, [], JSON_PRETTY_PRINT);
    }
}
