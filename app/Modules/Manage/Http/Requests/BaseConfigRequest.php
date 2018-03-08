<?php
namespace App\Modules\Manage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseConfigRequest extends FormRequest
{
	
	public function rules()
	{
		return [
				'name' => 'required',
				'status'=>'required',
		];
	}

	
	public function authorize()
	{
		return true;
	}

	public function messages()
	{
		return [
				'name.required' => '请输入名称',
				'status.required' => '请选择是否开启',
		];
	}
}
