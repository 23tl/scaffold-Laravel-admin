<?php


namespace App\Services;


use App\Exceptions\Banner\BannerNotFundException;
use App\Models\Banner;
use App\Traits\Singleton;

class BannerServices extends BaseServices
{
    use Singleton;

    /**
     * @param  int             $page
     * @param  int             $limit
     * @param  array|string[]  $columns
     * @param  array           $keywords
     * @param  string|string   $order
     *
     * @return mixed
     */
    public function getBannerList(int $page, int $limit, array $columns = ['*'], array $keywords, string $order = 'recent')
    {
        return Banner::query()->where(function ($query) use ($keywords) {
            if (array_key_exists('type', $keywords)) {
                $query->where('type', $keywords['type']);
            }
        })->withOrder($order)->paginate($limit, $columns, 'page', $page);
    }

    /**
     * @param  int  $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     * @throws BannerNotFundException
     */
    public function getBannerById(int $id)
    {
        $banner = Banner::query()->where('id', $id)->first();
        if ( ! $banner) {
            throw new BannerNotFundException();
        }

        return $banner;
    }

    /**
     * @param  array  $params
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function storeBanner(array $params = [])
    {
        return Banner::query()->create($params);
    }

    /**
     * @param  int    $id
     * @param  array  $params
     *
     * @return bool|int
     */
    public function updateBanner(int $id, array $params = [])
    {
        return Banner::query()->where('id', $id)->first()->update($params);
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     */
    public function destroyBanner(int $id)
    {
        return Banner::query()->where('id', $id)->delete();
    }
}
