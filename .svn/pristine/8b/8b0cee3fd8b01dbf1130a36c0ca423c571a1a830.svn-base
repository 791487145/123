<?php
namespace App\Modules\Manage\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class ManageServiceProvider extends ServiceProvider
{
	
	public function register()
	{
		
		
		
		App::register('App\Modules\Manage\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	
	protected function registerNamespaces()
	{
		Lang::addNamespace('manage', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('manage', base_path('resources/views/vendor/manage'));
		View::addNamespace('manage', realpath(__DIR__.'/../Resources/Views'));
	}
}
