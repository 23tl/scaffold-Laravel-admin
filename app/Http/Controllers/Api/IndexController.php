<?php


namespace App\Http\Controllers\Api;


class IndexController extends ApiController
{
    /**
     * 生成图形验证码
     * @return array
     */
    public function captcha()
    {
        return app('captcha')->create('default', true);
    }
}
