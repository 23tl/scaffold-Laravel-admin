<?php


namespace App\Logic;

use App\Services\NewsService;
use Illuminate\Support\Str;

class NewsLogic extends BaseLogic
{
    /**
     * @param  int|int         $page
     * @param  int|int         $limit
     * @param  array           $keywords
     * @param  string          $order
     * @param  array|string[]  $columns
     *
     * @return mixed
     */
    public function getNews(
        int $page = 1,
        int $limit = 15,
        array $keywords = [],
        $order = 'recent',
        array $columns = ['*']
    ) {
        return NewsService::getInstance()->getNewsList($page, $limit, $keywords, $order, $columns);
    }

    public function getNewsById(int $id)
    {
        return NewsService::getInstance()->getNewsById($id);
    }

    /**
     * @param  int          $categoryId
     * @param  string       $name
     * @param  string       $content
     * @param  string|null  $description
     * @param  string|null  $image
     *
     * @return mixed
     */
    public function storeNews(
        int $categoryId,
        string $name,
        string $content,
        string $description = null,
        string $image = null
    ) {
        return NewsService::getInstance()->storeNews(
            [
                'categoryId'  => $categoryId,
                'name'        => $name,
                'content'     => $content,
                'description' => $description,
                'image'       => $image,
            ]
        );
    }

    /**
     * @param  int          $id
     * @param  int          $categoryId
     * @param  string       $name
     * @param  string       $content
     * @param  string|null  $description
     * @param  string|null  $image
     *
     * @return mixed
     */
    public function updateNews(
        int $id,
        int $categoryId,
        string $name,
        string $content,
        string $description = null,
        string $image = null
    ) {
        return NewsService::getInstance()->updateNews($id, [
            'categoryId'  => $categoryId,
            'name'        => $name,
            'content'     => $content,
            'description' => $description,
            'image'       => $image,
        ]);
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     */
    public function destroyNews(int $id)
    {
        return NewsService::getInstance()->destroyNews($id);
    }

}