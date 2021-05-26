<?php


namespace App\Logic;


use App\Services\BannerServices;

class BannerLogic extends BaseLogic
{
    /**
     * @param  array           $keywords
     * @param  int             $page
     * @param  int             $limit
     * @param  array|string[]  $columns
     * @param  string|string   $order
     *
     * @return mixed
     */
    public function getBannerList( int $page, int $limit, array $columns = ['*'], array $keywords = [], string $order = 'recent')
    {
        return BannerServices::getInstance()->getBannerList($page, $limit, $columns, $keywords, $order);
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     */
    public function getBannerById(int $id)
    {
        return BannerServices::getInstance()->getBannerById($id);
    }

    /**
     * @param  string   $name
     * @param  string   $url
     * @param  int      $type
     * @param  int      $urlType
     * @param  string   $image
     * @param  int|int  $sort
     *
     * @return mixed
     */
    public function storeBanner(string $name, string $url, int $type, int $urlType, string $image, int $sort = 0)
    {
        return BannerServices::getInstance()->storeBanner(
            [
                'name'    => $name,
                'url'     => $url,
                'type'    => $type,
                'urlType' => $urlType,
                'image'   => $image,
                'sort'    => $sort,
            ]
        );
    }

    /**
     * @param  int      $id
     * @param  string   $name
     * @param  string   $url
     * @param  int      $type
     * @param  int      $urlType
     * @param  string   $image
     * @param  int|int  $sort
     *
     * @return mixed
     */
    public function updateBanner(
        int $id,
        string $name,
        string $url,
        int $type,
        int $urlType,
        string $image,
        int $sort = 0
    ) {
        return BannerServices::getInstance()->updateBanner(
            $id,
            [
                'name'    => $name,
                'url'     => $url,
                'type'    => $type,
                'urlType' => $urlType,
                'image'   => $image,
                'sort'    => $sort,
            ]
        );
    }

    public function destroyBanner(int $id)
    {
        return BannerServices::getInstance()->destroyBanner($id);
    }
}