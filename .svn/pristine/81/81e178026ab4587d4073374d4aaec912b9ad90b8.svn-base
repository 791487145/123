<?php
namespace App\Modules\Manage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgreementRequest extends FormRequest
{
	
	public function rules()
	{
		return [
				'name' => 'required|between:2,10|alpha_num',
			    'code_name' => 'required',
				'content' => 'required'
		];
	}

	
	public function authorize()
	{
		return true;
	}

	public function messages()
	{
		return [
				'name.required' => '请输入协议名称',
				'name.between' => '协议名称为:min - :max位',
				'code_name.required' => '请输入协议名称代号',
				'content.required' => '请输入协议内容'
	    ];
	}
}
