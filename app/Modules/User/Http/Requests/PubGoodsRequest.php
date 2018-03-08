<?php

namespace App\Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PubGoodsRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'title' => 'required|string|max:50',
            'desc' => 'required|string',
            'first_cate' => 'required|integer',
            'second_cate' => 'required|integer',
            'cash' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '请输入作品标题',
            'title.string' => '请输入正确的格式',
            'title.max' => '标题长度不得超过50个字符',

            'desc.required' => '请输入作品描述',
            'desc.string' => '请输入正确的格式',

            'first_cate.required' => '请选择作品分类',
            'second_cate.required' => '请选择作品分类',

            'cash.required' => '请输入作品金额',
            'cash.numeric' => '错误的金额格式',

        ];
    }

}
