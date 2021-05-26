<?php


namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequests;

class LoginPost extends ApiRequests
{
    public function rules()
    {
        return [
            'mobile'   => 'required|exists:users,mobile',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'mobile.required'   => '请输入账户.',
            'mobile.exists'     => '账号不存在.',
            'password.required' => '请输入密码.',
        ];
    }
}