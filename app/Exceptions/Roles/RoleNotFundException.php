<?php


namespace App\Exceptions\Roles;


use App\Constants\ErrorConstant;
use App\Exceptions\BaseException;

class RoleNotFundException extends BaseException
{
    const ERROR = ErrorConstant::ADMIN_ROLE_NOT_FUND;
}