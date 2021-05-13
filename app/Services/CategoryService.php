<?php


namespace App\Services;


use App\Exceptions\Admin\Category\CategoryNotFundException;
use App\Models\Category;
use App\Traits\Singleton;

class CategoryService extends BaseServices
{
    use Singleton;

    /**
     * @param  int             $type
     * @param  string|null     $order
     * @param  array|string[]  $columns
     *
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getCategories(int $type, string $order = null, array $columns = ['*'])
    {
        return Category::query()->when($type, function ($query) use ($type) {
            return $query->where('type', $type);
        })->withOrder($order)->get($columns);
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