<?php


namespace App\Exceptions\Admin\News;


use App\Constants\ErrorConstant;
use App\Exceptions\BaseException;

class NewsNotFundException extends BaseException
{
    const ERROR = ErrorConstant::ADMIN_NEWS_NOT_FUND;
}