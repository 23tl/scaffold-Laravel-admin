<?php


namespace App\Services;


use App\Models\FundLogs;
use App\Traits\Singleton;

class FundLogsServices extends BaseServices
{
    use Singleton;

    /**
     * @param  int|int         $page
     * @param  int|int         $limit
     * @param  array           $keywords
     * @param  array|string[]  $columns
     *
     * @return mixed
     */
    public function getFundLogsList(int $page = 1, int $limit = 15, array $keywords = [], array $columns = ['*'])
    {
        return FundLogs::where(function ($query) use ($keywords) {
            if (array_key_exists('userName', $keywords)) {
                $query->whereHas('user', function ($query) use ($keywords) {
                    $query->where('name', 'like', '%'.$keywords['userName'].'%');
                });
            }
            if (array_key_exists('currency', $keywords)) {
                $query->where('currency', $keywords['currency']);
            }
            if (array_key_exists('type', $keywords)) {
                $query->where('type', $keywords['type']);
            }
            if (array_key_exists('group', $keywords)) {
                $query->where('group', $keywords['group']);
            }
        })->with(['user'])->latest()->paginate($limit, $columns, 'page', $page);
    }

    /**
     * @param  int       $userId
     * @param  int       $currency
     * @param  int       $type
     * @param  int       $group
     * @param  int       $amount
     * @param  int|null  $releaseTime
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function storeFundLog(int $userId, int $currency, int $type, int $group, int $amount, int $releaseTime = null)
    {
        return FundLogs::query()->create([
            'userId' => $userId,
            'currency' => $currency,
            'type' => $type,
            'group' => $group,
            'amount' => $amount,
            'releaseTime' => $releaseTime,
                                         ]);
    }
}