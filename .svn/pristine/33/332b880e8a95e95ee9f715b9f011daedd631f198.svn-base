<?php

namespace App\Modules\Question\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RewardRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        $rules = [
            'reward'=>'numeric',
            'reward'=>'required',
            'password'=>'required',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'reward.required' => '打赏金额不能为空',
            'password.required' => '密码不能为空',
            'reward.numeric'=>'打赏金额必须是一个数字',
        ];
    }
}
