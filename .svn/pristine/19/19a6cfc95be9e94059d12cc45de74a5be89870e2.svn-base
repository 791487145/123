<?php
namespace App\Modules\Manage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
	
	public function rules()
	{
		return [
				'title' => 'required|between:3,100',
			    'displayOrder' => 'required',
				'author' => 'required',
		];
	}

	
	public function authorize()
	{
		return true;
	}

	public function messages()
	{
		return [
				'title.required' => '请输入文章标题',
				'title.between' => '文章标题为:min - :max位',
				'displayOrder.required' => '请输入排序',
				'author.required' => '请输入作者',
		];
	}
}
