<?php
namespace App\Modules\Mobile\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class MobileServiceProvider extends ServiceProvider
{
	
	public function register()
	{
		
		
		
		App::register('App\Modules\Mobile\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	
	protected function registerNamespaces()
	{
		Lang::addNamespace('mobile', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('mobile', base_path('resources/views/vendor/mobile'));
		View::addNamespace('mobile', realpath(__DIR__.'/../Resources/Views'));
	}
}
