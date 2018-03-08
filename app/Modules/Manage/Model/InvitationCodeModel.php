<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;

class InvitationCodeModel extends Model
{
    
    protected $table = 'invitation_code';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','invitation_code','status','add_time'
    ];

    public $timestamps = false;

    //添加邀请码
    static function addInvitationCode($data)
    {
        foreach($data as $k=>$v){
            $newData[$k]['invitation_code'] = $v;
            $newData[$k]['add_time'] = date('Y_m-d H:i:s');

        }
    	$result = Self::insert($newData);
    	return $result;
    }
}
