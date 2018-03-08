<?php
namespace App\Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankAuthRequest extends FormRequest
{
	
	public function rules()
	{
		return [
            'depositName' => 'required|string|between:4,20',
            'bankname' => 'required|string|between:4,20',
            'province' => 'required|numeric',
            'bankAccount' => 'required|alpha_num',
            'confirmBankAccount' => 'required|same:bankAccount'
		];
	}

	
	public function authorize()
	{
		return true;
	}

    public function messages()
    {
        return [
            'depositName.required' => '请输入开户行名称',
            'depositName.between' => '开户行名称长度在 :min - :max 位',
            'bankname.required' => '请选择开户银行',
            'province.required' => '请选择开户地区',
            'bankAccount.required' => '请输入银行卡号',
            'confirmBankAccount.required' => '请输入确认银行卡号',
            'confirmBankAccount.same' => '确认银行卡号与银行卡号不一致'
        ];
    }
}
