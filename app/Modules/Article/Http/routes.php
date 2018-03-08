<?php




Route::group(['prefix' => 'article'], function() {

	
	Route::get('/','InformationController@index')->name('informationList');
	
	Route::get('/{id}','InformationController@newsDetail')->name('newsDetail')->where('id', '[0-9]+');

	
	Route::get('/aboutUs/{catID}','FooterArticleController@aboutUs')->name('aboutUsDetail');
	
	Route::get('/helpCenter/{catID}/{upID}','FooterArticleController@helpCenter')->name('helpCenterDetail');

});