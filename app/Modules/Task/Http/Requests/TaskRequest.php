<?php
namespace App\Modules\Task\Http\Requests;

use App\Modules\Task\Model\TaskTypeModel;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
	public $task_bounty_min_limit,$task_bounty_max_limit;
	public function authorize()
	{
		return true;
	}
	
	public function rules()
	{
		$rules = [
				'phone'=>'required|size:11|mobile_phone',
				'cate_id'=>'required',
				'title'=>'required',
				'description'=>'required|str_length:5000',
				'type_id'=>'required',

		];

		$type_id = $this->only('type_id');
		$taskTypeAlias = 'xuanshang';
		$taskType = TaskTypeModel::find($type_id);
		if(!empty($taskType)){
			$taskTypeAlias = $taskType->toArray()[0]['alias'];
		}
		$begin_at = json_encode($this->only('begin_at'.$taskTypeAlias));
		switch($taskTypeAlias){
			case 'xuanshang':
				$bounty  = json_encode($this->only('bounty'.$taskTypeAlias));
				$this->task_bounty_min_limit = \CommonClass::getConfig('task_bounty_min_limit');
				$this->task_bounty_max_limit = \CommonClass::getConfig('task_bounty_max_limit');
				$rules = array_add($rules, 'bounty'.$taskTypeAlias, "required|bounty_max|bounty_min");
				$rules = array_add($rules, 'worker_num'.$taskTypeAlias, 'required|positive');
				$rules = array_add($rules, 'delivery_deadline'.$taskTypeAlias, "required|delivery_deadline:$bounty,$begin_at");
				$rules = array_add($rules, 'begin_at'.$taskTypeAlias, 'required|beginAt');
				break;
			case 'zhaobiao':
				$rules = array_add($rules, 'delivery_deadline'.$taskTypeAlias, "required|delivery_deadline_bid:$begin_at");
				$rules = array_add($rules, 'begin_at'.$taskTypeAlias, 'required|beginAt');
				break;
			default:
				$bounty  = json_encode($this->only('bounty'.$taskTypeAlias));
				$this->task_bounty_min_limit = \CommonClass::getConfig('task_bounty_min_limit');
				$this->task_bounty_max_limit = \CommonClass::getConfig('task_bounty_max_limit');
				$rules = array_add($rules, 'bounty'.$taskTypeAlias, "required|bounty_max|bounty_min");
				$rules = array_add($rules, 'worker_num'.$taskTypeAlias, 'required|positive');
				$rules = array_add($rules, 'delivery_deadline'.$taskTypeAlias, "required|deliveryDeadline:$bounty,$begin_at");
				$rules = array_add($rules, 'begin_at'.$taskTypeAlias, 'required|beginAt');
				break;
		}
		return $rules;
	}
	public function messages()
	{
		$type_id = $this->only('type_id');
		$taskTypeAlias = 'xuanshang';
		$taskType = TaskTypeModel::find($type_id);
		if(!empty($taskType)){
			$taskTypeAlias = $taskType->toArray()[0]['alias'];
		}
		return [
				'phone.required' => '手机号码不能为空',
				'phone.size'         => '国内的手机号码长度为11位',
				'phone.mobile_phone'=>'请输入一个正确的手机号码',
				'cate_id.required' => '请选择任务类别',
				'bounty'.$taskTypeAlias.'.required' => '请填写赏金',
				'bounty'.$taskTypeAlias.'.numeric'=>'赏金必须是数值',
				'worker_num'.$taskTypeAlias.'.required' => '请填写由几人完成',
				'delivery_deadline'.$taskTypeAlias.'.required' => '请填写截稿时间',
				'title.required' => '请填写标题',
				'description.required'=>'需求详情不能为空',
				'type_id.required'=>'请选择交易模式',
				'begin_at'.$taskTypeAlias.'.required'=>'请填入任务开始时间',
				'bounty'.$taskTypeAlias.'.bounty_max'=>'赏金最大值不能超过'.$this->task_bounty_max_limit,
				'bounty'.$taskTypeAlias.'.bounty_min'=>'赏金最小为'.$this->task_bounty_min_limit,
				'worker_num'.$taskTypeAlias.'.positive'=>'服务商数量必须大于0',
				'description.str_length'=>'字数超过限制',
				'agree.reqiured'=>'请阅读任务发布协议',
				'begin_at'.$taskTypeAlias.'.validateBeginAt'=>'开始时间不能在今天之前',
				'delivery_deadline'.$taskTypeAlias.'.delivery_deadline_bid' => '请输入正确的截止时间',
		];
	}
}
