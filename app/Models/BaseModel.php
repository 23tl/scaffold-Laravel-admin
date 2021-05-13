<?php


namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $dateFormat = 'U';

    const CREATED_AT = 'createdTime';

    const UPDATED_AT = 'updatedTime';

    const DELETED_AT = 'deletedTime';

    protected $casts = [
        'createdTime' => 'datetime:Y-m-d H:i:s',
        'updatedTime' => 'datetime:Y-m-d H:i:s',
        'deletedTime' => 'datetime:Y-m-d H:i:s',
    ];

    protected $guarded = ['id'];

    /**
     * 下面定义用于 业务 使用
     */
    const STATUS_SUCCESS = 1;

    const STATUS_ERROR = 2;

    const STATUS_WAIT = 3;

    /**
     * 为数组 / JSON序列化准备一个日期
     *
     * @param  DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}