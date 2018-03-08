<?php

namespace App\Modules\Manage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VipAuthRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'title' => 'required|string',
            'shop_id' => 'regex:[^[0-9]*[1-9][0-9]*$]',
            'desc' => 'required',
            'list' => 'required'

        ];
    }

    public function messages()
    {
        return [
            'title.required' => '请输入标题',
            'shop_id.regex' => '请选择访谈店铺',
            'title.string' => '请输入字符串',
            'desc.required' => '请输入访谈描述',
            'list.required' => '请输入排序'
        ];
    }
}
