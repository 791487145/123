<?php
namespace FrankRabbit\Authen;

use Illuminate\Support\ServiceProvider;

class CrtServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //$this->loadViewsFrom(__DIR__.'/views','Crt');

        $this->publishes([

            //__DIR__.'/views' => base_path('resources/views/vendor/crt'),
            //__DIR__.'/config/crt.php' => config_path('crt.php'),

        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['crt'] = $this->app->share(function ($app) {
            return new Crt();
        });
    }

    public function providers(){
        return ['crt'];
    }

}