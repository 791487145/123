<?php

return [

    // The default gateway to use
    'default' => 'alipay',

    // Add in each gateway here
    'gateways' => [
        'paypal' => [
            'driver' => 'Alipay_WapExpress',
            'options' => [
                'solutionType' => '',
                'landingPage' => '',
                'headerImageUrl' => ''
            ]
        ],
        'alipay' => [
            'driver' => 'Alipay_WapExpress',
            'options' => [
                'partner' => '2088821557534002',
                'key' => ' 2017112700204494',
                'sellerEmail' => '1324888886@qq.com',
                'returnUrl' => 'http://www.zfy0351.cn/pay/alipay/return',
                'notifyUrl' => 'http://www.zfy0351.cn/pay/alipay/notify',

            ]
        ],
        'Alipay_LegacyWap' => [
            'driver' => 'Alipay_Express',
            'options' => [
                'partner' => '2088821557534002',
                'key' => 'wzn723ysa5qotelr2jcau4b7edb1livt',
                'sellerEmail' => 'pay@kekezu.com',
                'returnUrl' => '',
                'notifyUrl' => ''
            ]
        ],
        'unionpay' => [
            'driver' => 'UnionPay_Express',
            'options' => [
                'merId' => '777290058130430',
                'certPath' => storage_path('app') . '/unionpay/certs/acp_test_sign.pfx',
                'certPassword' => '000000',
                'certDir' => storage_path('app') . '/unionpay/certs',
                'returnUrl' => '',
                'notifyUrl' => ''
            ]
        ],
        'wechat' => [
            'driver' => 'WechatPay_Mweb',
            'options' => [
                'appId' => 'wx48524b88c0578a21',
                'appKey' => '53244ad27617c4379aaca5e1c26985d1',
                'mchId' => '1492548042'
            ]
        ],
        'WechatPay' => [
            'driver' => 'WechatPay_App',
            'options' => [
                'appId' => 'wxab43f78a83a5dd98',
                'apiKey' => 'zgdcVXdP3AO57zEUJCKA7JtfKFX3KF29',
                'mchId' => '1380675202'
            ]
        ],

        'WechatPayH5' => [
            'driver' => 'WechatPay_Mweb',
            'options' => [
                'appId' => 'wxbfdbe6283c6733ed',
                'apiKey' => 'zgdcVXdP3AO57zEUJCKA7JtfKFX3KF29',
                'mchId' => '1406022302'
            ]
        ]
    ]

];