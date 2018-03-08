<?php
namespace App\Modules\Finance\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class FinanceServiceProvider extends ServiceProvider
{
	
	public function register()
	{
		
		
		
		App::register('App\Modules\Finance\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	
	protected function registerNamespaces()
	{
		Lang::addNamespace('finance', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('finance', base_path('resources/views/vendor/finance'));
		View::addNamespace('finance', realpath(__DIR__.'/../Resources/Views'));
	}
}
