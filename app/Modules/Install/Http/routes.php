<?php




Route::group(['prefix' => 'install'], function() {
	Route::get('/', 'IndexController@run');
	Route::post('/checkDatabase', 'IndexController@checkDatabase');
});
