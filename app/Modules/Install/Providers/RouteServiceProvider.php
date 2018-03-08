<?php

namespace App\Modules\Install\Providers;

use Caffeinated\Modules\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
	
	protected $namespace = 'App\Modules\Install\Http\Controllers';

	
	public function boot(Router $router)
	{
		parent::boot($router);

		
	}

	
	public function map(Router $router)
	{
		$router->group([
			'namespace'  => $this->namespace,
		], function($router) {
			require (config('modules.path').'/Install/Http/routes.php');
		});
	}
}
