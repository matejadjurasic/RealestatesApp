<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function resetPassword(Request $request){
        
        $request->validate([
            'email' => 'required',
            'password_new'=> 'required|string'
        ]);

        $user = User::where('email',$request->email)->first();

        if($user){
            $user->password = Hash::make($request->password_new);
            $user->save();

            return response()->json(['Msg' => 'Lozinka uspesno resetovana'], 200, [], JSON_PRETTY_PRINT);
        }
        return response()->json(['Msg' => 'Korisnik ne postoji'], 200, [], JSON_PRETTY_PRINT);
    }
}
