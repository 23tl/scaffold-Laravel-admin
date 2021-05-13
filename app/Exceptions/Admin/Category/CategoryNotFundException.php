<?php


namespace App\Exceptions\Admin\Category;


use App\Constants\ErrorConstant;
use App\Exceptions\BaseException;

class CategoryNotFundException extends BaseException
{
    const ERROR = ErrorConstant::ADMIN_CATEGORY_NOT_FUND;
}