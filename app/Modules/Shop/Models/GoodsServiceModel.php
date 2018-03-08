<?php

namespace App\Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsServiceModel extends Model
{
    
    protected $table = 'goods_service';

    protected $fillable = [
        'service_id', 'goods_id'
    ];

    public $timestamps = false;
}
