<?php



Route::group(['prefix' => 'finance', 'middleware' => 'auth'], function() {
    
    Route::get('/list', 'PayController@getFinanceList')->name('financeList');

    
    Route::get('/cash', 'PayController@getCash')->name('cashDetail');
    
    Route::post('/cash', 'PayController@postCash')->name('cashCreate');
    
    Route::get('/wechatPay/{order}', 'PayController@getWechatPay')->name('wechatPayPage');
    
    Route::get('/pay/unionpay/return', 'PayController@unionpayReturn')->name('unionpayCreate');
    
    Route::get('/verifyOrder/{orderCode}', 'PayController@verifyOrder')->name('verifyOrderDetail');

    
    Route::get('cashout', 'PayController@getCashout')->name('cashoutPage');
    
    Route::post('cashout', 'PayController@postCashout')->name('cashoutCreate');
    
    Route::get('cashoutInfo/{cashoutInfo}', 'PayController@getCashoutInfo')->name('cashoutDetail');
    Route::post('cashoutInfo', 'PayController@postCashoutInfo')->name('cashoutInfoCreate');
    
    Route::get('/waitcashout', 'PayController@waitcashout')->name('waitcashoutPage');

    
    Route::get('/assetDetail','PayController@assetdetail')->name('assetDetail');
    Route::get('/assetDetailminute/{id}','PayController@assetDetailminute')->name('assetDetailminute');

    
    Route::get('/getpay/{id}', 'PayController@getpay')->name('getpay');
    
    Route::post('balancePayment', 'PayController@balancePayment')->name('balancePayment');
    
    Route::post('thirdPayment', 'PayController@thirdPayment')->name('thirdPayment');
    
    Route::post('thirdPayment/alipay/return', 'PayController@thirdAlipayReturn');
    
    Route::get('/shopsuccess/{id}', 'PayController@shopsuccess')->name('shopsuccess');

});




