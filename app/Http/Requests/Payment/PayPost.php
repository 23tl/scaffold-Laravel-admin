<?php


namespace App\Http\Requests\Payment;


use App\Http\Requests\Requests;
use Illuminate\Validation\Rule;

class PayPost extends Requests
{
    public function rules()
    {
        return [
            'gateway' => [
                'required',
                Rule::in(
                    [
                        'alipay',
                        'wechat',
                    ]
                ),
            ],
            'method'  => [
                'required',
                Rule::in(
                    [
                        'wap',
                        'app',
                    ]
                ),
            ],
        ];
    }

    public function messages()
    {
        return [
            'gateway.required' => '请选择支付方式.',
            'gateway.in'       => '您选择的支付方式不支持.',
            'method.required'  => '请选择支付方式.',
            'method.in'        => '您选择的支付方式不支持.',
        ];
    }
}