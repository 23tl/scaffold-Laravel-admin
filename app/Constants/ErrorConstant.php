<?php


namespace App\Constants;


class ErrorConstant
{
    const PERMISSION_ERROR = [
        'message' => '您无权访问',
        'code' => 403
    ];

    const HTTP_ERROR = [
        404 => '接口不存在'
    ];


    const ADMIN_USER_NO_FUND = [
        'code' => 10001,
        'message' => '管理员不存在',
    ];

    const ADMIN_USER_NO_DELETE = [
        'code' => 10002,
        'message' => '该管理员不允许删除',
    ];

    const ADMIN_ROLE_NOT_FUND = [
        'code' => 10010,
        'message' => '角色不存在',
    ];

    const ADMIN_MENU_NOT_FUND = [
        'code' => 10020,
        'message' => '菜单不存在',
    ];

    const ADMIN_MENU_DELETE_PARENT = [
        'code' => 10021,
        'message' => '该菜单下有下级菜单，请先删除下级菜单'
    ];

    const ADMIN_CATEGORY_NOT_FUND = [
        'code' => 10030,
        'message' => "分类不存在"
    ];

    const ADMIN_CATEGORY_DELETE_SUBJECT =[
        'code' => 10031,
        'message' => '删除前请先删除下级分类'
    ];
}