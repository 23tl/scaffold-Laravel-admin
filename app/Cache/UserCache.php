<?php


namespace App\Cache;


class UserCache extends BaseCache
{
    const USER_TOKEN = 'user_%s';

    /**
     * @param  string         $key
     * @param  string         $value
     * @param  int|float|int  $ttl
     *
     * @return mixed
     */
    public static function setUserToken(string $key, string $value, int $ttl = self::WEEK_TIME)
    {
        return self::set(self::getKey(self::USER_TOKEN, $key), $value, $ttl);
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public static function getUserToken($key)
    {
        $key = self::getKey(self::USER_TOKEN, $key);
        $value = self::get($key);
        parent::expire($key, self::DAY_TIME);
        return $value;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public static function hasUserToken($key)
    {
        return self::exists(self::getKey(self::USER_TOKEN, $key));
    }
}
