<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundLogs extends BaseModel
{
    protected $table = 'fund_logs';

    protected $guarded = ['id'];

    const FUND_TYPE_AVAILABLE = 1;
    const FUND_TYPE_ENECTRONIC = 2;
    const FUND_TYPE_FREEZE = 3;
    const FUND_TYPE_INTERNAL = 4;

    public static $fundType = [
        self::FUND_TYPE_AVAILABLE => '可用余额',
        self::FUND_TYPE_ENECTRONIC => '电子币',
        self::FUND_TYPE_FREEZE => '冻结余额',
        self::FUND_TYPE_INTERNAL => '积分',
    ];

    const TYPE_ADD = 1;
    const TYPE_LESS = 2;

    public static $typeMap = [
        self::TYPE_ADD => '增加',
        self::TYPE_LESS => '减少',
    ];

    const GROUP_XSTC = 1;
    const GROUP_XSJT = 2;
    const GROUP_DSFH = 3;
    const GROUP_FWF = 4;
    const GROUP_XFBT = 5;
    const GROUP_GWBT = 6;
    const GROUP_XFJF = 7;
    const GROUP_GXJF = 8;
    const GROUP_GXSY = 9;
    const GROUP_YGSY = 10;
    const GROUP_CZ = 11;
    const GROUP_HTDZ = 12;

    public static $groupMap = [
        self::GROUP_XSTC => '销售提成',
        self::GROUP_XSJT => '销售津贴',
        self::GROUP_DSFH => '董事分红',
        self::GROUP_FWF => '服务费',
        self::GROUP_XFBT => '消费补贴',
        self::GROUP_GWBT => '购物补贴',
        self::GROUP_XFJF => '消费积分',
        self::GROUP_GXJF => '共享积分',
        self::GROUP_GXSY => '共享收益',
        self::GROUP_YGSY => '预估收益',
        self::GROUP_CZ => '充值',
        self::GROUP_HTDZ => '后台调整',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    /**
     * @param $value
     *
     * @return float|int
     */
    public function getAmountAttribute($value)
    {
        return $value / 100;
    }

    /**
     * @param $value
     */
    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = $value * 100;
    }
}
