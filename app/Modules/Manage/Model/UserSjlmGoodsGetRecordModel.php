<?php

namespace App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserSjlmGoodsGetRecordModel extends Model
{
    
    protected $table = 'user_sjlm_goods_get_record';
    protected $primaryKey = 'id';

    //source 1-随机任务  2-礼物兑换  3-签到
    protected $fillable = [
        'id','uid','goods_id','amount','source','created_at','updated_at','sign_record_id','is_valid','kind'
    ];

    public $timestamps = true;


}
