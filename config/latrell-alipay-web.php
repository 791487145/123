<?php
return [

	// 安全检验码，以数字和字母组成的32位字符。
	'key' => 'q16to2dcaj83pkvpv6r9h8l0fbbiylpl',

	//签名方式
	'sign_type' => 'RSA',

    // 商户私钥。
    'private_key_path' => storage_path('app/alipay/rsa_private_key.pem'),
    // 阿里公钥。
    'public_key_path' => storage_path('app/alipay/rsa_public_key.pem'),

	// 服务器异步通知页面路径。
	'notify_url' => 'http://www.zfy0351.cn/order/pay/alipay/notify',

	// 页面跳转同步通知页面路径。
	'return_url' => 'http://www.zfy0351.cn/order/pay/alipay/return'
];
