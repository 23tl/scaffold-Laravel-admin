<?php

namespace App\Models;



class Goods extends BaseModel
{
    protected $table = 'goods';

    protected $guarded = ['id'];

    public static $switchMap = [
        self::STATUS_SUCCESS => '开启',
        self::STATUS_ERROR => '关闭',
    ];

    const TYPE_GOODS = 1;
    const TYPE_SIGN = 2;
}
