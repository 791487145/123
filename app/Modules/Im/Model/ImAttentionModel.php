<?php

namespace App\Modules\Im\Model;

use Illuminate\Database\Eloquent\Model;

class ImAttentionModel extends Model
{
    
    protected $table = 'im_attention';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id', 'uid', 'friend_uid'
    ];

    public $timestamps = false;
}
