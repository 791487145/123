<?php
namespace App\Modules\Task\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BountyRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}
	
	public function rules()
	{
		$rules = [
				'pay_canel'=>'required',
		];
		$type_id = $this->only('pay_canel');
		
		if($type_id['pay_canel']==0)
		{
			$rules = array_add($rules, 'password', 'required');
		}else if($type_id['pay_canel']==1)
		{
			$rules = array_add($rules,'pay_type','required');
		}else if($type_id['pay_canel']==2){
			$rules = array_add($rules,'account','required');
		}

		return $rules;
	}
	public function messages()
	{
		return [
				'pay_canel.required' => '请选择一种支付方式！',
				'password.required'=>'请输入您的支付密码，支付密码初始值是登录密码！',
				'pay_type.required'=>'请选择一种第三方支付的方式！',
				'account.required'=>'请选择一个银行卡进行支付，若没有绑定请前往绑定'
		];
	}
}
