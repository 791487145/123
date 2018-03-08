<?php

namespace App\Modules\User\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class AlipayAuthModel extends Model
{
    
    protected $table = 'alipay_auth';

    protected $fillable = [
        'uid', 'username', 'alipay_name', 'alipay_account', 'user_get_cash', 'status', 'auth_time','created_at','updated_at'
    ];

    
    static function getAlipayAuthStatus($id)
    {
        $arrAuthStatus = [
            '1' => '待审核',
            '2' => '认证成功',
            '3' => '认证失败'
        ];

        $info = AlipayAuthModel::where('id', $id)->first();
        return $arrAuthStatus[$info['status']];
    }

    public $transactionData;

    
    static function createAlipayAuth($alipayAuthInfo, $authRecordInfo)
    {
        return DB::transaction(function () use ($alipayAuthInfo, $authRecordInfo) {
            $authRecordInfo['auth_id'] = DB::table('alipay_auth')->insertGetId($alipayAuthInfo);
            DB::table('auth_record')->insert($authRecordInfo);
            return $authRecordInfo['auth_id'];
        });
    }

    
    static function changeAlipayAuth($id, $status)
    {
        $res = DB::transaction(function () use ($id, $status) {
            $user = Auth::User();
            AlipayAuthModel::where('id', $id)->where('uid', $user->id)->update(array('status' => $status));
            AuthRecordModel::where('auth_id', $id)->where('uid', $user->id)->where('auth_code', 'alipay')->update(array('status' => $status));
        });
        return is_null($res) ? true : $res;
    }


    
    static function alipayAuthPass($id)
    {
//        $status = DB::transaction(function () use ($id) {
//            AlipayAuthModel::where('id', $id)->update(array('status' => 2, 'auth_time' => date('Y-m-d H:i:s')));
//            AuthRecordModel::where('auth_id', $id)
//                ->where('auth_code', 'alipay')
//                ->update(array('status' => 2, 'auth_time' => date('Y-m-d H:i:s')));
//        });
//        return is_null($status) ? true : $status;

        $status = AlipayAuthModel::where('id', $id)->update(array('status' => 2, 'auth_time' => date('Y-m-d H:i:s')));
        return $status ? true : false;
    }

    
    static function alipayAuthDeny($id)
    {
//        $status = DB::transaction(function () use ($id) {
//            AlipayAuthModel::where('id', $id)->update(array('status' => 3));
//            AuthRecordModel::where('auth_id', $id)
//                ->where('auth_code', 'alipay')
//                ->update(array('status' => 3));
//        });
//
//        return is_null($status) ? true : $status;
        $status = AlipayAuthModel::where('id', $id)->update(array('status' => 3));
        return $status ? true : false;
    }

    
    public function alipayAuthPay($id)
    {

    }

    
    public function alipayAuthDel($id)
    {
        $this->transactionData['id'] = $id;
        $status = DB::transaction(function () {
            AlipayAuthModel::where('id', $this->transactionData['id'])->delete();
            AuthRecordModel::where('auth_id', $this->transactionData['id'])
                ->where('auth_code', 'alipay')
                ->delete();
        });

        return is_null($status) ? true : $status;
    }
}
