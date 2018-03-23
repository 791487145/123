<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class UserActiveSortVoteModel extends Model
{
    protected $table = 'user_active_sort_vote';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','u_a_id','u_g_g_id','sort','competition','type','vote'
    ];

    public $timestamps = false;


    static function createOneSort($param)
    {

       $user_active_sort_vote = self::where('u_a_id',$param['u_a_id'])->where('competition',$param['competition'])->where('type',$param['type'])->first();
        if(is_null($user_active_sort_vote)){
            self::insert($param);
            return true;
        }

        self::where('id',$user_active_sort_vote->id)->increment('sort',2);
        return true;
    }

}
