<?php
namespace App\Modules\Manage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NavRequest extends FormRequest
{
	
	public function rules()
	{
		return [
				'title' => 'required|between:2,10|alpha_num',
			    'link_url' => 'required'
		];
	}

	
	public function authorize()
	{
		return true;
	}

	public function messages()
	{
		return [
				'title.required' => '请输入标题',
				'title.between' => '标题为:min - :max位',
				'link_url.required' => '请输入链接'
	    ];
	}
}
