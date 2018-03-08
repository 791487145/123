<?php
namespace App\Modules\Finance\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashoutRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'cash' => 'required|numeric',
            'cashout_account' => 'required'
        ];
    }

    
    public function authorize()
    {
        return true;
    }


    public function messages()
    {
        return [
            'cash.required' => '请输入提现金额',
            'cash.numeric' => '请输入正确的格式',

            'cashout_account.required' => '请选择提现账户'
        ];
    }
}
