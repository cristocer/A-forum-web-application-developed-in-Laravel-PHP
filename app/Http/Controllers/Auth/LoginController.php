<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Socialite;
use App\User;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout','userLogout');
    }
    public function userLogout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider)
    {
        $user=Socialite::driver($provider)->user();
        //dd($user);
        //$authUser=$this->findOrCreateUser($user,$provider);
        $authUser=User::whereEmail($user->getEmail())->first();
        if($authUser){
            auth()->login($authUser);
            return redirect($this->redirectTo);
        }
        $newUser=User::create([
            'name'=>$user->getName(),
            'email'=>$user->getEmail(),
            'password'=>bcrypt("sdasdasdasdas"),

        ]);
        //Auth::login($authUser,true);
        auth()->login($newUser);
        return redirect($this->redirectTo);
    }
    /*
    public function findOrCreateUser($user,$provider)
    {
        $authUser=User::where('provider_id',$user->id)->first();
        if($authUser){
            return $authUser;
        }
        return User::create([
            'name'=>$user->name,
            'email'=>$user->email,
            'provider'=>$provider,
            'provider_id'=>$user->id,

        ]);
    }*/

}
