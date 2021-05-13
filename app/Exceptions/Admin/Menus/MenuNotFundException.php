<?php


namespace App\Exceptions\Admin\Menus;


use App\Constants\ErrorConstant;
use App\Exceptions\BaseException;

class MenuNotFundException extends BaseException
{
    const ERROR = ErrorConstant::ADMIN_MENU_NOT_FUND;
}