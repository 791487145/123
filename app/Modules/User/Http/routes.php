<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/*Route::get('/login', 'UserController@login');
Route::post('/userLogin', 'UserController@userLogin');
Route::get('/register', 'UserController@register');
Route::post('/userRegister', 'UserController@userRegister');
Route::get('/loginOut', 'UserController@loginOut');
Route::get('/oauthLogin/{type}', 'ThirdLoginController@oauthLogin');
Route::get('/oauthLogin/callback/{type}', 'ThirdLoginController@handleOAuthCallBack');*/

//用户登录 路由
Route::get('login', 'Auth\AuthController@getLogin')->name('loginCreatePage');
Route::post('login', 'Auth\AuthController@postLogin')->name('loginCreate');
Route::get('logout', 'Auth\AuthController@getLogout')->name('logout');

//第三方登录
Route::get('oauth/{type}', 'Auth\AuthController@oauthLogin');
Route::get('oauth/{type}/callback', 'Auth\AuthController@handleOAuthCallBack');

//用户注册 路由
Route::get('register', 'Auth\AuthController@getRegister')->name('registerCreatePage');
Route::post('register', 'Auth\AuthController@postRegister')->name('registerCreate');
Route::post('register/phone', 'Auth\AuthController@phoneRegister');
Route::post('auth/mobileCode', 'Auth\AuthController@sendMobileCode');
Route::post('checkMobile', 'IndexController@checkMobile');
Route::get('StartCaptchaServlet', 'UserCenterController@StartCaptchaServlet');//请求滑块验证

//用户账号 验证
Route::get('activeEmail/{validationInfo}', 'Auth\AuthController@activeEmail');
Route::get('waitActive/{email}', 'Auth\AuthController@waitActive');

//找回密码请求路由
Route::get('password/email', 'Auth\PasswordController@getEmail')->name('getPasswordPage');
Route::post('password/email', 'Auth\PasswordController@postEmail')->name('passwordUpdate');
Route::get('password/reSendEmail/{email}', 'Auth\PasswordController@reSendPasswordEmail')->name('reSendPasswordEmail');
Route::post('password/checkEmail', 'Auth\PasswordController@checkEmail')->name('checkEmail');
Route::post('password/checkCode', 'Auth\PasswordController@checkCode')->name('checkCode');
Route::get('password/mobile', 'Auth\PasswordController@getMobile');
Route::post('password/mobile', 'Auth\PasswordController@postMobile');
Route::get('password/mobileReset', 'Auth\PasswordController@getMobileReset');
Route::post('password/mobileReset', 'Auth\PasswordController@postMobileReset');
Route::get('password/mobileResetSuccess', 'Auth\PasswordController@mobileResetSuccess');
Route::post('password/mobilePasswordCode', 'Auth\PasswordController@sendMobilePasswordCode');


//重置密码请求路由
Route::get('resetValidation/{validationInfo}', 'Auth\PasswordController@resetValidation')->name('passwordResetValidation');
Route::get('passwordFail', 'Auth\PasswordController@passwordFail');
Route::get('waitValidation/{email}', 'Auth\PasswordController@waitValidation')->name('waitValidationPage');
Route::get('password/reset', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset')->name('nameResetCreate');

Route::get('flushCode', 'Auth\AuthController@flushCode')->name('flushCode');
Route::post('checkUserName', 'Auth\AuthController@checkUserName')->name('checkUserName');
Route::post('checkEmail', 'Auth\AuthController@checkEmail')->name('checkEmail');
Route::get('reSendActiveEmail/{email}', 'Auth\AuthController@reSendActiveEmail')->name('reSendActiveEmail');

Route::get('user/getZone', 'AuthController@getZone')->name('zoneDetail');

Route::get('/user/promote/{param}', 'PromoteController@promote')->name('promote'); //被推广出去的链接

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('/index','UserCenterController@index')->name('indexPage');

    Route::get('paylist', 'AuthController@getPayList')->name('paylist');

    //邮箱绑定路由
    Route::get('emailAuth', 'AuthController@getEmailAuth')->name('emailAuthPage');
    Route::get('sendEmailAuth', 'AuthController@sendEmailAuth')->name('sendEmailAuth');
    Route::get('reSendEmailAuth/{email}', 'AuthController@reSendEmailAuth');
    Route::get('verifyEmail/{validationInfo}', 'AuthController@verifyEmail')->name('verifyEmail');


    //手机绑定路由
    Route::get('phoneAuth', 'AuthController@getPhoneAuth')->name('phoneAuthPage');
    Route::post('phoneAuth', 'AuthController@postPhoneAuth');
    Route::post('sendBindSms', 'AuthController@sendBindSms');
    Route::get('unbindMobile', 'AuthController@getUnbindMobile');
    Route::post('sendUnbindSms', 'AuthController@sendUnbindSms');
    Route::post('unbindMobile', 'AuthController@postUnbindMobile');

    //身份认证路由
    Route::get('/realnameAuth', 'AuthController@getRealnameAuth')->name('realnameAuthCreatePage');
    Route::post('/realnameAuth', 'AuthController@postRealnameAuth')->name('realnameAuthCreate');
    Route::get('/reAuthRealname', 'AuthController@reAuthRealname')->name('reAuthRealnamePage');

    //用户支付宝认证路由
    Route::get('/alipayAuth', 'AuthController@getAlipayAuth')->name('alipayAuthCreatePage');
    Route::post('/alipayAuth', 'AuthController@postAlipayAuth')->name('alipayAuthCreate');
    Route::get('/alipayAuthList', 'AuthController@listAlipayAuth')->name('alipayAuthList');
    Route::get('/alipayAuthSchedule/{alipayAuthId}', 'AuthController@getAlipayAuthSchedule')->name('alipayAuthSchedule');
    Route::post('/verifyAlipayAuthCash', 'AuthController@verifyAlipayAuthCash')->name('verifyAlipayAuthCash');
    Route::post('changeAlipayAuth', 'AuthController@changeAlipayAuth')->name('alipayAuthStatusUpdate');

    //用户银行认证路由
    Route::get('/bankAuth', 'AuthController@getBankAuth')->name('bankAuthCreatePage');
    Route::post('/bankAuth', 'AuthController@postBankAuth')->name('bankAuthCreate');
    Route::get('/bankAuthList', 'AuthController@listBankAuth')->name('bankAuthList');
    Route::get('/bankAuthSchedule/{bankAuthId}', 'AuthController@getBankAuthSchedule')->name('waitBankAuthPage');
    Route::post('/verifyBankAuthCash', 'AuthController@verifyBankAuthCash')->name('verifyBankAuthCash');
    Route::get('/unBindBankAuth/{id}', 'AuthController@unBindBankAuth')->name('');

    //用户收藏/用户关注
    Route::get('/myshop','UserMoreController@myshop')->name('myshop'); //我收藏的店铺
    Route::get('/myfocus','UserMoreController@myTocusTask')->name('myfocusList');
    Route::get('/ajaxDeleteFocus/{id}','UserMoreController@ajaxDeleteFocus')->name('ajaxDeleteFocus');
    Route::get('/userfocus','UserMoreController@userFocus')->name('userFocusList');
    Route::get('/userFocusDelete/{id}','UserMoreController@userFocusDelete')->name('userFocusDelete');
    Route::get('/userNotFocus/{uid}','UserMoreController@userNotFocus')->name('userNotFocus');
    //我的粉丝
    Route::get('/userfans','UserMoreController@userFans')->name('userfans');

    //用户我发布的任务
    Route::get('/myTasksList','UserMoreController@myTasksList')->name('myTasksList');
    Route::get('/myTaskAxis','UserMoreController@myTaskAxis')->name('myTaskAxis');
    Route::get('/myTaskAxisAjax','UserMoreController@myTaskAxisAjax')->name('myTaskAxisAjax');
    Route::get('/myTask','UserMoreController@myTask')->name('myTask');
    Route::get('/acceptTasksList','UserMoreController@acceptTasksList')->name('acceptTasksList');
    Route::get('/myAjaxTask','UserMoreController@myAjaxTask')->name('myAjaxTask');

    //用户雇主交易评价
    Route::get('/myCommentOwner','UserMoreController@myCommentOwner')->name('myCommentList');
    Route::get('/myWorkHistory','UserMoreController@myWorkHistory')->name('myWorkList');
    Route::get('/myWorkHistoryAxis','UserMoreController@myWorkHistoryAxis')->name('myWorkHistoryAxis');
    Route::get('/workComment','UserMoreController@workComment')->name('workCommentList');//威客交易评价
    //用户未发布的任务
    Route::get('/unreleasedTasks','UserMoreController@unreleasedTasks')->name('unreleasedTasksList');
    Route::get('/unreleasedTasksDelete/{id}','UserMoreController@unreleasedTasksDelete')->name('unreleasedTasksDelete');

    Route::post('changeBankAuth', 'AuthController@changeBankAuth')->name('bankStatusUpdate');


    //用户个人信息设置
    Route::get('/info','UserCenterController@info')->name('infoUpdatePage');
    Route::post('/infoUpdate','UserCenterController@infoUpdate')->name('infoUpdate');
    //用户登录密码修改部分
    Route::get('/loginPassword','UserCenterController@loginPassword')->name('passwordUpdatePage');
    Route::post('/passwordUpdate','UserCenterController@passwordUpdate')->name('passwordUpdate');
    //用户支付密码修改部分
    Route::get('/payPassword','UserCenterController@payPassword')->name('payPasswordUpdatePage');
    Route::get('/checkInterVal','UserCenterController@checkInterVal')->name('checkInterVal');
    Route::post('/payPasswordUpdate','UserCenterController@payPasswordUpdate')->name('payPasswordUpdate');
    Route::post('/sendEmail','UserCenterController@sendEmail')->name('sendEmail');
    Route::post('/checkEmail','UserCenterController@checkEmail')->name('checkEmail');
    Route::post('/validate','UserCenterController@validateCode')->name('validateCodePage');
    //用户技能标签部分
    Route::get('/skill','UserCenterController@skill')->name('skillUpdatePage');
    Route::post('/skillSave','UserCenterController@skillSave')->name('skillCreate');
    //原始的标签修改页面
    Route::get('/skillUpdata/{id}','UserCenterController@skillUpdata')->name('skillUpdate');
    Route::post('/tagUpdate','UserCenterController@tagUpdate')->name('tagUpdate');
    Route::get('/delTag','UserCenterController@delTag')->name('tagDelete');
    Route::get('/hotTag','UserCenterController@hotTag');
    //用户头像部分
    Route::get('/avatar','UserCenterController@userAvatar')->name('userAvatarPage');
    Route::post('/ajaxAvatar','UserCenterController@ajaxAvatar')->name('headUpdate');
    Route::post('/headEdit','UserCenterController@AvatarEdit')->name('headEdit');
    //地区三级联动
    Route::get('/ajaxcity','UserCenterController@ajaxCity')->name('ajaxcity');
    Route::get('/ajaxarea','UserCenterController@ajaxArea')->name('ajaxarea');
    //demo发送邮件修改密码
    //Route::get('/account','UserCenterController@account');
    //Route::post('/password','UserCenterController@password');
    //Route::post('/psUpdate','UserCenterController@psUpdate');
    //Route::get('/sendEmail','UserCenterController@sendEmail');

    //空间页面
    Route::get('/personCase', 'UserController@getPersonCase')->name('personCasePage');
    //个人空间案例添加
    Route::get('/addpersoncase/{id}', 'UserController@getAddPersonCase')->name('caseCreatePage');
    //个人空间案例添加
    Route::post('/addCase', 'UserController@postAddCase')->name('caseCreate');
    //个人空间评价
    Route::get('/personevaluation', 'UserController@getPersonEvaluation')->name('');
    Route::get('/ajaxUpdateCase','UserController@ajaxUpdateCase')->name('ajaxUpdateCase');
    Route::get('/ajaxUpdateBack','UserController@ajaxUpdateBack')->name('ajaxUpdateBack');

    Route::post('/ajaxUpdatePic','UserController@ajaxUpdatePic')->name('ajaxUpdatePic');
    Route::get('/ajaxDelPic','UserController@ajaxDelPic')->name('ajaxDeletePic');

    //个人空间评价详情页
    Route::get('/personevaluationdetail/{id}','UserController@getPersonEvaluationDetail')->name('personevaluationPage');
    //个人空间成功案例
    Route::get('/','UserCenterController@assetdetail')->name('successCaseList');

    //用户中心我的消息
    Route::get('/messageList/{type}', 'MessageReceiveController@messageList')->name('messageList'); //我的消息列表
    Route::post('/allChange', 'MessageReceiveController@allChange')->name('allMessageStatusUpdate'); //批量改变消息状态
    Route::post('/contactMe', 'MessageReceiveController@contactMe')->name('messageCreate'); //站内信发消息
    Route::post('/changeStatus', 'MessageReceiveController@postChangeStatus')->name('messageStatusUpdate'); //改变信息读取状态

    //更改用户头像
    Route::post('/changeAvatar', 'IndexController@ajaxChangeAvatar')->name('changeAvatar'); //更改用户头像

    //删除用户成功案例
    Route::post('/ajaxDeleteSuccess', 'UserController@ajaxDeleteSuccess')->name('UserController');

    //我是威客成功案例编辑视图
    Route::get('/editpersoncase/{id}', 'UserController@getEditPersonCase')->name('caseUpdatePage');
    //我是威客成功案例编辑
    Route::post('/editCase', 'UserController@postEditCase')->name('caseUpdate');

    //修改支付提示状态
    Route::post('/updateTips', 'IndexController@updateTips')->name('updateTips');






    //我的店铺设置
    Route::get('/shop', 'ShopController@getShop')->name('userShop');
    //保存店铺信息
    Route::post('/shop', 'ShopController@postShopInfo')->name('postShop');
    //ajax获取地区二级、三级信息
    Route::post('/ajaxGetCity', 'ShopController@ajaxGetCity')->name('ajaxGetCity');
    //ajax获取地区三级信息
    Route::post('/ajaxGetArea', 'ShopController@ajaxGetArea')->name('ajaxGetArea');
    //ajax获取二级行业分类信息
    Route::post('/ajaxGetSecondCate', 'ShopController@ajaxGetSecondCate')->name('ajaxGetSecondCate');
    //店铺企业认证
    Route::get('/enterpriseAuth', 'ShopController@getEnterpriseAuth')->name('enterpriseAuth');
    //保存企业认证信息
    Route::post('/enterpriseAuth', 'ShopController@postEnterpriseAuth')->name('postEnterpriseAuth');
    Route::post('/fileUpload','ShopController@fileUpload')->name('enterpriseAuthFileCreate');//企业认证文件上传
    Route::get('/fileDelete','ShopController@fileDelete')->name('enterpriseAuthFileDelete');//企业认证文件上传删除
    Route::get('/enterpriseAuthAgain', 'ShopController@enterpriseAuthAgain')->name('enterpriseAuthAgain');//重新企业认证
    //店铺案例管理
    Route::get('/myShopSuccessCase', 'ShopController@shopSuccessCase')->name('shopSuccessCase');
    Route::get('/addShopSuccess', 'ShopController@addShopSuccess')->name('addShopSuccess');//添加案例视图
    Route::post('/postAddShopSuccess','ShopController@postAddShopSuccess')->name('postAddShopSuccess');//添加案例
    Route::get('/editShopSuccess/{id}', 'ShopController@editShopSuccess')->name('editShopSuccess');//编辑案例视图
    Route::post('/postEditShopSuccess','ShopController@postEditShopSuccess')->name('postEditShopSuccess');//编辑案例
    Route::post('/deleteShopSuccess','ShopController@deleteShopSuccess')->name('deleteShopSuccess');//删除案例

    Route::get('/serviceCreate', 'ServiceController@serviceCreate')->name('serviceCreate');//店铺发布服务
    Route::post('/serviceUpdate','ServiceController@serviceUpdate')->name('serviceUpdate');//发布服务提交
    Route::get('/serviceBounty/{id}','ServiceController@serviceBounty')->name('serviceBounty');//发布服务付款页面
    Route::post('/serviceBountyPay','ServiceController@serviceBountyPay')->name('serviceBountyPay');//发布服务付款页面
    Route::get('/serviceList', 'ServiceController@serviceList')->name('serviceList');//店铺服务列表
    Route::get('/serviceAdded/{id}', 'ServiceController@serviceAdded')->name('serviceAdded');//服务上下架
    Route::get('/serviceDelete/{id}', 'ServiceController@serviceDelete')->name('serviceDelete');//服务软删除
    Route::get('/serviceMine', 'ServiceController@serviceMine')->name('serviceMine');//店铺我购买的服务
    Route::get('/serviceMyJob', 'ServiceController@serviceMyJob')->name('serviceMyJob');//店铺我购买的服务
    Route::get('/serviceEdit/{id}', 'ServiceController@serviceEdit')->name('serviceEdit');//服务编辑功能
    Route::post('/serviceEditUpdate', 'ServiceController@serviceEditUpdate')->name('serviceEditUpdate');//服务编辑提交控制器
    Route::get('/serviceAttchDelete', 'ServiceController@serviceAttchDelete')->name('serviceAttchDelete');//服务编辑删除附件
    Route::post('/serviceEditCreate', 'ServiceController@serviceEditCreate')->name('serviceEditCreate');//未审核通过的服务编辑提交
    Route::get('/serviceEditNew/{id}', 'ServiceController@serviceEditNew')->name('serviceEditNew');//未审核通过的服务编辑页面
    Route::get('/shopcommentowner', 'ServiceController@shopcommentowner')->name('shopcommentowner');//店铺交易评价
    Route::get('/waitServiceHandle/{id}', 'ServiceController@waitServiceHandle')->name('waitServiceHandle');//店铺发布服务等待页面
    Route::post('/servicecashvalid', 'ServiceController@serviceCashValid')->name('serviceCashValid');//店铺发布服务验证金额

    //店铺发布商品页面
    Route::get('/pubGoods', 'GoodsController@getPubGoods')->name('getPubGoods');
    //发布商品处理
    Route::post('/pubGoods', 'GoodsController@postPubGoods')->name('postPubGoods');
    //成功发布商品等待审核
    Route::get('waitGoodsHandle/{id}', 'GoodsController@waitGoodsHandle');
    //店铺商品管理
    Route::get('/goodsShop', 'GoodsController@shopGoods')->name('shopGoods');
    //店铺编辑商品页面
    Route::get('/editGoods/{id}', 'GoodsController@editGoods')->name('editGoods');
    //店铺商品编辑保存信息
    Route::post('/postEditGoods', 'GoodsController@postEditGoods')->name('postEditGoods');
    Route::post('/goodsCashValid', 'GoodsController@goodsCashValid')->name('goodsCashValid');//店铺发布商品验证金额

    //（我是雇主 我购买的商品列表）
    Route::get('/myBuyGoods', 'GoodsController@myBuyGoods')->name('myBuyGoods');

    //（我是威客 我卖出的商品列表）
    Route::get('/mySellGoods', 'GoodsController@mySellGoods')->name('mySellGoods');

    //我收藏的店铺
    Route::get('/myCollectShop', 'ShopController@myCollectShop')->name('myCollectShop');
    Route::post('/cancelCollect', 'ShopController@cancelCollect')->name('cancelCollect'); //取消收藏

    //我的店铺提示
    Route::get('/myShopHint', 'ShopController@myShopHint')->name('myShopHint');


    Route::post('/changeGoodsStatus', 'GoodsController@changeGoodsStatus')->name('changeGoodsStatus'); //修改商品状态

    //我的店铺中转链接
    Route::get('/switchUrl', 'ShopController@switchUrl')->name('switchUrl');

    //实名认证提示
    Route::get('/userShopBefore', 'ShopController@userShopBefore')->name('userShopBefore');

    //我的回答
    Route::get('/myAnswer', 'QuestionController@myAnswer')->name('myAnswer');
    //我的提问
    Route::get('/myquestion', 'QuestionController@myQuestion')->name('myquestion');


    //我的推广链接
    Route::get('/promoteUrl', 'PromoteController@promoteUrl')->name('promoteUrl');
    //我的推广收益
    Route::get('/promoteProfit', 'PromoteController@promoteProfit')->name('promoteUrl');


    //vip购买记录
    Route::get('/vippaylist', 'ShopController@vippaylist')->name('vippaylist');

    Route::get('/vippaylog/{id}', 'ShopController@vippaylog')->name('vippaylog'); //vip购买记录详情


    Route::get('/vipshopbar', 'ShopController@vipshopbar')->name('vipshopbar'); //店铺装修
    Route::post('/vipshopbar', 'ShopController@postVipshopbar'); //店铺装修

    Route::get('delVipshopFile', 'ShopController@delVipshopFile');
});


