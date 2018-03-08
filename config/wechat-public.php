<?php

return [
    /**
     * Debug 模式，bool 值：true/false
     *
     * 当值为 false 时，所有的日志都不会记录
     */
    'debug'  => true,

    /**
     * 使用 Laravel 的缓存系统
     */
    'use_laravel_cache' => true,

    /**
     * 账号基本信息，请从微信公众平台/开放平台获取
     */
    'app_id'  => env('WECHAT_APPID', 'wx6e023b7a4ee45709'),         // AppID
    'secret'  => env('WECHAT_SECRET', '2c3b030e535a39ed0d288c548b3d95c0'),     // AppSecret
    'token'   => env('WECHAT_TOKEN', 'kekezu'),          // Token
    'aes_key' => env('WECHAT_AES_KEY', 'S9e9Hyc0xftTLdB72rbWhW7YcyV2QICpvEoN5Pdeve4'),                    // EncodingAESKey

//    'app_id'  => env('WECHAT_APPID', 'wxc0c3ac302974e007'),         // AppID
//    'secret'  => env('WECHAT_SECRET', '9884fabc8af38aaeadde5c9718362903'),     // AppSecret
//    'token'   => env('WECHAT_TOKEN', 'kekezu'),          // Token
//    'aes_key' => env('WECHAT_AES_KEY', 'zEbX9dLenx1wyYxdWAs3xySIJLSFLZ82v8jHl95g7lY'),                    // EncodingAESKey

    /**
     * 日志配置
     *
     * level: 日志级别，可选为：
     *                 debug/info/notice/warning/error/critical/alert/emergency
     * file：日志文件位置(绝对路径!!!)，要求可写权限
     */
    'log' => [
        'level' => env('WECHAT_LOG_LEVEL', 'debug'),
        'file'  => env('WECHAT_LOG_FILE', '/tmp/easywechat.log'),
    ],

    /**
     * OAuth 配置
     *
     * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
     * callback：OAuth授权完成后的回调页地址
     */

     'oauth' => [
         'scopes'   => array_map('trim', explode(',', env('WECHAT_OAUTH_SCOPES', 'snsapi_userinfo'))),
         'callback' => env('WECHAT_OAUTH_CALLBACK', '/examples/oauth_callback.php'),
     ],

    /**
     * 微信支付
     */
    // 'payment' => [
    //     'merchant_id'        => env('WECHAT_PAYMENT_MERCHANT_ID', 'your-mch-id'),
    //     'key'                => env('WECHAT_PAYMENT_KEY', 'key-for-signature'),
    //     'cert_path'          => env('WECHAT_PAYMENT_CERT_PATH', 'path/to/your/cert.pem'), // XXX: 绝对路径！！！！
    //     'key_path'           => env('WECHAT_PAYMENT_KEY_PATH', 'path/to/your/key'),      // XXX: 绝对路径！！！！
    //     // 'device_info'     => env('WECHAT_PAYMENT_DEVICE_INFO', ''),
    //     // 'sub_app_id'      => env('WECHAT_PAYMENT_SUB_APP_ID', ''),
    //     // 'sub_merchant_id' => env('WECHAT_PAYMENT_SUB_MERCHANT_ID', ''),
    //     // ...
    // ],
];