<?php
namespace App\Modules\Api\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
	
	public function register()
	{
		
		
		
		App::register('App\Modules\Api\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	
	protected function registerNamespaces()
	{
		Lang::addNamespace('api', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('api', base_path('resources/views/vendor/api'));
		View::addNamespace('api', realpath(__DIR__.'/../Resources/Views'));
	}
}
