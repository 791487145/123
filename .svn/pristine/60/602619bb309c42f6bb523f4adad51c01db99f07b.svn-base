<?php

namespace App\Providers;

use App\Services\SmsService;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        
    }

    
    public function register()
    {
        $this->app->singleton('LeeSms', function(){
            return new SmsService();
        });

        $this->app->bind('App\Contracts\SmsContract', function (){
            return new SmsService();
        });
    }
}
