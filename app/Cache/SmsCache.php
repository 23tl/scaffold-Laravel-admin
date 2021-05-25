<?php


namespace App\Cache;


class SmsCache extends BaseCache
{
    /**
     * 短信
     * key sms_场景值_手机号码
     */
    const SMS_CODE = 'sms_%s_%s';

    /**
     * 写入短信验证码缓存
     * @param  int     $scenes
     * @param  string  $mobile
     * @param  int     $code
     * @param  int     $ttl
     *
     * @return mixed
     */
    public static function setSmsCache(int $scenes, string $mobile, int $code, int $ttl = sekf::HALF_HOUR_TIME)
    {
        return self::set(self::getKey(self::SMS_CODE, $scenes, $mobile), $code, $ttl);
    }

    /**
     * 获取短信验证码缓存
     * @param  int     $scenes
     * @param  string  $mobile
     *
     * @return mixed
     */
    public static function getSmsCode(int $scenes, string $mobile)
    {
        return self::get(self::getKey(self::SMS_CODE, $scenes, $mobile));
    }

    /**
     * @param  int     $scenes
     * @param  string  $mobile
     *
     * @return mixed
     */
    public static function hasSmsCode(int $scenes, string $mobile)
    {
        return self::exists(self::getKey(self::SMS_CODE, $scenes, $mobile));
    }

    /**
     * @param  int     $scenes
     * @param  string  $mobile
     *
     * @return mixed
     */
    public static function deleteSmsCache(int $scenes, string $mobile)
    {
        return self::del(self::getKey(self::SMS_CODE, $scenes, $mobile));
    }
}