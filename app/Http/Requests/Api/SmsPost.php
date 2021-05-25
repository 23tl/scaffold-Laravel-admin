<?php


namespace App\Http\Requests\Api;


class SmsPost extends ApiRequests
{
    public function rules()
    {
        return [
            'mobile' => 'required',
//            'code'                  => [
//                'required',
//                function ($attribute, $value, $fail) {
//                    if ( ! captcha_api_check($value, $this->input('key'))) {
//                        $fail('图形验证码错误');
//                    }
//                },
//            ],
        ];
    }

    public function messages()
    {
        return [
            'mobile.required'                  => '请输入您要发送短信的号码',
            'code.required' => '请输入图形验证码',
        ];
    }
}