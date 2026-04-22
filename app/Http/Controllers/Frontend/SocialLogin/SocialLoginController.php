<?php

namespace App\Http\Controllers\Frontend\SocialLogin;

use App\Http\Controllers\Controller;
use App\Interfaces\AuthServiceInterface;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialLoginController extends Controller
{
    protected $authService ; 
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService ; 
    }
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try{
            $user = Socialite::driver($provider)->user();
            $provider_user = $this->authService->findOrCreateUser($user) ; 
            if($provider_user){
                Auth::login($provider_user) ; 
                display_success_message('Login with '.$provider.' successfully!') ;
                return redirect()->route('frontend.dashboard.setting.index') ; 
            }else{
                display_error_message('This Email Is Already Taken!') ;
                return redirect()->route('login') ;
            }
        }catch(Exception $e){
            display_error_message('Error , OAuth Failed , Try Again!') ; 
            return redirect()->route('login') ; 
        }
    }
}
