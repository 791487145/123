<?php

namespace App\Modules\User\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\DB;

class UserModel extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    const USER_ACTIVITATE = 2;//激活

    protected $table = 'users';
    public $timestamps = true;
    protected $primaryKey = 'id';

    
    protected $fillable = [
        'name', 'head_img','mobile','password','salt','status','email','email_status','qq_openid','wx_openid','sina_openid','last_login_time','type','promote_code','sign_id','activation_method','last_login_uuid','created_at','updated_at'
    ];

    
    // protected $hidden = ['password', 'remember_token'];

    protected $hidden = ['password'];
    
    static function encryptPassword($password, $sign = '')
    {
        return md5(md5($password . $sign));
    }

    
    static function checkPassword($username, $password)
    {
        $user = UserModel::where('name', $username)
            ->orWhere('email', $username)->orWhere('mobile', $username)->first();

        if ($user) {
            $password = self::encryptPassword($password, $user->salt);
            if ($user->password === $password) {
                return true;
            }
        }
        return false;
    }
    
    static function checkPayPassword($email, $password)
    {
        $user = UserModel::where('email', $email)->first();
        if ($user) {
            $password = self::encryptPassword($password, $user->salt);
            if ($user->alternate_password == $password) {
                return true;
            }
        }
        return false;
    }
    
    static function psChange($data, $userInfo)
    {
        $user = new UserModel;
        $password = UserModel::encryptPassword($data['password'], $userInfo['salt']);
        $result = $user->where(['id'=>$userInfo['id']])->update(['password'=>$password]);

        return $result;
    }

    
    static function payPsUpdate($data, $userInfo)
    {
        $user = new UserModel;
        $password = UserModel::encryptPassword($data['password'], $userInfo['salt']);
        $result = $user->where(['id'=>$userInfo['id']])->update(['alternate_password'=>$password]);

        return $result;
    }

    //手机号查找基本信息
    static function getUserInfoByMobile($mobile)
    {
        $user = UserModel::where('mobile',$mobile)->where('status',self::USER_ACTIVITATE)->first();
        return $user;
    }

    //用户详细信息及认证
    static function userInfo($id)
    {
        $data = self::where('users.status',self::USER_ACTIVITATE)
            ->where('users.id',$id)
            ->leftJoin('user_detail','user_detail.uid','=','users.id')
          /*  ->leftJoin('realname_auth','realname_auth.uid','=','users.id')
            ->where('realname_auth.status',RealnameAuthModel::REAL_NAME_AUTH_SUCCESS)
            ->where('realname_auth.type',RealnameAuthModel::REAL_NAME_AUTH_COMPANY)*/
            ->select('users.id','users.name','users.mobile','user_detail.region','user_detail.area','user_detail.school_province','user_detail.school')
            ->first();
        //dd($data);
        return $data;
    }

    
    static function createUser(array $data)
    {
        
        $salt = \CommonClass::random(4);
        $validationCode = \CommonClass::random(6);
        $date = date('Y-m-d H:i:s');
        $now = time();
        $userArr = array(
            'name' => $data['username'],
            'email' => $data['email'],
            'password' => UserModel::encryptPassword($data['password'], $salt),
            'alternate_password' => UserModel::encryptPassword($data['password'], $salt),
            'salt' => $salt,
            'last_login_time' => $date,
            'overdue_date' => date('Y-m-d H:i:s', $now + 60*60*3),
            'validation_code' => $validationCode,
            'created_at' => $date,
            'updated_at' => $date
        );
        $objUser = new UserModel();
        
        $status = $objUser->initUser($userArr);
        if ($status){
            $emailSendStatus = \MessagesClass::sendActiveEmail($data['email']);
            if (!$emailSendStatus){
                $status = false;
            }
            return $status;
        }
    }

    static function createUserForTest($name,$password,$phone)
    {
        $salt = \CommonClass::random(4);
        $validationCode = \CommonClass::random(6);
        $date = date('Y-m-d H:i:s');
        $now = time();
        $userArr = array(
            'name' => $name,
            'email' => '791487145@qq.com',
            'password' => UserModel::encryptPassword($password, $salt),
            //'alternate_password' => UserModel::encryptPassword($password, $salt),
            'salt' => $salt,
            'last_login_time' => $date,
            'mobile'=>$phone,
            //'overdue_date' => date('Y-m-d H:i:s', $now + 60*60*3),
            'promote_code' => $validationCode,
            'created_at' => $date,
            'updated_at' => $date,
            'status' => self::USER_ACTIVITATE,
            'type' => 1,
        );

        DB::transaction(function() use ($userArr,$salt,$name) {
            $uid = self::insertGetId($userArr);

            $user_detail = [
                'uid' => $uid,
                'sex' => 2,
                'mobile' => 17696041235,
                'area' => 4,
                'region' => 4,
                'school_province' => 25,
                'school' => 88,
                'pay_code' => self::encryptPassword(123456, $salt),
                'safe_code' => self::encryptPassword(123456, $salt),
                'balance_status' => 1
            ];
            UserDetailModel::create($user_detail);

            $user_balance = [
                'balance' => 50000,
                'user_id' => $uid
            ];
            UserBalanceModel::insert($user_balance);

            $user_real_name_auth = [
                'uid' => $uid,
                'username' => $name,
                'card_number' => 411081199403062588,
                'status' => 1
            ];
            RealnameAuthModel::insert($user_real_name_auth);
        });

        return true;


        /*$objUser = new UserModel();

        $status = $objUser->initUser($userArr);*/
       /* if ($status){
            $emailSendStatus = \MessagesClass::sendActiveEmail($data['email']);
            if (!$emailSendStatus){
                $status = false;
            }
            return $status;
        }*/
    }


    
    public function initUser(array $data)
    {
        $status = DB::transaction(function() use ($data){
            $data['uid'] = UserModel::insertGetId($data);
            UserDetailModel::create($data);
            return $data['uid'];
        });
        return $status;

    }

    
    static function getUserName($id)
    {
        $userInfo = UserModel::where('id',$id)->first();
        return $userInfo->name;
    }

    
    public function isAuth($uid)
    {
        $auth = AuthRecordModel::where('uid',$uid)->where('status',4)->first();
        $bankAuth = BankAuthModel::where('uid',$uid)->where('status',4)->first();
        $aliAuth = AlipayAuthModel::where('uid',$uid)->where('status',4)->first();
        $data['auth'] = is_null($auth)?true:false;
        $data['bankAuth'] = is_null($bankAuth)?true:false;
        $data['aliAuth'] = is_null($aliAuth)?true:false;

        return $data;
    }

    
    static function editUser($data)
    {
        $status = DB::transaction(function () use ($data){
            UserModel::where('id', $data['uid'])->update([
                'email' => $data['email'],
                'password' => $data['password'],
                'salt' => $data['salt']
            ]);
            UserDetailModel::where('uid', $data['uid'])->update([
                'realname' => $data['realname'],
                'qq' => $data['qq'],
                'province' => $data['province'],
                'city' => $data['city'],
                'area' => $data['area']
            ]);
        });
        return is_null($status) ? true : false;
    }

    
    static function addUser($data)
    {
        $status = DB::transaction(function () use ($data){
            $data['uid'] = UserModel::insertGetId([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'salt' => $data['salt']
            ]);
            UserDetailModel::create([
                'uid' => $data['uid'],
                'realname' => $data['realname'],
                'qq' => $data['qq'],
                'mobile' => $data['mobile'],
                'province' => $data['province'],
                'city' => $data['city'],
                'area' => $data['area']
            ]);
        });
        return is_null($status) ? true : false;
    }

    
    static function mobileInitUser($data)
    {
        $status = DB::transaction(function() use ($data){
            $sign = str_random(4);
            $userInfo = [
                'name' => $data['username'],
                'mobile' => $data['mobile'],
                'password' => self::encryptPassword($data['password'], $sign),
                'alternate_password' => self::encryptPassword($data['password'], $sign),
                'salt' => $sign,
                'status' => 1,
                'source' => 1
            ];
            $user = UserModel::create($userInfo);
            UserDetailModel::create([
                'uid' => $user->id,
                'mobile' => $user->mobile,
            ]);
            return $user->id;
        });
        return $status;
    }
}
