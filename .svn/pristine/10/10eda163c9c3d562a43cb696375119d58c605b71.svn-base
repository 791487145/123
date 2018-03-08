<?php
namespace App\Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserTagsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'tag_name'=>'required',
        ];
    }

    
    public function messages()
    {
        return [
            'tag_name.required'=>'请填写标签',
        ];
    }
}
