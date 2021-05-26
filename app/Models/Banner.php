<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends BaseModel
{
    protected $table = 'banners';

    protected $guarded = ['id'];

    const TYPE_INDEX = 1;

    public static $typeMap = [
        self::TYPE_INDEX => '首页',
    ];

    const URL_TYPE = 1;
    const URL_WEB = 2;

    public static $urlTypeMap = [
        self::URL_TYPE => '商品',
        self::URL_WEB => '外链',
    ];
}
