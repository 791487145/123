<?php

namespace App\Modules\Install\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class InstallServiceProvider extends ServiceProvider
{
	
	public function boot()
	{
		
		
		
		
	}

	
	public function register()
	{
		
		
		
		App::register('App\Modules\Install\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	
	protected function registerNamespaces()
	{
		Lang::addNamespace('install', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('install', base_path('resources/views/vendor/install'));
		View::addNamespace('install', realpath(__DIR__.'/../Resources/Views'));
	}

}
