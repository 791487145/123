<?php
namespace App\Modules\Advertisement\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class AdvertisementServiceProvider extends ServiceProvider
{
	
	public function register()
	{
		
		
		
		App::register('App\Modules\Advertisement\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	
	protected function registerNamespaces()
	{
		Lang::addNamespace('advertisement', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('advertisement', base_path('resources/views/vendor/advertisement'));
		View::addNamespace('advertisement', realpath(__DIR__.'/../Resources/Views'));
	}
}
