<?php

Route::group(['prefix' => 'api'], function() {

    Route::post('/user/getToken', 'UserController@getToken');
	Route::post('/user/createUserInfo', 'UserController@createUserInfo');//测试生成人数
	Route::post('/user/delTestUser', 'UserController@delTestUser');//删除生成人数
    //获取用户uid
    Route::get('/user/getUid','UserController@getUid');
	Route::post('/user/sendCode', 'UserController@sendCode');//发送验证码
	Route::post('/user/register', 'UserController@register');//注册

	Route::get('/user/statistics', 'UserController@statistics');

	Route::post('/user/vertify/invitationCodeVertify','UserController@invitationcode');//验证激活码
	Route::post('/user/vertify/extensionCode','UserController@extensioncode');//验证推广码
	Route::post('/user/vertify/phone','UserController@verifyphone');//注册之前验证手机号是否已经注册或者手机号
	Route::post('/user/activite/invitationcode','UserController@invitationCodeAct');
	Route::get('/user/activate/{id}','UserController@activate');//支付激活
	Route::post('/user/vertify/identityCardNum','AuthController@identityCardNum');//验证身份证号是否已经认证

	//测试三方登录
	Route::post('/oauth', 'UserController@authThreePartiesSorts');
	//Route::get('oauth/{type}/callback', 'UserController@authThreePartiesSortsCall');

    //安卓第三方登录
    Route::post('/user/oauthLogin','UserController@postOauthLogin');

	Route::post('/user/login', 'UserController@login');//登录
    Route::post('/user/passwordSalt', 'UserController@postPasswordSalt');//获取密码随机码
	Route::post('/user/webLogin', 'UserController@webLogin');//网页登录

	Route::post('/user/vertify', 'UserController@vertify');//手机验证码登录
	Route::post('/user/passwordReset', 'UserController@passwordReset');//密码复位（重置）
	Route::get('/pay/checkConfig','PayController@checkThirdConfig');
	//Route::post('oauth','UserController@oauthLogin');//第三方登录
	Route::get('/taskCate','UserInfoController@taskCate');//任务分类
	Route::get('/hotCate','UserInfoController@hotCate');
	
	Route::get('/task/district', 'UserInfoController@district');//获取地区信息
	Route::get('/work/detail','UserInfoController@showWorkDetail');
	Route::get('/user/hotService','UserInfoController@hotService');
	Route::get('/user/slideInfo','UserInfoController@slideInfo');
	Route::get('/user/serviceByCate','UserInfoController@serviceByCate');
	Route::get('/user/serviceList','UserInfoController@serviceList');

	Route::get('/user/hotShop','UserInfoController@hotShop');

	Route::get('/task/hotTask','UserInfoController@hotTask');
	Route::post('updateSpelling', 'UserInfoController@updateSpelling');
	Route::get('/task/taskByCate','UserInfoController@taskByCate');

	Route::get('/user/skill', 'UserInfoController@skill');
	Route::get('/user/workerDetail','UserInfoController@workerDetail');
	Route::get('/myTask/detail','UserInfoController@showTaskDetail');
	Route::get('/agreementDetail','UserController@agreementDetail');

	Route::get('/hasIm','UserController@hasIM');
	Route::get('/user/secondSkill', 'UserInfoController@secondSkill');

	Route::post('/user/phoneCodeVertiy', 'UserController@phoneCodeVertiy');
	Route::get('/user/caseInfo', 'UserInfoController@caseInfo');
	Route::get('/app/version', 'UserController@version');
	Route::get('/iosVersion', 'UserController@iosVersion');
	Route::get('/work/rateInfo','GoodsController@workRateInfo');
	Route::get('/work/recommendInfo','GoodsController@workRecommendInfo');
	Route::get('/service/rateInfo','GoodsController@serviceRateInfo');
	Route::get('/service/recommendInfo','GoodsController@serviceRecommendInfo');
	Route::get('/shop/collectStatus','ShopController@collectStatus');
	Route::get('/shop/isEmploy','ShopController@isEmploy');
	Route::get('/shop/detail','ShopController@shopInfo');
	Route::get('/shop/workList','ShopController@workList');
	Route::get('/shop/successList','ShopController@successList');
	Route::get('/shop/goodDetail','ShopController@goodDetail');
	Route::get('/shop/goodComment','ShopController@goodComment');
	Route::get('/shop/goodContent','ShopController@goodContent');
	Route::get('/shopList','ShopController@shopList');
	Route::get('/commodityList','ShopController@commodityList');
	Route::get('/shop/serviceList','ShopController@serviceList');
	Route::get('/shop/serviceEmploy','EmployController@serviceEmploy');

	Route::get('/shop/shopDetail','ShopController@shopDetail');

	Route::get('/user/messageNum','UserController@messageNum');

	//任务
	Route::get('/taskRegion', 'TaskOtherController@tasksRegion');//地区选择
	Route::get('/taskCate', 'TaskOtherController@tasksCates');//任务分类

	//----------------------------app版本更新-----------------------------
	Route::post('/package', 'UserController@appPackageUpdate');//app版本更新
});




Route::group(['prefix' => 'api', 'middleware' => ['web.auth']], function () {
//Route::group(['prefix' => 'api'],function(){

    Route::post('/user/index', 'IndexController@index'); //首页
	Route::post('/user/menu', 'IndexController@indexMenu'); //主菜单
    Route::post('/user/navigation', 'IndexController@indexNavigation'); //我的导航
    Route::post('/user/navigationAll', 'IndexController@navigationAll'); //所有导航

    Route::post('/user/functionSort', 'UserInfoController@funSort'); //排序功能

	Route::post('/user/updatePassword', 'UserController@updatePassword');//登录状态重置密码（验证原有密码重置密码）

    Route::post('/user/setPayCode','UserController@setPayCode');//首次设置支付密码
	Route::post('/user/updatePayCode', 'UserController@updatePayCode');//原有密码更新支付密码
	// Route::post('/user/payCodeReset', 'UserController@payCodeReset');//手机重置支付密码
	Route::post('/user/vertifyPayCode','UserController@vertifyPayCode');//验证用户支付密码
	Route::post('/user/vertifySafeCode','UserController@vertifySafeCode');//验证用户安全密码
	Route::post('/user/updateSafeCode','UserController@updateSafeCode');//更新用户安全密码

	Route::post('/auth/realnameAuth', 'AuthController@realnameAuth');//实名认证
	Route::post('/auth/studentAuth','AuthController@studentAuth');//学生证认证
	Route::post('/auth/studentCardInfo','AuthController@studentCardInfo');//获取学生认证信息
	Route::post('/auth/realname','AuthController@realname');//获取用户实名
	Route::post('/auth/bankAuth', 'AuthController@bankAuth');//绑定银行卡
	Route::get('/auth/getBankAuth', 'AuthController@getBankAuth');
	Route::get('/auth/bankAuthInfo', 'AuthController@bankAuthInfo');
	Route::get('/auth/realnameAuthInfo', 'AuthController@realnameAuthInfo');
	Route::post('/auth/alipayAuth', 'AuthController@alipayAuth');//绑定支付宝
	Route::get('/auth/alipayAuthInfo', 'AuthController@alipayAuthInfo');
	Route::post('/auth/verifyAlipayAuthCash', 'AuthController@verifyAlipayAuthCash');
	Route::post('/auth/verifyBankAuthCash', 'AuthController@verifyBankAuthCash');

	Route::get('/user/myfocus', 'UserInfoController@myfocus');//我收藏的任务
	Route::post('/user/deleteFocus', 'UserInfoController@deleteFocus');//删除任务收藏

	Route::post('/user/deleteUser', 'UserInfoController@deleteUser');//取消用户关注
	Route::post('/user/skillSave', 'UserInfoController@skillSave');//添加OR删除技能

	Route::post('/task/upload','TaskController@uploadPic');//任务图片上传

	Route::get('/user/addFocus','UserInfoController@insertFocusTask');//添加任务关注

	Route::get('/tasks/userInfo','TaskController@userInfo');//任务用户基本信息
	Route::post('/tasks','TaskController@getTaskList');//任务列表
	Route::post('/taskDetial','TaskController@getTaskDetials');//任务详情
	Route::post('/task/createTaskShow','TaskController@createTaskShow');//创建任务展示
	Route::post('/task/taskInfoTotal','TaskOtherController@taskInfoTotal');//任务信息总汇

	Route::post('/tasks/createTaskTest','TaskController@createTaskTest');//自动生成任务

	Route::get('/myTask/index', 'TaskController@myPubTasks');//我发布的任务delayTaskTime
	Route::get('/myInfomation/task', 'UserInfoController@userInfoOfTasks');

	Route::post('/myTask/createTask', 'TaskController@createTask');//发布任务
	Route::post('/taskCancel', 'TaskController@cancelCreateTask');//任务取消
	Route::post('/task/CancelReceiver', 'TaskController@cancelReceiveTask');//任务取消
	Route::get('/myTask/myAccept','TaskController@myAcceptTask');//我接受的任务
	Route::get('/work/applauseRate','TaskController@applauseRate');
	Route::post('/tasks/createTaskShow','TaskController@createTaskShow');//创建任务

	Route::get('/work/winBid','TaskController@workWinBid'); //某稿件中标
	Route::post('/work/createWinBid','TaskController@createWinBidWork');//接收任务
	Route::post('/work/createDelivery','TaskController@createDeliveryWork');//交付稿件
	Route::post('/work/deliveryAgree','TaskController@deliveryWorkAgree');//稿件(任务)验收

	Route::post('/tasks/createTaskDelay','TaskController@delayTaskTime');//申请延迟
	Route::post('/tasks/TaskDelayStepOne','TaskController@employAttitudeDelayTask');//申请延迟雇主选择
	Route::post('/tasks/TaskDelayStepTwo','TaskController@cancelOrAgainPubTask');//申请延迟雇主选择

	Route::post('/work/deliveryRight','TaskController@deliveryWorkRight');//雇主或猎人维权
	Route::post('/work/evaluate','TaskController@evaluateCreate');//雇主对任务的稿件评价
	Route::post('/work/comment','TaskController@commentCreate');//任意用户对稿件评论
	Route::get('/work/getEvaluate','TaskController@getEvaluate');//获取稿件的评价
	Route::post('/fileUpload','TaskController@fileUpload');//文件上传
	Route::get('/fileDelete','TaskController@fileDelete');//删除附件

	Route::get('/user/getUserInfo', 'UserController@getUserInfo');//获取用户基本信息
	Route::post('/user/getUserSafeInfo','UserController@getUserSafeInfo');//获取用户安全信息
	Route::get('/user/personCase', 'UserInfoController@personCase');//获取用户成功案例
	Route::post('/user/addCase', 'UserInfoController@addCase');

	Route::post('/user/caseUpdate', 'UserInfoController@caseUpdate');

	Route::post('/user/getSingleInfo', 'UserController@getSingleInfo');//获取用户单项信息
	Route::post('/user/updateSingleInfo', 'UserController@updateSingleInfo');//更新用户单项信息
	Route::get('/user/getAvatar', 'UserController@getAvatar');//获取用户头像
	Route::post('/user/updateAvatar', 'UserController@updateAvatar');//更新用户头像
	Route::post('/user/updateUserInfo', 'UserController@updateUserInfo');//修改用户基本信息

	Route::post('/user/getUserName','UserController@getUserName');
	Route::post('/user/getEmail','UserController@getEmail');
	Route::post('/user/getAutograph','UserController@getAutograph');
	Route::post('/user/getIntroduce','UserController@getIntroduce');
	Route::post('/user/getSign','UserController@getSign');
	Route::post('/user/getNickName','UserController@getNickName');
	Route::post('/user/getSex','UserController@getSex');
	Route::post('/user/getMajors','UserController@getMajors');
	Route::post('/user/getYearOld','UserController@getYearOld');
	Route::post('/user/getMobile','UserController@getMobile');
	Route::post('/user/getBirthday','UserController@getBirthday');
	Route::post('/user/getSchool','UserController@getSchool');
	Route::post('/user/getNativePlace','UserController@getNativePlace');
	Route::post('/user/getSystemClass','UserController@getSystemClass');
	Route::post('/user/getPromoteCode','UserController@promoteCode');

	Route::post('/user/updateUserName','UserController@updateUserName');
	Route::post('/user/updateEmail','UserController@updateEmail');
	Route::post('/user/updateAutograph','UserController@updateAutograph');
	Route::post('/user/updateIntroduce','UserController@updateIntroduce');
	Route::post('/user/updateSign','UserController@updateSign');
	Route::post('/user/updateNickName','UserController@updateNickName');
	Route::post('/user/updateSex','UserController@updateSex');
	Route::post('/user/updateMajors','UserController@updateMajors');
	Route::post('/user/updateYearOld','UserController@updateYearOld');
	Route::post('/user/updateMobile','UserController@updateMobile');
	Route::post('/user/updateBirthday','UserController@updateBirthday');
	Route::post('/user/updateSchool','UserController@updateSchool');
	Route::post('/user/updateNativePlace','UserController@updateNativePlace');
	Route::post('/user/updateSystemClass','UserController@updateSystemClass');


	Route::post('/user/messageList', 'UserController@messageList');
	Route::post('/user/readMessage','UserController@readMessage');

	Route::get('/user/myTalk', 'UserInfoController@myTalk');
	Route::get('/user/myAttention', 'UserInfoController@myAttention');
	Route::post('/user/addAttention', 'UserInfoController@addAttention');
	Route::post('/user/addMessage', 'UserInfoController@addMessage');
	Route::post('/user/updateMessStatus', 'UserInfoController@updateMessStatus');
	Route::post('/user/deleteTalk', 'UserInfoController@deleteTalk');

	Route::post('/pay/taskService','PayController@taskService');//任务支付
	Route::post('/pay/bountyByBalance','PayController@taskDepositByBalance');
	Route::get('/pay/orderInfo','PayController@createOrderInfo');
	Route::get('/pay/balance','PayController@balance');
	Route::post('/pay/cashOut','PayController@cashOut');
	Route::get('/pay/bankAccount','PayController@bankAccount');
	Route::get('/pay/alipayAccount','PayController@alipayAccount');
	Route::get('/pay/financeList','PayController@financeList');

	Route::get('/user/loginOut','UserController@loginOut');

	Route::get('/auth/bankList','AuthController@bankList');
	Route::get('/auth/alipayList','AuthController@alipayList');

	//个人设置
	Route::post('/setting/feedbackType','PersonSettingController@feedbackType');
	Route::post('/setting/feedbackSubmission','PersonSettingController@feedbackSubmission');
	Route::post('/setting/systemHelpList','PersonSettingController@systemHelpList');
	Route::post('/setting/systemHelpDetail','PersonSettingController@systemHelpDetail');
	Route::post('/setting/consumeList','PersonSettingController@consumeList');//消费记录
	Route::post('/setting/rechargeList','PersonSettingController@rechargeList');//

	Route::post('/user/feedbackInfo', 'UserInfoController@feedbackInfo');
	Route::get('/user/helpCenter','UserInfoController@helpCenter');

	Route::get('/user/passwordCheck','UserInfoController@passwordCheck');
	Route::get('/user/moneyConfig','UserInfoController@moneyConfig');

	Route::get('/user/getCash','UserInfoController@getCash');
	Route::post('/user/postCash','PayController@postCash');


	Route::get('/noPubTask','TaskController@noPubTask');

	Route::post('/user/sendMessage','UserController@sendMessage');
	Route::get('/agreeDelivery','TaskController@agreeDelivery');
	Route::get('/guestDelivery','TaskController@guestDelivery');

	Route::get('/user/ImMessageList','UserController@ImMessageList');
	Route::get('/user/becomeFriend','UserController@becomeFriend');
	Route::get('/user/isFocusUser','UserController@isFocusUser');
	Route::get('/user/headPic','UserController@headPic');
	Route::get('/user/buyerInfo','UserInfoController@buyerInfo');
	Route::get('/user/workerInfo','UserInfoController@workerInfo');
	Route::get('/user/aboutUs','UserInfoController@aboutUs');

	Route::post('/user/messageStatus','UserController@messageStatus');

	Route::post('/user/areaInfo','UserController@areaInfo');//获取用户地域信息
	Route::post('/user/updateAreaInfo','UserController@updateAreaInfo');//更新用户地域信息
	Route::post('/user/schoolInfo','UserController@schoolInfo');//获取用户学校信息
	Route::post('/user/updateSchoolInfo','UserController@updateSchoolInfo');//更新用户学校信息

	Route::get('/shop/isPub','GoodsController@isPub');
	Route::post('/shop/fileUpload','GoodsController@fileUpload');
	Route::post('/shop/pubGoods','GoodsController@pubGoods');
	Route::post('/shop/pubService','GoodsController@pubService');
	Route::get('/shop/myCollect','GoodsController@myCollectShop');
	Route::post('/shop/collect','ShopController@collectShop');
	Route::post('/shop/cancelCollect','ShopController@cancelCollect');
	Route::get('/user/workList','GoodsController@myWorkList');
	Route::get('/user/offerList','GoodsController@myOfferList');

	Route::get('/user/myBuyGoods','GoodsController@goodsOrderList');
	Route::get('/user/mySaleGoods','GoodsController@saleOrderList');
	Route::get('/user/getShop','ShopController@getShop');
	Route::post('/user/postShopInfo','ShopController@postShopInfo');
	Route::get('/user/getShopSkill','ShopController@getShopSkill');
	Route::get('/user/myShop','ShopController@myShop');
	Route::get('/user/againEnterprise','AuthController@enterpriseAuthRestart');
	Route::post('/user/enterpriseAuth','AuthController@enterpriseAuth');
	Route::post('/user/saveShopBg','ShopController@saveShopBg');
	Route::get('/user/changeShopStatus','ShopController@changeShopStatus');

	Route::post('/user/createEmploy','EmployController@createEmploy');
	Route::post('/user/cashPayEmploy','EmployController@cashPayEmploy');
	Route::post('/user/ThirdCashEmployPay','EmployController@ThirdCashEmployPay');
	Route::get('/user/employDetail','EmployController@employDetail');
	Route::get('/user/employUserDetail','EmployController@employUserDetail');
	Route::get('/user/employServiceDetail','EmployController@employServiceDetail');
	Route::get('/user/employWorkDetail','EmployController@employWorkDetail');
	Route::get('/user/employCommentDetail','EmployController@employCommentDetail');


	Route::get('/user/dealEmploy','EmployController@dealEmploy');
	Route::post('/user/workEmployCreate','EmployController@workCreate');
	Route::post('/user/acceptEmployWork','EmployController@acceptEmployWork');
	Route::post('/user/employRights','EmployController@employRights');
	Route::post('/user/employEvaluate','EmployController@employEvaluate');


	Route::get('/user/buyGoodsDetail','GoodsController@buyGoodsDetail');
	Route::get('/user/saleGoodsDetail','GoodsController@saleGoodsDetail');
	Route::get('/user/buyGoods','GoodsController@buyGoods');
	Route::get('/user/confirmGoods','GoodsController@confirmGoods');
	Route::post('/user/rightGoods','GoodsController@rightGoods');
	Route::post('/user/commentGoods','GoodsController@commentGoods');
	Route::post('/user/cashPayGoods','GoodsController@cashPayGoods');
	Route::get('/user/ThirdCashGoodsPay','GoodsController@ThirdCashGoodsPay');
	Route::get('/user/getComment','GoodsController@getComment');

	//文章
	Route::get('/article/getArticle','ArticleController@getArticle');
	Route::get('/article/getArticleCategory','ArticleController@getCategory');//种类
	Route::post('/article/addArticle','ArticleController@addArticle');//写文章
	Route::post('/article/getADs','ArticleController@getADs');//广告
	Route::post('/article/articleThumbsUp','ArticleController@articleThumbsUp');//文章点赞
	Route::post('/article/campusRecruitment','ArticleController@campusRecruitment');//招聘列表



	Route::post('/article/addComment','ArticleController@addComment');//发布文章评论
	Route::post('/article/commentThumbsUp','ArticleCOntroller@commentThumbsUp');//文章评论点赞

    //我的钱包
    Route::get('/fincial/myPurse','PurseController@myPurse');
    Route::post('/fincial/stiffLog','PurseController@stiffLog');
    Route::get('/fincial/withdrawals','PurseController@getWithdrawal');//提现
    Route::post('/fincial/withdrawals','PurseController@postWithdrawal');//提现

	//资讯
	Route::post('/activeCenter','ArticleController@activeCenter');
	Route::post('/article/articleTypeList','ArticleController@articleTypeList');

	//设置首页功能顺序系列
	Route::post('/function/get','FunctionController@getList');//获取功能列表
	Route::post('/function/order','FunctionController@setUserFunction');//用户设置功能排序

	//收货地址
	Route::post('/address/add','AddressController@add');//增
	Route::post('/address/delete','AddressController@delete');//删
	Route::post('/address/update','AddressController@update');//改
	Route::get('/address/detail','AddressController@detail');//查
	Route::get('/address/list','AddressController@list');//列表
	Route::post('/address/set','AddressController@setDefault');//设置默认地址
	Route::post('/address/getDefault','AddressController@getDefault');//获取用户默认地址
    Route::post('/address/allDistrictInfo','AddressController@allDistrictInfo');//获取全部地址信息
    Route::get('/address/getSchoolInfo','AddressController@getSchoolInfo');//获取学校信息

	//足迹
	Route::get('/browes/add','BrowesController@add');//增
	Route::get('/browes/delete','BrowesController@delete');//删（逻辑）
	Route::get('/browes/list','BrowesController@list');//列表

	//礼品
	Route::post('/gift/exchange','GiftController@giftExchange');//兑换码兑换
	Route::get('/gift/exchangeRecord','GiftController@exchangeRecord');//兑换列表

	//邮寄
	Route::post('/mail/apply','GiftController@applyForMail');//申请邮寄
	Route::post('/mail/applyList','GiftController@applyList');//申请列表

	Route::post('/upload','TaskController@upload');//图片上传

	//累计签到赢好礼
	Route::get('/sign/normal','SignController@sign');//签到
	Route::post('/sign/patch','SignController@signPatch');//补签
	Route::get('/sign/record','SignController@signRecord');//签到记录
	Route::post('/sign/prize','SignController@signPrize');//当前签到活动礼品

	//偶发事件
	Route::post('/contigency/check','ContigencyController@check');//检查任务发布量或者任务完成量是否达到触发条件
	Route::get('/contigency/openBox','ContigencyController@openBox');//触发宝箱

	//系统任务
	Route::post('/systask/getOption','SystemTaskController@getOption');//获取系统任务选项
	Route::post('/systask/userSelect','SystemTaskController@userSelect');//获取任务
	Route::post('/systask/userSystemTasks','SystemTaskController@userSystemTasks');//系统任务列表
	Route::post('/systask/changeFee','SystemTaskController@changeFee');//判断用户换一换费用
	Route::post('/systask/changePay','SystemTaskController@changePay');//换一换支付
	Route::post('/systask/recive','SystemTaskController@recive');//领取奖励

	// Route::post('/rodeFee/ifGet','SystemTaskController@ifGetFeeTask');//判断用户是否领取路费任务
	// Route::post('/rodeFee/getTask','SystemTaskController@getRodeFeeTask');//领取路费任务
	// Route::post('/rodeFee/getInfo','SystemTaskController@rodeFeeTaskInfo');//获取路费任务信息
	// Route::post('/rodeFee/getReward','SystemTaskController@getRodeFee');//领取路费任务奖励
	// Route::post('/rodeFee/userPromoteNum','SystemTaskController@userPromoteNum');//领取路费任务奖励

	//用户发送新春祝福
	Route::post('/addAnnouncement','AnnouncementController@addAnnouncement');
	Route::post('/addAnnouncement/displayMiddleOfTask','AnnouncementController@displayMiddleOfTask');//首页展示动态

	Route::post('/makeData','AnnouncementController@makeData');
	Route::post('/getAnnounceList','AnnouncementController@postAnnounceList');


	//二手交易
    Route::get('/transactionList','SecondhandTransactionController@getTransactionList');//列表
    Route::post('/transactionDetail','SecondhandTransactionController@postTransactionDetail');//详情
    Route::get('/transaction','SecondhandTransactionController@getTransactionCreate');//获取物品类型
    Route::post('/transactionClose','SecondhandTransactionController@postTransactionClose');//关闭交易
    Route::post('/userComment','SecondhandTransactionController@postUserComment');//评论
    Route::post('/userCommentReply','SecondhandTransactionController@postUserCommentReply');//评论
    Route::post('/userCommentMore','SecondhandTransactionController@postUserCommentMore');//查看更多评论




});

Route::group(['prefix' => 'api', 'middleware' => ['web.autho','game.log']], function () {

	//比赛
	Route::post('/game/userGameInfoCreate','GameController@userGameInfoCreate')->name('report_game');
	Route::post('/game/singleVSReport','GameController@singleVSReport');
	Route::post('/game/createTeam','GameController@createTeam')->name('createTeam');//创建战队
	Route::post('/game/teamList','GameController@teamList');//战队列表
	Route::post('/game/quitTeam','GameController@quitTeam');//退出战队
	Route::post('/game/teamInfo','GameController@teamInfo');//战队信息
	Route::post('/game/delGroup','GameController@delGroup');//删除队员
	Route::post('/game/joinInTeam','GameController@joinInTeam');//申请加入战队
	Route::post('/game/userGameInfoByMobile','GameController@userGameInfoByMobile');//获取游戏信息
	Route::post('/game/inviteByCaptain','GameController@inviteByCaptain');//邀请队员
	Route::post('/game/inviteInfoList','GameController@inviteInfoList');//游客被邀请列表
	Route::post('/game/captainAgreeApply','GameController@captainAgreeApply');//队长同意
	Route::post('/game/playerAgree','GameController@playerAgree');//游客接受邀请
	Route::post('/game/teamReport','GameController@teamReport')->name('teamReport');//团队报名
	Route::post('/game/drawLotsList','GameController@drawLotsLists');//抽签列表
	Route::post('/game/drawLots','GameController@drawLots');//抽签

	Route::post('/game/groupInitialize','GameController@gameGroupInitialize');//分组初始化

	//----------------------------领取邀请好友累积送好礼  与  系统任务（历练不同时进行）-----------------------------
	Route::post('/cumulative/getList','SystemTaskController@getTheTask');//获取累计邀请任务及列表
	Route::post('/cumulative/getReward','SystemTaskController@getTaskReward');//领取累计任务奖励
	Route::post('/cumulative/getTaskRewardSpecial','SystemTaskController@getTaskRewardSpecial');//领取累计任务额外奖励
	Route::post('/rodeFee/ifGet','SystemTaskController@ifGetFeeTask');//判断用户是否领取路费任务
	Route::post('/rodeFee/getTask','SystemTaskController@getRodeFeeTask');//领取路费任务
	Route::post('/rodeFee/getInfo','SystemTaskController@rodeFeeTaskInfo');//获取路费任务信息
	Route::post('/rodeFee/getReward','SystemTaskController@getRodeFee');//领取路费任务奖励
	Route::post('/rodeFee/userPromoteNum','SystemTaskController@userPromoteNum');//领取路费任务奖励

	//测试(用完删除)
	Route::post('/rodeFee/initialize','SystemTaskController@initialize');//初始化
	Route::post('/rodeFee/addPormo','SystemTaskController@addPormo');//添加邀请人数
	Route::post('/rodeFee/delAllFromGame','SystemTaskController@delAllFromGame');//删除记录
	Route::post('/game/testCreateGroup','GameController@testCreateGroup');//抽签
});
//对比app版本
//Route::post('api/check_update','UserController@checkUpdate');
Route::get('api/function','UserController@functionImg');

Route::get('api/picone','UserController@one');
Route::post('api/pictwo','UserController@two');


/*Route::any('api/alipay/notify','PayNotifyController@alipayNotify');
Route::get('api/wechatpay/notify', 'PayNotifyController@wechatpayNotify');*/

