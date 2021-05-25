<?php


namespace App\Exceptions\User;

use App\Constants\ErrorConstant;
use App\Exceptions\BaseException;

class UserNotFundException extends BaseException
{
    const ERROR =  ErrorConstant::API_USER_NOT_FUND;
}