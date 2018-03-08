<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Extensions\VilidateValidator as VilidateValidator;




class ExtensionValidatorServiceProvider extends ServiceProvider
{

    
    public function boot()
    {
        
        

        

        $this->app['validator']->resolver(function ($translator, $data, $rules, $messages) {
            return new VilidateValidator($translator, $data, $rules, $messages);
        });
    }

    
    public function register()
    {
        
    }
}
