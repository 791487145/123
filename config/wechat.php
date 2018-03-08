<?php
return [
    'use_alias' => env('WECHAT_USE_ALIAS', false),
    'app_id' => env('WECHAT_APPID', 'wx6e023b7a4ee45709'), // 必填
    'secret' => env('WECHAT_SECRET', '2c3b030e535a39ed0d288c548b3d95c0'), // 必填
    'token' => env('WECHAT_TOKEN', 'YourToken'),  // 必填
    'encoding_key' => env('WECHAT_ENCODING_KEY', 'YourEncodingAESKey') //加密模式需要，其它模式不需要
];