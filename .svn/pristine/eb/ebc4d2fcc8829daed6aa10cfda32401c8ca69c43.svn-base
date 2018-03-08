<?php

namespace App\Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPhoneRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'mobile' => 'required|string',
            'code' => 'required|string',
            'password' => 'required|string',
            'confirm_password' => 'required|string'
        ];
    }

}
