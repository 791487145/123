<?php

namespace App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FeedbackModel extends Model
{
    const FEEDBACK_REPLAY_NULL = 1;

    protected $table = 'feedback';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'uid',
        'phone',
        'desc',
        'type',
        'created_time',
        'handle_time',
        'status',
        'replay'
    ];

    public $timestamps = false;

    static function createOne($data)
    {
        $data['status'] = self::FEEDBACK_REPLAY_NULL;
        $data['created_time'] = date('Y-m-d H:i:s');

        $ret = self::insert($data);
        if($ret){
            return true;
        }
        return false;

    }


}
