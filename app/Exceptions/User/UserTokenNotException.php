<?php


namespace App\Exceptions\User;

use App\Constants\ErrorConstant;
use App\Exceptions\BaseException;

class UserTokenNotException extends BaseException
{
    const ERROR =  ErrorConstant::API_USER_TOKEN_NOT_FUND;
}