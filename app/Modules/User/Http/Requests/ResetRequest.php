<?php
namespace App\Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetRequest extends FormRequest
{
	
	public function rules()
	{
        return [
            'password' => 'required|between:6,15|alpha_num',
            'confirmPassword' => 'required|same:password',

        ];
	}

	
	public function authorize()
	{
		return true;
	}

    public function messages()
    {
        return [
            'password.required' => '请输入注册密码',
            'password.between' => '密码长度在:min - :max 个字符',
            'password.alpha_num' => '密码仅允许字母和数字',

            'confirmPassword.required' => '请输入确认密码',
            'confirmPassword.same' => '确认密码与密码不一致',


        ];
    }
}
