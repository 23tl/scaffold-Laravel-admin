<?php


namespace App\Cache;


use Illuminate\Support\Facades\Redis;

class BaseCache extends Redis
{
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