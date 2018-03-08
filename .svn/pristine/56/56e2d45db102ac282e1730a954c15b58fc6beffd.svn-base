<?php




Route::group(['prefix' => 'order','middleware' => 'auth'], function() {

	Route::get('pay/alipay/return','CallBackController@alipayReturn')->name('alipayReturn');

});



Route::post('order/pay/alipay/notify', 'CallBackController@alipayNotify')->name('alipayNotifyCreate');
Route::post('order/pay/wechat/notify', 'CallBackController@wechatNotify')->name('wechatNotifyCreate');