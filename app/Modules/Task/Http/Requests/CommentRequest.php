<?php
namespace App\Modules\Task\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}
	
	public function rules()
	{
		$rules = [
				'comment'=>'required',
				'task_id'=>'required',
				'work_id'=>'required',
		];

		return $rules;
	}
	public function messages()
	{
		return [
				'comment.required' => '评论不能为空',
		];
	}
}
