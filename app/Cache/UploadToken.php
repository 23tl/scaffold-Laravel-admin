<?php


namespace App\Cache;

use App\Facades\QiNiu\Auth;

class UploadToken extends BaseCache
{
    const UPLOAD_TOKEN = 'upload_token';

    /**
     * @return mixed
     */
    public static function getUploadToken()
    {
        if (!self::hasUploadToken()) {
            self::setUploadToken(Auth::uploadToken(config('qiniu.bucket')));
        }

        return self::get(self::getKey(self::UPLOAD_TOKEN));
    }

    /**
     * 判断缓存是否存在
     * @return mixed
     */
    protected static function hasUploadToken()
    {
        return self::exists(self::getKey(self::UPLOAD_TOKEN));
    }

    /**
     * @param  string   $token
     * @param  int|int  $ttl
     *
     * @return mixed
     */
    public static function setUploadToken(string $token, int $ttl = 3600)
    {
        return self::set(self::getKey(self::UPLOAD_TOKEN), $token, $ttl);
    }
}
