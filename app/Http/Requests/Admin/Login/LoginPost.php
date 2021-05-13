<?php

namespace App\Http\Requests\Admin\Login;

use App\Http\Requests\Admin\AdminRequest;

class LoginPost extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|exists:admins,name',
            'password' => 'required|min:6|max:16',
            'captcha' => 'required|captcha',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'name.request' => '请输入登录账户.',
            'name.exists' => '您输入的登录账户不存在.',
            'password.request' => '请输入登录密码.',
            'password.min' => '请输入的密码长度不正确.',
            'password.max' => '请输入的密码长度不正确.',
            'captcha.request' => '请输入验证码.',
            'captcha.captcha' => '您输入的验证码不正确.'
        ];
    }
}
