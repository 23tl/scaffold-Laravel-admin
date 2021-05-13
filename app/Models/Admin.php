<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $dateFormat = 'U';

    protected $table = 'admins';

    const CREATED_AT = 'createdTime';

    const UPDATED_AT = 'updatedTime';

    const DELETED_AT = 'deletedTime';

    protected $casts = [
        'createdTime' => 'datetime:Y-m-d H:i:s',
        'updatedTime' => 'datetime:Y-m-d H:i:s',
        'deletedTime' => 'datetime:Y-m-d H:i:s',
    ];

    protected $hidden = [
        'password',
    ];

    protected $guarded = ['id'];

    /**
     * 该 模型 中 ID 为 1 的用户无法删除
     */
    const ADMIN_ACCOUNT_NO_DELETE = 1;

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

    /**
     * 获取当前登录用户角色
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'roleId');
    }

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = Hash::make($value);
        }
    }
}
