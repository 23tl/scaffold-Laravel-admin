<?php


namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequests;

class RegisterPost extends ApiRequests
{
    public function rules()
    {
        return [
            'mobile'                => 'required|unique:users,mobile',
            'code'                  => [
                'required',
                function ($attribute, $value, $fail) {
                    if ( ! captcha_api_check($value, $this->input('key'))) {
                        $fail('图形验证码错误');
                    }
                },
            ],
            'key'                   => 'required',
            'password'              => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
            'invite'                => 'nullable|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'mobile.required'                => '请输入账户.',
            'password.required'              => '请输入密码.',
            'mobile.unique'                  => '号码重复，请更换.',
            'password.confirmed'             => '重复密码错误.',
            'password.min'                   => ' 密码长度不能少于6位.',
            'password_confirmation.required' => '请输入重复密码.',
            'invite.exists'                  => '邀请码不存在.',
            'code.required'                  => '请输入图形验证码.',
            'key.required'                   => '图形验证码错误.',
        ];
    }
}