<?php
namespace App\Modules\Im\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class ImServiceProvider extends ServiceProvider
{
	
	public function register()
	{
		
		
		
		App::register('App\Modules\Im\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	
	protected function registerNamespaces()
	{
		Lang::addNamespace('im', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('im', base_path('resources/views/vendor/im'));
		View::addNamespace('im', realpath(__DIR__.'/../Resources/Views'));
	}
}
