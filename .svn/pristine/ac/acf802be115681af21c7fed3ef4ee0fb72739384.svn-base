<?php




Route::group(['prefix' => 'bre'], function() {
    Route::get('/', 'IndexController@index')->name('indexList');

    
    Route::get('/service', 'IndexController@getService')->name('serviceList');
    Route::post('/feedbackInfo', 'IndexController@creatInfo')->name('feedbackCreate');
    Route::get('/serviceCaseList/{uid}', 'ServiceController@serviceCaseList')->name('serviceCaseList');
    Route::get('/serviceEvaluateDetail/{uid}', 'ServiceController@serviceEvaluateDetail')->name('serviceEvaluateDetail');
    Route::get('/serviceCaseDetail/{id}/{uid}', 'ServiceController@serviceCaseDetail')->name('serviceCaseDetail');
    Route::get('/ajaxAdd', 'ServiceController@ajaxAdd')->name('ajaxCreateAttention');
    Route::get('/ajaxDel', 'ServiceController@ajaxDel')->name('ajaxDeleteAttention');
    Route::post('/contactMe', 'ServiceController@contactMe')->name('messageCreate');

    
    Route::get('/agree/{code_name}', 'AgreementController@index')->name('agreementDetail');

    
    Route::get('/shop', 'IndexController@shop')->name('shopList');
    
    Route::get('/changeUrl', 'IndexController@changeUrl')->name('changeUrl');

    
    Route::post('/ajaxGoodsList', 'IndexController@ajaxGoodsList')->name('ajaxGoodsList');

});




Route::group(['prefix' => 'bre', 'middleware' => ['ruleengine']], function () {
	

	

    
    
});
