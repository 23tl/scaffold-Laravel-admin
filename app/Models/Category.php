<?php

namespace App\Models;

class Category extends BaseModel
{
    protected $table = 'categories';

    protected $guarded = ['id'];

    const TYPE_NEWS = 1;
    const TYPE_GOODS = 2;
    const TYPE_BOTTOM = 3;
    const TYPE_FAST = 4;

    public static $typeMap = [
        self::TYPE_NEWS => '新闻分类',
        self::TYPE_GOODS => '商品分类',
        self::TYPE_BOTTOM => '底部菜单',
        self::TYPE_FAST => '快捷入口',
    ];
}
