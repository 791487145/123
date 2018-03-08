<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CommonHelperProvider extends ServiceProvider
{
    
    public function boot()
    {
        require app_path('Extensions/CommonHelper.php');
    }

    
    public function register()
    {
        
    }
}
