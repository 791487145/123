<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class SignPrizeModel extends Model
{
    
    protected $table = 'sign_prize';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','sign_id','date','status','goods_id','amount'
    ];

    public $timestamps = false;

    

    

}
