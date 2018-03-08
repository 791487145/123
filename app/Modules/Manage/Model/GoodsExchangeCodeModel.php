<?php

namespace App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GoodsExchangeCodeModel extends Model
{
    
    protected $table = 'goods_exchange_code';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','code','is_valid','amount','created_at','updated_at','code_sign'
    ];

    public $timestamps = true;


}
