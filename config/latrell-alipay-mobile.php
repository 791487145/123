<?php
return [

	// 安全检验码，以数字和字母组成的32位字符。
	//'key' => 'wzn723ysa5qotelr2jcau4b7edb1livt',
	'key' => 'q16to2dcaj83pkvpv6r9h8l0fbbiylpl',

	// 签名方式
	'sign_type' => 'RSA',

    // 商户私钥。
    'private_key_path' => storage_path('app/alipay/rsa_private_key.pem'),
    // 阿里公钥。
    'public_key_path' => storage_path('app/alipay/rsa_public_key.pem'),

	// 异步通知连接。
	'notify_url' => 'http://dev.kekezu.net/api/alipay/notify'
];
