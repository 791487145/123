<?php

namespace App\Modules\Wechat\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class WechatServiceProvider extends ServiceProvider
{
	
	public function boot()
	{
		
		
		
		
	}

	
	public function register()
	{
		
		
		
		App::register('App\Modules\Wechat\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	
	protected function registerNamespaces()
	{
		Lang::addNamespace('wechat', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('wechat', base_path('resources/views/vendor/wechat'));
		View::addNamespace('wechat', realpath(__DIR__.'/../Resources/Views'));
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
