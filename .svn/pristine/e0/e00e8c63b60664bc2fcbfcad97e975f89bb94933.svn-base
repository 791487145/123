<?php

namespace App\Modules\Manage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'title' => 'required|string'
        ];
    }


    public function messages()
    {
        return [
            'title.required' => '请输入名称',
            'title.string' => '请输入字符串'
        ];
    }
}
