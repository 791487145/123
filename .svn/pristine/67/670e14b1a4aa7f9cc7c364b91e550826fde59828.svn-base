<?php
namespace App\Modules\Article\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class ArticleServiceProvider extends ServiceProvider
{
	
	public function register()
	{
		
		
		
		App::register('App\Modules\Article\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	
	protected function registerNamespaces()
	{
		Lang::addNamespace('article', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('article', base_path('resources/views/vendor/article'));
		View::addNamespace('article', realpath(__DIR__.'/../Resources/Views'));
	}
}
