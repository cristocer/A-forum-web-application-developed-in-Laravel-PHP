<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use App\SocialData\FbSocialGateway;
use App\SocialData\GitSocialGateway;
use App\SocialData\SocialGatewayContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SocialGatewayContract::class,function($app){
            //Use the Facebook gateway.
            if(request()->provider=='facebook'){
                return new FbSocialGateway();
            }
            //Use the Github gateway.
            return new GitSocialGateway();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Illuminate\Support\Facades\URL::forceScheme('https');
    }
}
