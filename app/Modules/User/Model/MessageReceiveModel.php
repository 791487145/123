<?php

namespace App\Modules\User\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MessageReceiveModel extends Model
{
    
    protected $table = 'message_receive';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id', 'message_title','js_id', 'fs_id','message_content', 'message_type', 'receive_time', 'status', 'read_time','code_name'
    ];

    public $timestamps = false;
}
