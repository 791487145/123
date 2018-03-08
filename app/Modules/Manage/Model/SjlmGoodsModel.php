<?php

namespace App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SjlmGoodsModel extends Model
{
    
    protected $table = 'sjlm_goods';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','name','icon','kind','ability','price','gold','sign','status'
    ];

    public $timestamps = false;


}
