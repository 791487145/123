<?php





Route::post('/pay/wechatpay/notify', 'WechatpayController@notify')->name('wechatpayCreate');
Route::post('/pay/alipay/notify', 'AlipayController@notify')->name('alipaypayCreate');

Route::group(['prefix' => 'pay', 'middleware' => 'auth'], function() {
	Route::get('/', function() {
		dd('This is the Pay module index page.');
	});
    
    Route::get('/alipay', 'AlipayController@getAlipay')->name('alipayPage');
    Route::get('/alipay/return', 'AlipayController@result')->name('alipayReturnPage');


    




    
    Route::get('/wechatpay', 'WechatpayController@getWechatpay')->name('wechatpay');


});