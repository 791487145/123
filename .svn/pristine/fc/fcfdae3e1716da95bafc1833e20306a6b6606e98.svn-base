<?php

namespace App\Modules\User\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class BankAuthModel extends Model
{
    
    protected $table = 'bank_auth';

    protected $fillable = [
        'uid', 'username', 'realname', 'bank_name', 'bank_account', 'deposit_area', 'deposit_name', 'pay_to_user_cash',
        'user_get_cash', 'status', 'auth_time'
    ];

    
    static function getBankAuthStatus($id)
    {
        $arrAuthStatus = [
            '0' => '待审核',
            '1' => '已打款待验证',
            '2' => '认证成功',
            '3' => '认证失败'
        ];

        $info = BankAuthModel::where('id', $id)->first();
        return $arrAuthStatus[$info['status']];
    }

    
    static function findByUid($id)
    {
        $query = Self::where('uid','=',$id);
        $data = $query->where(function($query){
            $query->where('status','=',4);
        })->get();

        return $data;
    }


    public $transactionData;

    
    static function createBankAuth($bankAuthInfo, $authRecordInfo)
    {

        return DB::transaction(function () use ($bankAuthInfo, $authRecordInfo) {
            $authRecordInfo['auth_id'] = DB::table('bank_auth')->insertGetId($bankAuthInfo);
            DB::table('auth_record')->insert($authRecordInfo);
            return $authRecordInfo['auth_id'];
        });
    }

    
    static function changeBankAuth($id, $status)
    {
        $res = DB::transaction(function () use ($id, $status) {
            $user = Auth::User();
            BankAuthModel::where('id', $id)->where('uid', $user->id)->update(array('status' => $status));
            AuthRecordModel::where('auth_id', $id)->where('uid', $user->id)->where('auth_code', 'bank')->update(array('status' => $status));
        });
        return is_null($res) ? true : $res;
    }

    
    static function bankAuthPass($id)
    {
        $status = DB::transaction(function () use ($id) {
            BankAuthModel::where('id', $id)->update(array('status' => 2, 'auth_time' => date('Y-m-d H:i:s')));
            AuthRecordModel::where('auth_id', $id)
                ->where('auth_code', 'bank')
                ->update(array('status' => 2, 'auth_time' => date('Y-m-d H:i:s')));
        });

        return is_null($status) ? true : $status;
    }

    
    static function bankAuthDeny($id)
    {
        $status = DB::transaction(function () use ($id) {
            BankAuthModel::where('id', $id)->update(array('status' => 3));
            AuthRecordModel::where('auth_id', $id)
                ->where('auth_code', 'bank')
                ->update(array('status' => 3));
        });

        return is_null($status) ? true : $status;
    }


    
    public function bankAuthDel($id)
    {
        $this->transactionData['id'] = $id;
        $status = DB::transaction(function () {
            BankAuthModel::where('id', $this->transactionData['id'])->delete();
            AuthRecordModel::where('auth_id', $this->transactionData['id'])
                ->where('auth_code', 'bank')
                ->delete();
        });

        return is_null($status) ? true : $status;
    }

    
    static function getBankname($account)
    {
        $info = BankAuthModel::select('bank_name')->where('bank_account', $account)->first();
        if (!empty($info)){
            return $info->bank_name;
        }

    }

}
