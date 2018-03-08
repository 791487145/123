<?php

namespace App\Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'title'=>'required',
            'firstCate'=>'required',
            'secondCate'=>'required',
            'desc'=>'required|str_length:5000',
            'cash'=>'required|decimal',
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'请填写标题',
            'firstCate.required'=>'请选择一级分类',
            'secondCate.required'=>'请选择一级分类',
            'desc.required'=>'请填写服务描述',
            'cash.required'=>'请填写服务价格',
            'desc.str_length'=>'字数不能超过500字',
            'cash.decimal'=>'最多保留两位小数',
        ];
    }
}
