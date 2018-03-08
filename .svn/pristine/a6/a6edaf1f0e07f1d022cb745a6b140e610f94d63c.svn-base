<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class UserTeamModel extends Model
{
    const USER_TEAM_AGREE = 1;//同意
    const USER_TEAM_REFUSE = 2;//拒绝
    const USER_TEAM_APPLY = 3;//等待

    protected $table = 'user_team';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','team_id','to_id','status','form_id'
    ];

    public $timestamps = false;

    //创建角色
    static function createOne($data)
    {
        $data = self::create($data);
        return $data;
    }

    //判断某条件下某角色是否存在
    static function userIsExist($where,$uid)
    {
        $data = self::where($where)->where('uid',$uid)->first();
        return $data;
    }

    //获取状态
    static function getStatusCN($state)
    {
        $stateArray = array(
            self::USER_TEAM_APPLY=> '等待中',
            self::USER_TEAM_REFUSE=> '已拒绝',
            self::USER_TEAM_AGREE=> '已同意',
        );
        return  isset($stateArray[$state]) ? $stateArray[$state] : '';
    }


}
