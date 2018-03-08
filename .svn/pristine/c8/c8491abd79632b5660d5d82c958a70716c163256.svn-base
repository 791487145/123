<?php
namespace App\Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordEmailRequest extends FormRequest
{
	
	public function rules()
	{
        return [
            'email' => 'required|email',
            'code' => 'required|string'
        ];

	}

	
	public function authorize()
	{
		return true;
	}

    public function messages()
    {
        return [
            'email.required' => '请输入邮箱',
            'email.email' => '请输入正确的邮箱格式',
            'code.required' => '请输入验证码'
        ];
    }
}
