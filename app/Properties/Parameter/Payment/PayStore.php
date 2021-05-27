<?php


namespace App\Properties\Parameter\Payment;

use Illuminate\Support\Str;

class PayStore
{
    /**
     * @var array
     */
    protected $params;

    /**
     * PayStore constructor.
     *
     * @param  array  $params
     */
    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    /**
     * @return array
     */
    protected function wechat()
    {
        return [
            'out_trade_no' => time(),  // 订单号，可供后面查询订单状态使用
            'body' => 'subject-测试',    // 商品名称
            'total_fee' => '1',  // 金额
        ];
    }

    /**
     * @return array
     */
    protected function alipay()
    {
        return [
            'out_trade_no' => time(), // 订单号，可供后面查询订单状态使用
            'total_amount' => '0.01', // 金额
            'subject' => '商品名称', // 商品名称
        ];
    }

    /**
     * @param $method
     *
     * @return mixed
     */
    protected function make($method)
    {
        $gateway = Str::lower($method);
        return $this->{$gateway}();
    }

    /**
     * @param $method
     * @param $params
     *
     * @return mixed
     */
    public static function __callStatic($method, $params)
    {
        $app = new self(...$params);

        return $app->make($method);
    }
}
