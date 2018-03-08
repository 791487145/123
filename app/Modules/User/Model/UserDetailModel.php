<?php

namespace App\Modules\User\Model;

use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Order\Model\OrderModel;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class UserDetailModel extends Model
{
    
    protected $table = 'user_detail';

    protected $fillable = [
        'uid', 'realname', 'avatar', 'mobile', 'card_number', 'province', 'city', 'area', 'address',
        'sign', 'region','school','school_province','system','class', 'native_place','birthday','introduce',
        'autograph','pay_code',  'year_old','safe_code'
    ];

    public function tags()
    {
        return $this->hasMany('App\Modules\User\Model\UserTagsModel', 'uid', 'uid');
    }

    
    static public function findByUid($uid)
    {
        $result = UserDetailModel::where(['uid' => $uid])->first();

        return $result;
    }

    static function getUserAvatar($id)
    {
        $userInfo = UserModel::where('id',$id)->first();
        return $userInfo->avatar;
    }

    
    static function updateData($data, $uid)
    {
        
        UserDetailModel::firstOrCreate(['uid' => $uid]);
        $result = UserDetailModel::where('uid', '=', $uid)->update($data);
        return $result;
    }

    
    static function recharge($uid, $type, array $data)
    {
        $status = DB::transaction(function () use ($uid, $type, $data) {
            
            $result1 = UserDetailModel::where('uid', '=', $uid)->increment('balance', $data['money']);

            if(!empty($data['code']))
                OrderModel::where('code', $data['code'])->update(['status' => 1]);

            
            $financial = [
                'action' => 3,
                'pay_type' => $type,
                'pay_account' => $data['pay_account'],
                'pay_code' => $data['pay_code'],
                'cash' => $data['money'],
                'uid' => $uid,
                'created_at' => date('Y-m-d H:i:s', time()),
            ];
            $result2 = FinancialModel::create($financial);

        });
        return is_null($status) ? true : false;
    }

    
    static function closeTips()
    {
        $user = Auth::User();
        return self::where('uid', $user->id)->update(['alternate_tips' => 1]);
    }

    
    static function getAreaByUserId($uid)
    {
        $pre = UserDetailModel::join('district', 'user_detail.province', '=', 'district.id')
            ->select('district.name')->where('user_detail.uid', $uid)->first();
        $city = UserDetailModel::join('district', 'user_detail.city', '=', 'district.id')
            ->select('district.name')->where('user_detail.uid', $uid)->first();
        $province = $pre ? $pre->name : '';
        $city = $city ? $city->name : '';
        $addr = $province . $city;
        return $addr;
    }

    
    static function employeeData($uid)
    {
        $employee = self::select('user_detail.*', 'ur.name as user_name', 'ur.email_status', 'dp.name as province_name', 'dc.name as city_name')
            ->with('tags')
            ->where('user_detail.uid', $uid)
            ->join('users as ur', 'ur.id', '=', 'user_detail.uid')
            ->leftjoin('district as dp', 'dp.id', '=', 'user_detail.province')
            ->leftjoin('district as dc', 'dc.id', '=', 'user_detail.city')
            ->first()->toArray();
        $tags_id = \CommonClass::getList($employee['tags'], 'tag_id');

        
        if (!empty($tags_id)) {
            $tags = TagsModel::findById($tags_id);
            $employee['tags'] = $tags;
        }

        
        $auth_data = AuthRecordModel::where('uid', $uid)->where('status', 1)->lists('auth_code')->toArray();

        $employee['auth'] = $auth_data;

        
        if ($employee['receive_task_num'] != 0) {
            $employee['good_rate'] = floor($employee['employee_praise_rate'] * 100 / $employee['receive_task_num']);
        } else {
            $employee['good_rate'] = 100;
        }

        return $employee;
    }

    static function employerData($uid)
    {
        $employee = self::select('user_detail.*', 'ur.name as user_name', 'ur.email_status', 'dp.name as province_name', 'dc.name as city_name')
            ->with('tags')
            ->where('user_detail.uid', $uid)
            ->join('users as ur', 'ur.id', '=', 'user_detail.uid')
            ->leftjoin('district as dp', 'dp.id', '=', 'user_detail.province')
            ->leftjoin('district as dc', 'dc.id', '=', 'user_detail.city')
            ->first()->toArray();

        
        $auth_data = AuthRecordModel::where('uid', $uid)->where('status', 1)->lists('auth_code')->toArray();

        $employee['auth'] = $auth_data;

        
        if ($employee['receive_task_num'] != 0) {
            $employee['good_rate'] = floor($employee['employer_praise_rate'] * 100 / $employee['receive_task_num']);
        } else {
            $employee['good_rate'] = 100;
        }

        return $employee;
    }
}
