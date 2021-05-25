<?php


namespace App\Services;


use App\Exceptions\User\UserNotFundException;
use App\Models\SmsLogs;
use App\Models\User;
use App\Traits\Singleton;

class SmsServices extends BaseServices
{
    use Singleton;

    /**
     * 获取某号码发送次数
     * @param  string|null  $mobile
     * @param  int|null     $scenes
     * @param  array        $datetime
     *
     * @return int
     */
    public function getSmsMobileCount(string $mobile = null, int $scenes = null, array $datetime = [])
    {
        $sms = SmsLogs::query();

        $sms->when($mobile, function ($query) use ($mobile) {
            return $query->where('mobile', $mobile);
        })->when($scenes, function ($query) use ($scenes) {
            return $query->where('scenes', $scenes);
        });

        if (count($datetime)) {
            $sms->whereBetween('createdTime', $datetime);
        }

        return $sms->count();
    }

    /**
     * @param  array  $params
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function storeSmsLog(array $params = [])
    {
        return SmsLogs::query()->create($params);
    }
}