<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends BaseModel
{
    protected $table = 'tags';

    protected $guarded = ['id'];

    const TYPE_GOODS = 1;

    public static $typeMap = [
        self::TYPE_GOODS => '商品',
    ];
}
