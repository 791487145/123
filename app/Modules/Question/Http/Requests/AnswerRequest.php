<?php

namespace App\Modules\Question\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        $rules = [
            'desc'=>'required|str_length:3000',
        ];

        return $rules;
    }
    public function messages()
    {
        return [
            'desc.required' => '回答内容不能为空',
            'desc.str_length' => '长度不超过1000个字符',
        ];
    }
}
