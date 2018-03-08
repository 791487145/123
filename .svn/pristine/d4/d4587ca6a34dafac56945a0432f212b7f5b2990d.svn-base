<?php




Route::group(['prefix' => 'employ','middleware' => 'auth'], function() {
	Route::get('/','IndexController@index');
	Route::get('/create/{id}/{service?}','IndexController@employCreate');
	Route::post('/update','IndexController@employUpdate');
	Route::get('/bounty/{id}','IndexController@employBounty')->name('bounty');
	Route::post('/bounty','IndexController@employBountyUpdate')->name('bounty_update');
	Route::get('/result','IndexController@result')->name('resultCreate');

	Route::get('/workin/{id}','IndexController@workin')->name('workin');
	Route::get('/success','IndexController@success')->name('success');
	Route::get('/except/{id}/{type}','IndexController@except')->name('except');
	Route::post('/validBounty','IndexController@validBounty');
	Route::post('/workCreate','IndexController@workCreate');
	Route::get('/acceptWork/{id}','IndexController@acceptWork');
	Route::post('/employRights','IndexController@employRights');
	Route::post('/employEvaluate','IndexController@employEvaluate');
	Route::get('/employCheck/{id}','IndexController@employCheck');
});
