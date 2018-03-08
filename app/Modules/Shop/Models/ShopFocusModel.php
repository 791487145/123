<?php

namespace App\Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ShopFocusModel extends Model
{
    protected $table = 'shop_focus';

    public $timestamps = false;

    protected $fillable = [
        'id','uid', 'shop_id','created_at'
    ];

    
    static function shopFocusStatus($shopId)
    {
        if(Auth::check()){
            $uid = Auth::id();
            $isFocus = ShopFocusModel::where(['uid' => $uid,'shop_id' =>$shopId])->first();
        }
        else{
            $isFocus = [];
        }
        return $isFocus;
    }


}