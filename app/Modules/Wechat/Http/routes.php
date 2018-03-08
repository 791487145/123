<?php




Route::group(['prefix' => 'wechat'], function() {

});



Route::any('/wechat', 'WechatController@wechat');