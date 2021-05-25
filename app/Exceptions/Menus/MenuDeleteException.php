<?php


namespace App\Exceptions\Menus;


use App\Constants\ErrorConstant;
use App\Exceptions\BaseException;

class MenuDeleteException extends BaseException
{
    const ERROR = ErrorConstant::ADMIN_MENU_DELETE_PARENT;
}