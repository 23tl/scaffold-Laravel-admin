<?php


namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequests;

class LoginPost extends ApiRequests
{
    public function rules()
    {
        return [
            'mobile' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'mobile.required'     => '请输入账户.',
            'password.required'   => '请输入密码.'
        ];
    }
}