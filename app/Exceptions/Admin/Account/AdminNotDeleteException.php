<?php


namespace App\Exceptions\Admin\Account;


use App\Constants\ErrorConstant;
use App\Exceptions\BaseException;

class AdminNotDeleteException extends BaseException
{
    const ERROR = ErrorConstant::ADMIN_USER_NO_DELETE;
}