<?php
namespace App\Modules\Task\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}
	
	public function rules()
	{
		$rules = [
				'desc'=>'required|str_length:5000',
		];

		return $rules;
	}
	public function messages()
	{
		return [
				'desc.required' => '稿件描述不能为空',
				'desc.str_length'=> '字数超过限制',
		];
	}
}
