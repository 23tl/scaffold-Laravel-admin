<?php


namespace App\Logic;


use App\Exceptions\Admin\Category\CategoryDeleteException;
use App\Models\Category;
use App\Properties\Parameter\Category\Store;
use App\Properties\Parameter\Category\Update;
use App\Services\CategoryService;

class CategoryLogic extends BaseLogic
{
    /**
     * @param  int|int         $type
     * @param  string   $order
     * @param  array|string[]  $columns
     *
     * @return mixed
     */
    public function getCategories(int $type = 0,  $order = 'recent', array $columns = ['*'])
    {
        return CategoryService::getInstance()->getCategories($type, $order, $columns);
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     */
    public function getCategoryById(int $id)
    {
        return CategoryService::getInstance()->getCategoryById($id);
    }

    /**
     * @param  Store  $params
     *
     * @return mixed
     */
    public function storeCategory(Store $params)
    {
        return CategoryService::getInstance()->storeCategory(
            [
                'name'     => $params->name,
                'type'     => $params->type,
                'image'    => $params->image,
                'sort'     => $params->sort,
                'url'      => $params->url,
                'parentId' => $params->parentId,
            ]
        );
    }

    /**
     * @param  int     $id
     * @param  Update  $params
     *
     * @return mixed
     */
    public function updateCategory(int $id, Update $params)
    {
        return CategoryService::getInstance()->updateCategory(
            $id,
            [
                'name'     => $params->name,
                'image'    => $params->image,
                'sort'     => $params->sort,
                'url'      => $params->url,
                'parentId' => $params->parentId,
            ]
        );
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     * @throws CategoryDeleteException
     */
    public function destroyCategory(int $id)
    {
        $category = CategoryService::getInstance()->getCategoryById($id);
        if ((int)$category->parentId === 0) {
            // 如果是 新闻 则查找新闻该分类下是否有新闻
            if ((int)$category->type === Category::TYPE_NEWS) {

            } elseif ((int)$category->type === Category::TYPE_GOODS) {

            }
        } else {
            if (in_array((int)$category->type, [
                Category::TYPE_NEWS,
                Category::TYPE_GOODS
            ], true)) {
                $categories = CategoryService::getInstance()->getSubordinateCategories($category->id);

                if (count($categories)) {
                    throw new CategoryDeleteException();
                }
            }
        }

        return $category->delete();
    }
}