<?php
namespace App\Modules\Pay\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class PayServiceProvider extends ServiceProvider
{
	
	public function register()
	{
		
		
		
		App::register('App\Modules\Pay\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	
	protected function registerNamespaces()
	{
		Lang::addNamespace('pay', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('pay', base_path('resources/views/vendor/pay'));
		View::addNamespace('pay', realpath(__DIR__.'/../Resources/Views'));
	}
}
