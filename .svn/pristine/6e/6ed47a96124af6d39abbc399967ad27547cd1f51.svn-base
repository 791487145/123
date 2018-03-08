<?php
namespace App\Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyBankCashRequest extends FormRequest
{
	
	public function rules()
	{
		return [
            'cash' => 'required|numeric',
            'bankAuthId' => 'required|string'
		];
	}

	
	public function authorize()
	{
		return true;
	}

    public function messages()
    {
        return [
            'cash.required' => '请输入打款金额',
            'cash.numeric' => '请输入正确的格式',
        ];
    }
}
