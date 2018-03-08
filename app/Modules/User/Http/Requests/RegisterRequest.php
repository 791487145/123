<?php
namespace App\Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
	
	public function rules()
	{
		return [
            'username' => 'required|between:4,15|string|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|between:6,16|string',
            'confirmPassword' => 'required|same:password',
            'agree' => 'required'

		];
	}

	
	public function authorize()
	{
		return true;
	}

    public function messages()
    {
        return [
            'username.required' => '请输入用户名',
            'username.between' => '用户名应该在:min - :max 个字符',
            'username.string' => '用户名格式错误',
            'username.unique' => '用户名已注册',

            'email.required' => '请输入注册邮箱',
            'email.email' => '请输入正确的邮箱格式',
            'email.unique' => '邮箱已注册',

            'password.required' => '请输入注册密码',
            'password.between' => '密码长度在:min - :max 个字符',
            'password.string' => '密码仅允许字母和数字',

            'confirmPassword.required' => '请输入确认密码',
            'confirmPassword.same' => '确认密码与密码不一致',

            'agree.required' => '请先阅读并同意服务条款'


        ];
    }
}
