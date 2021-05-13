<?php

namespace App\Facades\QiNiu;

use Illuminate\Support\Facades\Facade;
use App\Modules\QiNiu\Token;
/**
 * Class Auth
 * @method static uploadToken($bucket, $key = null, $expires = 3600, $policy = null, $strictPolicy = true)
 * @package App\Facades\QiNiu
 */
class Auth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return new Token(config('qiniu.accessKey'), config('qiniu.secretKey'));
    }
}
