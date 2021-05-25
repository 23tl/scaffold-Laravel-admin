<?php


namespace App\Exceptions\Sms;

use App\Constants\ErrorConstant;
use App\Exceptions\BaseException;

class SmsValidationException extends BaseException
{
    const ERROR = ErrorConstant::API_SMS_SEND_FREQUENCY;
}
