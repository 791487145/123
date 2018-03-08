<?php




Route::group(['prefix' => 'shop'], function() {

	Route::get('/ajaxUpdateShop','IndexController@ajaxUpdateShop')->name('ajaxUpdateShop');
	Route::post('/ajaxUpdatePic','IndexController@ajaxUpdatePic')->name('ajaxUpdatePic');
	Route::get('/ajaxDelPic','IndexController@ajaxDelPic')->name('ajaxDeletePic');
	Route::get('/ajaxUpdateBack','IndexController@ajaxUpdateBack')->name('ajaxUpdateBack');
	Route::get('/ajaxServiceComments','IndexController@ajaxServiceComments')->name('ajaxServiceComments');

	Route::get('/about/{id}','IndexController@shopabout')->name('shopabout');
	Route::get('/successStory/{id}','IndexController@successstory')->name('successstory');

	Route::get('/work/{id}','IndexController@shopall')->name('shopall');
	Route::get('/rated/{id}','IndexController@rated')->name('rated');



	Route::get('/serviceAll/{id}','IndexController@serviceAll')->name('serviceAll');

    Route::get('getSecondCate/{cateId}', 'IndexController@getSecondCate');

	Route::get('/buyGoods/{id}','GoodsController@buyGoods')->name('buyGoods');
	Route::post('addGoodsComment', 'GoodsController@addGoodsComment');
	Route::post('ajaxGetGoodsComment', 'GoodsController@ajaxGetGoodsComment');

	Route::get('/buyservice/{id}','IndexController@buyService')->name('buyService');

	Route::get('/successDetail/{id}','IndexController@successDetail')->name('successDetail');
	Route::get('/ajaxAdd', 'IndexController@ajaxAdd')->name('ajaxCreateShop');
	Route::post('/contactMe', 'IndexController@contactMe')->name('messageCreate');
	Route::get('/navList','IndexController@navList')->name('navList');
	Route::get('/{id}','IndexController@shopOutside')->name('shopOutside');
});
Route::group(['prefix' => 'shop', 'middleware' => 'auth'], function () {
    Route::get('/manage/{id}','IndexController@shop')->name('shop');
	Route::get('/orders/{id}','GoodsController@orders')->name('orders');
	Route::post('/postOrder','GoodsController@postOrder')->name('postOrder');

	Route::get('/pay/{id}','GoodsController@pay')->name('pay');
	Route::post('/postPayOrder','GoodsController@postPayOrder')->name('postPayOrder');

	Route::get('/confirm/{id}','GoodsController@confirm')->name('confirm');
	Route::post('/postConfirm','GoodsController@postConfirm')->name('postConfirm');
	Route::post('/postRightsInfo','GoodsController@postRightsInfo')->name('postRightsInfo');
	Route::get('/download/{id}','GoodsController@download')->name('download');



});
