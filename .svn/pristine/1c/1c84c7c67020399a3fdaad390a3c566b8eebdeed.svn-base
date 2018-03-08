<?php
namespace App\Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
	
	public function rules()
	{
		return [
            'username' => 'required|string',
            'password' => 'required|between:3,16|string',
            'code' => 'sometimes|required|alpha_num'
		];
	}

	
	public function authorize()
	{
		return true;
	}

    public function messages()
    {
        return [
            'username.required' => '请输入登录账号',
            'username.string' => '请输入正确的账号格式',
            'password.required' => '请输入登录密码',
			'code.required'=>'请填写正确的验证码'
        ];
    }


}
