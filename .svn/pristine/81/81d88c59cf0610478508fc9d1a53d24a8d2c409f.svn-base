<?php

namespace App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class ManagerModel extends Model
{
    use EntrustUserTrait;
    
    protected $table = 'manager';

    protected $fillable = [
        'username', 'password', 'salt'
    ];


    
    static function encryptPassword($password, $sign = '')
    {
        return md5(md5($password . $sign));
    }

    
    static function checkPassword($username, $password)
    {
        $user = ManagerModel::where('username', $username)->first();
        if ($user) {
            $password = self::encryptPassword($password, $user->salt);
            if ($user->password == $password) {
                return true;
            }
        }
        return false;
    }

    
    static function managerLogin($manager)
    {
        return Session::put('manager', $manager);
    }

    
    static function getManager()
    {
        return Session::get('manager');
    }
}
