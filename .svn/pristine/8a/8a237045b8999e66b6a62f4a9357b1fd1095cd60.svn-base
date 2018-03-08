<?php

namespace App\Modules\Question\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReqardRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        $rules = [
            'category'=>'required',
            'description'=>'required|str_length:600',
        ];

        return $rules;
    }
    public function messages()
    {
        return [
            'category.required' => '请选择问题类型',
            'description.required' => '描述不能为空',
            'description.str_length' => '描述长度不能超过200个字符',
        ];
    }
}
