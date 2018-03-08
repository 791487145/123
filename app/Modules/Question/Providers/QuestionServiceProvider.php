<?php

namespace App\Modules\Question\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class QuestionServiceProvider extends ServiceProvider
{
	
	public function boot()
	{
		
		
		
		
	}

	
	public function register()
	{
		
		
		
		App::register('App\Modules\Question\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	
	protected function registerNamespaces()
	{
		Lang::addNamespace('question', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('question', base_path('resources/views/vendor/question'));
		View::addNamespace('question', realpath(__DIR__.'/../Resources/Views'));
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
