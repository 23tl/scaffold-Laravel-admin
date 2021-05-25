<?php


namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\SmsPost;
use App\Logic\SmsLogic;

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

    /**
     * @param  SmsPost   $request
     * @param  SmsLogic  $logic
     *
     * @return array
     */
    public function sms(SmsPost $request, SmsLogic $logic)
    {
        return $logic->sendMobileCode($request->input('mobile'));
    }
}
