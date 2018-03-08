<?php

namespace App\Modules\Manage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrivilegesRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'title' => 'required|string',
            'desc' => 'required|string',
            
            'list' => 'required'

        ];
    }

    public function messages()
    {
        return [
            'title.required' => '请输入标题',
            'title.string' => '请输入字符串',
            'desc.required' => '请输入描述',
            'desc.string' => '请输入字符串',
            
            'list.required' => '请输入排序'
        ];
    }
}
