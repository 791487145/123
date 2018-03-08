<?php

namespace App\Modules\Employ\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        $time = time();
        return [
            'title'=>'required|strLengthBetween:5,25',
            'desc'=>'required|str_length:5000',
            'phone'=>'required|mobilePhone',
            'bounty'=>'required|price',
            'delivery_deadline'=>"required|deadline:$time"
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空',
            'title.str_length_between'=>'请填写5到25位任意字符!',
            'desc.required' => '请填写任务描述',
            'phone.required'=>'手机号码不能为空',
            'phone.mobile_phone'=>'请填写正确的手机号码',
            'bounty.required' => '项目预算不能为空',
            'bounty.price'=>'请填写数值,最多保留到小数点后两位',
            'delivery_deadline.required'=>'截止时间不能为空',
            'delivery_deadline.deadline'=>'截止时间必须大于今天',
            'desc.str_length'=>'任务描述不能超过5000字'
        ];
    }
}
