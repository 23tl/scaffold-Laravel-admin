<?php


namespace App\Exceptions\Sms;


use App\Constants\ErrorConstant;
use App\Exceptions\BaseException;

class SmsErrorException extends BaseException
{
    const ERROR = ErrorConstant::API_SMS_ERROR;
}