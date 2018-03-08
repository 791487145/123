<?php
namespace App\Modules\Order\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
	
	public function register()
	{
		
		
		
		App::register('App\Modules\Order\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	
	protected function registerNamespaces()
	{
		Lang::addNamespace('order', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('order', base_path('resources/views/vendor/order'));
		View::addNamespace('order', realpath(__DIR__.'/../Resources/Views'));
	}
}
