<?php
namespace App\Modules\Bre\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class BreServiceProvider extends ServiceProvider
{
	
	public function register()
	{
		
		
		
		App::register('App\Modules\Bre\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	
	protected function registerNamespaces()
	{
		Lang::addNamespace('bre', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('bre', base_path('resources/views/vendor/bre'));
		View::addNamespace('bre', realpath(__DIR__.'/../Resources/Views'));
	}
}
