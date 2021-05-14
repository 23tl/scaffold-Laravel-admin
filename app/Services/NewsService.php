<?php


namespace App\Services;

use App\Exceptions\Admin\Category\CategoryNotFundException;
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
     * @param  int             $parentId
     * @param  string|null     $order
     * @param  array|string[]  $columns
     *
     * @return mixed
     */
    public function getSubordinateCategories(int $parentId, string $order = null, array $columns = ['*'])
    {
        return Category::query()->where('parentId', $parentId)->withOrder($order)->get($columns);
    }

    /**
     * @param  int  $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     * @throws CategoryNotFundException
     */
    public function getCategoryById(int $id)
    {
        $category = Category::query()->where('id', $id)->first();
        if (!$category) {
            throw new CategoryNotFundException();
        }
        return $category;
    }

    /**
     * @param  array  $params
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function storeCategory(array $params = [])
    {
        return Category::query()->create($params);
    }

    /**
     * @param  int    $id
     * @param  array  $params
     *
     * @return int
     */
    public function updateCategory(int $id, array $params = [])
    {
        return Category::query()->where('id', $id)->update($params);
    }
}