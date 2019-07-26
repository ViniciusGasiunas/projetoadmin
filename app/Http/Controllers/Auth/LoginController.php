<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
        $this->middleware('guest')->except('logout');
    }
    /////////////
     public function redirectToProvider($provider) //direciona o clique do botão "facebook(nesse caso)" para uma url
    {
        return Socialite::driver($provider)->redirect(); 
    }
    ////////////
    public function handleProviderCallback($provider)  //dps de ter conectado com a API e ter a confirmação do user, essas informações serão enviadas a mim
    {   
        
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }
    /////////////////
    public function findOrCreateUser($user, $provider)
    {
        //dd($user);  
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }

        $authUser = User::where('email', $user->email)->first();
        if ($authUser) {
            return $authUser;
        }

        $authUser = new User;

        $authUser->name = $user->name;
        $authUser->email = $user->email;
        $authUser->provider = $provider;
        $authUser->provider_id = $user->id;
        $authUser->img = $user->avatar;
        $authUser->nivel_user= 1;
        $authUser->save();
        return $authUser;
    }
       
    
}
