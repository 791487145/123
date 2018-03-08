<?php
namespace App\Modules\Test\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
	
	public function register()
	{
		
		
		
		App::register('App\Modules\Test\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	
	protected function registerNamespaces()
	{
		Lang::addNamespace('test', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('test', base_path('resources/views/vendor/test'));
		View::addNamespace('test', realpath(__DIR__.'/../Resources/Views'));
	}
}
