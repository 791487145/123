<?php

namespace App\Modules\User\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OauthBindModel extends Model
{
    
    protected $table = 'oauth_bind';

    protected $fillable = [
        'oauth_id', 'oauth_nickname', 'oauth_type', 'uid', 'created_at'
    ];

    public $timestamps = false;


    
    static function oauthLoginTransaction($oauthInfo)
    {
        $res = UserModel::where('name', $oauthInfo['oauth_nickname'])->first();
        if (!empty($res)){
            $oauthInfo['oauth_nickname'] = $oauthInfo['oauth_nickname'] . \CommonClass::random(4);
        }

        $status = DB::transaction(function() use ($oauthInfo){
            $salt = \CommonClass::random(4);

            $now = date('Y-m-d H:i:s');
            $userArr = [
                'name' => $oauthInfo['oauth_nickname'],
                'salt' => $salt,
                'password' => UserModel::encryptPassword('123456', $salt),
                'alternate_password' => UserModel::encryptPassword('123456', $salt),
                'last_login_time' => $now,
                'created_at' => $now,
                'updated_at' => $now,
                'status' => 1
            ];
            $uid = UserModel::insertGetId($userArr);
            $oauthInfo['uid'] = $uid;
            $oauthInfo['created_at'] = $now;
            OauthBindModel::create($oauthInfo);
            $userDetail = [
                'uid' => $uid,
                'last_login_time' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ];
            UserDetailModel::create($userDetail);
            return $uid;
        });
        return $status;

    }


}
