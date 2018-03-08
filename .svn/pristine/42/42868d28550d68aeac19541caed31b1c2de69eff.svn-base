<?php




Route::group(['prefix' => 'question'], function() {
    Route::get('index/{status?}','IndexController@index')->name('index');
    Route::get('child/{id}','IndexController@getChild');
    Route::get('answerlist/{id}','IndexController@answerlist')->name('answerlist');
    Route::get('wkanswerlist/{id}','IndexController@wkanswerlist')->name('wkanswerlist');
    Route::get('/check/{id}','IndexController@check');
    Route::get('reply/{questionid}','IndexController@reply')->name('reply');
});
Route::group(['prefix' => 'question','middleware' => 'auth'], function() {
    Route::get('quiz','IndexController@quiz')->name('quiz');
    Route::get('myquestionlist','MyQuestionController@myquestionlist');
    Route::post('add','IndexController@add');
    Route::get('add/{questionid}','IndexController@addquestion');
    Route::post('answeradd','IndexController@answeradd');
    Route::get('wkanswerlist/addpraise/{num}/{uid}/{answerid}/{questionid}','IndexController@addpraise');
    Route::get('answerlist/addpraise/{num}/{uid}/{answerid}/{questionid}','IndexController@addpraise');
    Route::get('answerlist/adopt/{adoptid}/{questionid}','IndexController@adopt');
    Route::get('reward/{adoptid}/{questionid}','IndexController@reward');
    
    Route::post('reward/add','IndexController@money');
    Route::get('myquestion','IndexController@myquestion');
});