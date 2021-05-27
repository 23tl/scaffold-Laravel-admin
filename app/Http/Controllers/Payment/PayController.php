<?php


namespace App\Http\Controllers\Payment;


use App\Http\Requests\Payment\PayPost;
use App\Properties\Parameter\Payment\PayStore;
use Illuminate\Support\Str;
use Yansongda\Pay\Pay;

class PayController extends PaymentController
{
    /**
     * @param  PayPost  $request
     *
     * @return mixed
     */
    public function pay(PayPost $request)
    {
        $gateway = Str::lower($request->input('gateway'));
        $method  = Str::lower($request->input('method'));
        // 自定义参数
        $params  = PayStore::{$gateway}(array_merge($request->all(), []));

        return Pay::{$gateway}(config('pay.' . $method))->{$method}($params);
    }
}
