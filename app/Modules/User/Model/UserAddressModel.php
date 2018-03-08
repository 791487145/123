<?php

namespace App\Modules\User\Model;

use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Order\Model\OrderModel;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class UserAddressModel extends Model
{
    const STATUS_USE = 1;//可用
    const STATUS_NO_USE = 2;//不可用，删除
    protected $table = 'user_address';

    protected $fillable = [
        'name','phone','province'.'city','area','address','uid','is_default','status'
    ];

    static function amountByUid($uid)
    {
        $number = self::where('u_id')->whereStatus(self::STATUS_USE)->count();
        return $number;
    }
}
