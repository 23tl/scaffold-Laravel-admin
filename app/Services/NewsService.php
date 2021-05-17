<?php


namespace App\Services;

use App\Exceptions\Admin\Category\CategoryNotFundException;
use App\Exceptions\Admin\News\NewsNotFundException;
use App\Models\Category;
use App\Models\News;
use App\Traits\Singleton;

class NewsService extends BaseServices
{
    use Singleton;

    /**
     * @param  int|int         $page
     * @param  int|int         $limit
     * @param  array           $keywords
     * @param  string          $order
     * @param  array|string[]  $columns
     *
     * @return mixed
     */
    public function getNewsList(int $page = 1, int $limit = 15, array $keywords = [], $order = 'recent', array $columns = ['*'])
    {
        return News::query()->where(function ($query) use ($keywords) {
            if (array_key_exists('categoryId', $keywords)) {
                $query->where('categoryId', $keywords['categoryId']);
            }
            if (array_key_exists('name', $keywords)) {
                $query->where('name', 'like', '%'.$keywords['name'].'%');
            }
        })->with(['category'])->withOrder($order)->paginate($limit, $columns, 'page', $page);
    }

    /**
     * @param  int  $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     * @throws NewsNotFundException
     */
    public function getNewsById(int $id)
    {
        $news = News::query()->where('id', $id)->first();
        if (!$news) {
            throw new NewsNotFundException();
        }
        return $news;
    }

    /**
     * @param  array  $params
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function storeNews(array $params = [])
    {
        return News::query()->create($params);
    }

    /**
     * @param  int    $id
     * @param  array  $params
     *
     * @return bool|int
     */
    public function updateNews(int $id, array $params = [])
    {
        return News::query()->where('id', $id)->first()->update($params);
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     */
    public function destroyNews(int $id)
    {
        return News::query()->where('id', $id)->delete();
    }
}