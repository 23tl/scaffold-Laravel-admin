<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class User extends BaseModel
{
    use Notifiable;

    protected $table = 'users';

    protected $guarded = ['id'];

    public static $statusMap = [
        self::STATUS_SUCCESS => '正常',
        self::STATUS_ERROR => '冻结',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo($this, 'parentId', 'id');
    }

    /**
     * @param $value
     */
    public function setAvailableBalanceAttribute($value)
    {
        $this->attributes['availableBalance'] = $value * 100;
    }

    /**
     * @param $value
     *
     * @return float|int
     */
    public function getAvailableBalanceAttribute($value)
    {
        return $value / 100;
    }

    /**
     * @param $value
     */
    public function setElectronicBalanceAttribute($value)
    {
        $this->attributes['electronicBalance'] = $value * 100;
    }

    /**
     * @param $value
     *
     * @return float|int
     */
    public function getElectronicBalanceAttribute($value)
    {
        return $value / 100;
    }

    /**
     * @param $value
     */
    public function setFreezeBalanceAttribute($value)
    {
        $this->attributes['freezeBalance'] = $value * 100;
    }

    /**
     * @param $value
     *
     * @return float|int
     */
    public function getFreezeBalanceAttribute($value)
    {
        return $value / 100;
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeGetUserSuccess($query)
    {
        return $query->where('status', BaseModel::STATUS_SUCCESS);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeGetUserError($query)
    {
        return $query->where('status', BaseModel::STATUS_ERROR);
    }
}
