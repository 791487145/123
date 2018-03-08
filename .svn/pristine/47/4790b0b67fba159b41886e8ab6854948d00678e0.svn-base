<?php
namespace App\Modules\Finance\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayRequest extends FormRequest
{
	
	public function rules()
	{
		return [
			'cash' => 'required|numeric',
            'pay_type' => 'required'
		];
	}

	
	public function authorize()
	{
		return true;
	}


    public function messages()
    {
        return [
            'cash.required' => '请输入充值金额',
            'cash.numeric' => '请输入正确的格式',

            'pay_type.required' => '请选择支付方式'
        ];
    }
}
