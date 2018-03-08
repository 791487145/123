<?php

namespace App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserSjlmGoodsUseRecordModel extends Model
{
    
    protected $table = 'user_sjlm_goods_use_record';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','uid','goods_id','amount','purpose','created_at','updated_at','address_id','is_free','address_id','address_str','remarks','kind','logistics_company','logistics_number'
    ];

    public $timestamps = true;


}
