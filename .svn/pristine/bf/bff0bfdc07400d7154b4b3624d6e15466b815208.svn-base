<?php

namespace App\Modules\Employ\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class EmployServiceProvider extends ServiceProvider
{
	
	public function boot()
	{
		
		
		
		
	}

	
	public function register()
	{
		
		
		
		App::register('App\Modules\Employ\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	
	protected function registerNamespaces()
	{
		Lang::addNamespace('employ', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('employ', base_path('resources/views/vendor/employ'));
		View::addNamespace('employ', realpath(__DIR__.'/../Resources/Views'));
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
