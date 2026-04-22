<?php

namespace App\Providers;

use App\Interfaces\AuthServiceInterface;
use App\Services\SocialAuth\GoogleAuthService;
use App\Services\SocialAuth\FacebookAuthService;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class , function($app){
           $provider = request()->route('provider') ; 
           switch($provider)
           {
                case 'google' : 
                    return new GoogleAuthService() ; 
                case 'facebook' : 
                    return new FacebookAuthService() ; 
                default : 
                    abort(404) ; 
           }
        }) ; 
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
