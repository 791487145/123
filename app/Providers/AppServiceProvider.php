<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Extensions\ExtendBlade;

class AppServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        ExtendBlade::register();
    }

    
    public function register()
    {
        
    }
}
