<?php

namespace App\Modules\Pay;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OrderModel extends Model
{
    
    protected $table = 'order';

    public $timestamps = false;

    protected $fillable = [
        'code', 'title', 'uid', 'cash', 'status', 'invoice_status', 'note', 'created_at'
    ];

    
    static function randomCode()
    {
        $user = Auth::User();
        $zero = '';
        for ($i = 0; $i < 6; $i++) {
            $zero .= '0';
        }
        return date('YmdHis') . $zero . $user->id;
    }
}

;
