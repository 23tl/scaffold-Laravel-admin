<?php


namespace App\Http\Controllers\Payment;

use Yansongda\Pay\Pay;

class NotifyController extends PaymentController
{
    public function alipay()
    {
        $alipay = Pay::alipay(config('pay.alipay'));

    }

    public function wechat()
    {
        $wechat = Pay::wechat(config('app.wechat'));
    }
}
