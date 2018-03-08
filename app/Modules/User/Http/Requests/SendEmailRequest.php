<?php
namespace App\Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
{
	
	public function rules()
	{
		return [
            'email' => 'required|email',
		];
	}

	
	public function authorize()
	{
		return true;
	}

    public function messages()
    {
        return [
            'email.required' => '请填写邮箱',
			'email.email'=>'请填写一个正确的邮箱'
        ];
    }


}
