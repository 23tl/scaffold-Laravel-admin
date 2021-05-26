<?php


namespace App\Exceptions\Banner;


use App\Constants\ErrorConstant;
use App\Exceptions\BaseException;

class BannerNotFundException extends BaseException
{
    const ERROR = ErrorConstant::ADMIN_BANNER_NOT_FUND;
}