<?php
namespace App\Modules\Test\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
	
	public function rules()
	{
		return [
			
		];
	}

	
	public function authorize()
	{
		return false;
	}
}
