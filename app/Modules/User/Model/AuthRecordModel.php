<?php

namespace App\Modules\User\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AuthRecordModel extends Model
{
    

    protected $table = 'auth_record';

    protected $fillable = [
        'auth_id', 'uid', 'username', 'auth_code', 'status', 'auth_time'
    ];

    public $timestamps = false;
    
    static function checkUserAuth($uid, $authCode)
    {
        $recordArr = AuthRecordModel::where('uid', $uid)->where('auth_code', $authCode)->get();
        if ($recordArr){
            foreach ($recordArr as $item){
                if ($item->status){
                    return true;
                }
            }
        }
        return false;
    }

    public $transactionData;

    
    public function multiHandle($authId, $authType, $action)
    {
        switch($authType){
            case 'realname':
                $authTable = 'realname_auth';
                break;
            case 'bank':
                $authTable = 'bank_auth';
                break;
            case 'alipay':
                $authTable = 'alipay_auth';
                break;
        }

        switch ($action){
            case 'pass':
                $authStatus = 1;
                break;
            case 'deny':
                $authStatus = 4;
                break;
        }

        $this->transactionData['authId'] = $authId;
        $this->transactionData['authType'] = $authType;
        $this->transactionData['authTable'] = $authTable;
        $this->transactionData['authStatus'] = $authStatus;

        $status = DB::transaction(function () {
            DB::table($this->transactionData['authTable'])
                ->where('id', $this->transactionData['authId'])
                ->update(array('status' => $this->transactionData['authStatus']));
            AuthRecordModel::whereIn('auth_id', $this->transactionData['authId'])
                ->where('auth_code', $this->transactionData['authType'])
                ->update(array('status' => $this->transactionData['authStatus']));
        });

        return is_null($status) ? true : $status;
    }

    
    static function getAuthByUserId($uid)
    {
        
        $userAuth = AuthRecordModel::where('uid', $uid)->where('status', 2)->where('auth_code','!=','realname')->where('auth_code','!=','enterprise')
            ->orWhere(['status' => 1, 'auth_code' => 'realname','uid' => $uid])
            ->orWhere(['status' => 1, 'auth_code' => 'enterprise','uid' => $uid])->get()->toArray();
        if (!empty($userAuth) && is_array($userAuth)) {
            foreach ($userAuth as $k => $v) {
                $authCode[] = $v['auth_code'];
            }
            if (in_array('realname', $authCode)) {
                $realName = true;
            } else {
                $realName = false;
            }
            if (in_array('bank', $authCode)) {
                $bank = true;
            } else {
                $bank = false;
            }
            if (in_array('alipay', $authCode)) {
                $alipay = true;
            } else {
                $alipay = false;
            }
            if (in_array('enterprise', $authCode)) {
                $enterprise = true;
            } else {
                $enterprise = false;
            }
        } else {
            $realName = false;
            $bank = false;
            $alipay = false;
            $enterprise = false;
        }
        $authUser = array(
            'realname' => $realName,
            'bank' => $bank,
            'alipay' => $alipay,
            'enterprise' => $enterprise,
        );
        return $authUser;
    }

}
