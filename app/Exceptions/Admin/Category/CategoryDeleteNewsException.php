<?php


namespace App\Exceptions\Admin\Category;


use App\Constants\ErrorConstant;
use App\Exceptions\BaseException;

class CategoryDeleteNewsException extends BaseException
{
    const ERROR = ErrorConstant::ADMIN_CATEGORY_DELETE_NEWS;
}