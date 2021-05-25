<?php


namespace App\Exceptions\Sms;


use App\Constants\ErrorConstant;
use App\Exceptions\BaseException;

class SmsExpiredException extends BaseException
{
    const ERROR = ErrorConstant::API_SMS_EXPIRED;
}
