<?php

namespace App\Modules\Install\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckDatabaseRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'site_url' => 'required|url',
            'db_host' => 'required|string',
            'db_name' => 'required|string',
            'db_account' => 'required|string',
            'db_password' => 'required|string',

            'admin_account' => 'required|string',
            'admin_password' => 'required|string',
            'admin_confirm_password' => 'required|same:admin_password',

            'is_data' => 'required'
        ];
    }

}
