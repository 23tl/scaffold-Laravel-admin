<?php


namespace App\Exceptions\User;

use App\Constants\ErrorConstant;
use App\Exceptions\BaseException;

class UserNotPasswordException extends BaseException
{
    const ERROR =  ErrorConstant::API_USER_PASSWORD;
}