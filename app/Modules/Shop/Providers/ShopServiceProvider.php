<?php

namespace App\Modules\Shop\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class ShopServiceProvider extends ServiceProvider
{
	
	public function boot()
	{
		
		
		
		
	}

	
	public function register()
	{
		
		
		
		App::register('App\Modules\Shop\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	
	protected function registerNamespaces()
	{
		Lang::addNamespace('shop', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('shop', base_path('resources/views/vendor/shop'));
		View::addNamespace('shop', realpath(__DIR__.'/../Resources/Views'));
	}

	
	protected function addMiddleware($middleware)
	{
		$kernel = $this->app['Illuminate\Contracts\Http\Kernel'];

		if (is_array($middleware)) {
			foreach ($middleware as $ware) {
				$kernel->pushMiddleware($ware);
			}
		} else {
			$kernel->pushMiddleware($middleware);
		}
	}
}
