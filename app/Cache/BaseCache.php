<?php


namespace App\Cache;


use Illuminate\Support\Facades\Redis;

class BaseCache extends Redis
{
    const MINUTE_TIME = 60;

    const HOUR_TIME = self::MINUTE_TIME * 60;

    CONST DAY_TIME = self::HOUR_TIME * 24;

    const WEEK_TIME = self::DAY_TIME * 7;

    const MONTH_TIME = self::WEEK_TIME  * 31;

    /**
     * 用于格式化每个 Key 序列
     * @param  string  $str
     * @param  mixed   ...$keys
     *
     * @return string
     */
    public static function getKey(string $str, ...$keys)
    {
        return vsprintf($str, $keys);
    }
}
