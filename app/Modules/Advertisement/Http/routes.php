<?php




Route::group(['prefix' => 'advertisement'], function() {
	Route::get('/', function() {
		dd('This is the Advertisement module index page.');
	});
});




Route::group(['prefix' => 'advertisement', 'middleware' =>[ 'manageauth', 'RolePermission']], function () {
	
	Route::get('/adTarget','AdTargetController@index')->name('adTargetList');
	Route::get('/adList/{id}','AdTargetController@adListById')->name('adTargetDetail');
	
	Route::get('/adList','AdController@adlist')->name('adList');
	Route::get('/insert','AdController@getInsertAd')->name('adCreatePage');
	Route::post('/adInfo','AdController@storeAdInfo')->name('adCreate');
	Route::get('/update/{id}','AdController@getUpdateAd')->name('adUpdatePage');
	Route::post('/updateInfo/{id}','AdController@updateAdInfo')->name('adUpdate');
	Route::get('/deleteInfo/{id}','AdController@deleteAdInfo')->name('adDelete');

	
	Route::get('/recommendList','RecommendController@recommendList')->name('recommendList');
	Route::get('/nameUpdate','RecommendController@nameUpdate')->name('recommendUpdate');
	Route::get('/serverListByID/{id}','RecommendController@serverListByID')->name('recommendDetail');
	Route::get('/serverList','RecommendController@serverList')->name('commendList');
	Route::get('/deleteReInfo/{id}','RecommendController@deleteReInfo')->name('commendDelete');
	Route::get('/insertRecommend','RecommendController@insertRecommend')->name('commendCreatePage');
	Route::post('/addRecommend','RecommendController@addRecommend')->name('commendCreate');
	Route::get('/updateRecommend/{id}','RecommendController@updateRecommend')->name('commendUpdatePage');
	Route::post('/modifyRecommend/{id}','RecommendController@modifyRecommend')->name('commendUpdate');
	Route::get('/getReInfo','RecommendController@getReInfo')->name('classificationDetail');

});
