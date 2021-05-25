<?php


namespace App\Exceptions\Category;


use App\Constants\ErrorConstant;
use App\Exceptions\BaseException;

class CategoryDeleteException extends BaseException
{
    const ERROR = ErrorConstant::ADMIN_CATEGORY_DELETE_SUBJECT;
}