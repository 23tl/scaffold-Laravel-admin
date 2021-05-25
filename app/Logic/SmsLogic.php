<?php


namespace App\Logic;

use App\Cache\SmsCache;
use App\Constants\SmsConstant;
use App\Exceptions\Sms\SmsErrorException;
use App\Exceptions\Sms\SmsExpiredException;
use App\Notifications\SmsNotify;
use App\Services\SmsServices;
use Illuminate\Support\Facades\Notification;

class SmsLogic extends BaseLogic
{
    /**
     * @param  string  $mobile
     *
     * @return array
     */
    public function sendMobileCode(string $mobile)
    {
        $this->validationSmsNumber($mobile, SmsConstant::SMS_CODE_TEMPLATE['scenes'], []);
        $code = $code = str_pad(mt_rand(1000, 9999), 4, '0', STR_PAD_RIGHT);

        if (config('app.env') === 'local') {
            SmsCache::setSmsCache(SmsConstant::SMS_CODE_TEMPLATE['scenes'], $mobile, $code);
            return [
                'code' => $code,
            ];
        }
        Notification::route('sms', $mobile)->notify(
            new SmsNotify(
                [
                    'params'    => [
                        'code' => $code,
                    ],
                    'template' => SmsConstant::SMS_CODE_TEMPLATE['template'],
                    'scenes' => SmsConstant::SMS_CODE_TEMPLATE['scenes']
                ]
            )
        );
        return [];
    }

    /**
     * @param  int     $scenes
     * @param  string  $mobile
     * @param  int     $code
     *
     * @throws SmsErrorException
     * @throws SmsExpiredException
     */
    public function applySmsCode(int $scenes, string $mobile, int $code)
    {
        if (!SmsCache::hasSmsCode($scenes, $mobile)) {
            throw new SmsExpiredException();
        }
        if ($code !== (int)SmsCache::getSmsCode($scenes, $mobile)) {
            throw new SmsErrorException();
        }

        $this->deleteSmsCache($scenes, $mobile);
    }

    /**
     * @param  int     $scenes
     * @param  string  $mobile
     */
    public function deleteSmsCache(int $scenes, string $mobile)
    {
        SmsCache::deleteSmsCache($scenes, $mobile);
    }

    protected function validationSmsNumber(string $mobile, int $scenes, array $datetime = [])
    {
        $count = SmsServices::getInstance()->getSmsMobileCount($mobile, $scenes, $datetime);
    }
}