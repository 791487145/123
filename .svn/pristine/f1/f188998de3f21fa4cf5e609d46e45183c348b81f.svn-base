<?php
namespace App\Modules\Task\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
{
	
	public function register()
	{
		
		
		
		App::register('App\Modules\Task\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	
	protected function registerNamespaces()
	{
		Lang::addNamespace('task', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('task', base_path('resources/views/vendor/task'));
		View::addNamespace('task', realpath(__DIR__.'/../Resources/Views'));
	}
}
