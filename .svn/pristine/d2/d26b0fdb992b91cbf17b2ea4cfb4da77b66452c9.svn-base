<?php

namespace  App\Modules\Manage\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Manage\Model\UserSystemOptionModel;

class UserSystemTaskChangeModel extends Model
{
    
    protected $table = 'user_system_task_change';
    protected $primaryKey = 'id';

    
    protected $fillable = [
        'id','uid','change_num','if_change','today_select_times','created_at','updated_at'
    ];

    public $timestamps = true;

    static function change($uid)
    {
    	$userSystemTaskChange = self::where('uid',$uid)->select('updated_at','change_num')->first();
    	$last_time = substr($userSystemTaskChange['updated_at'],'0','10');
    	$today = date('Y-m-d');
    	if($last_time < $today){
    		//从0开始加1
    		$u_s_t_c_res = self::where('uid',$uid)->update(['change_num'=>'1','today_select_times'=>'0']);
    	}else{
    		//加1
    		$u_s_t_c_res = self::where('uid',$uid)->increment('change_num','1');
    	}
    	if(!$u_s_t_c_res){
    		return array('code'=>'-1','msg'=>'网络错误');
    	}else{
    		//原有选项失效
    		$u_s_o_res = UserSystemOptionModel::where('uid',$uid)->where('status',1)->update(['status'=>'2']);
    		if(!$u_s_o_res) return array('code'=>'-2','msg'=>'网络错误');
    		return array('code'=>'200','msg'=>'success');
    	}
    }

    static function changeFee($time)
    {
    	//前3次免费
    	//4-13次每次收费1元（5）
		//14-23次每次收费2元（15）
		//24-33次每次收费4元（35）
		//34-43次每次收费8元（75）
		//超出43次每次10元
    	$feeArr = array(
    			'4' => '0',
    			'14' => '1',
    			'24' => '2',
    			'34' => '4',
    			'44' => '8',
    		);
    	foreach($feeArr as $key=>$val){
    		if($time < $key){
    			return $val;
    		}
    	}
    	return '10';
    }
}
