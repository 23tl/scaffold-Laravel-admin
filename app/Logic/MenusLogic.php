<?php


namespace App\Logic;


use App\Exceptions\Menus\MenuDeleteException;
use App\Services\MenusServices;

class MenusLogic extends BaseLogic
{
    /**
     * 返回角色页所需的节点格式
     *
     * @param  array|string[]  $columns
     *
     * @return mixed
     */
    public function getMenusAuthority(array $columns = ['*'])
    {
        return MenusServices::getInstance()->getMenusAuthority($columns);
    }

    /**
     * @param  int|int         $parentId
     * @param  array|string[]  $columns
     *
     * @return mixed
     */
    public function getOneMenus(int $parentId = 0, array $columns = ['*'])
    {
        return MenusServices::getInstance()->getParentMenus($parentId, $columns);
    }

    /**
     *
     * @param  array|string[]  $columns
     *
     * @return array
     */
    public function getMenus(array $columns = ['*'])
    {
        $menus = $this->getMenusAuthority($columns);
        $data  = [];
        foreach ($menus as $key => $value) {
            $data[$key]['id']          = $value->id;
            $data[$key]['title']       = $value->title;
            $data[$key]['createdTime'] = $value->createdTime->toDateTimeString();
            $data[$key]['parentId']    = $value->pId;
            $data[$key]['href']        = $value->href;
        }

        return $data;
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     */
    public function getMenuById(int $id)
    {
        return MenusServices::getInstance()->getMenuById($id);
    }

    /**
     * @param  string       $title
     * @param  int|int      $parentId
     * @param  string|null  $href
     * @param  string|null  $icon
     *
     * @return mixed
     */
    public function storeMenu(string $title, int $parentId = 0, string $href = null, string $icon = null)
    {
        return MenusServices::getInstance()->storeMenu(
            [
                'title' => $title,
                'pId'   => $parentId,
                'icon'  => $icon,
                'href'  => $href,
            ]
        );
    }

    /**
     * @param  int          $id
     * @param  string       $title
     * @param  int|int      $parentId
     * @param  string|null  $href
     * @param  string|null  $icon
     *
     * @return mixed
     */
    public function updateMenu(int $id, string $title, int $parentId = 0, string $href = null, string $icon = null)
    {
        return MenusServices::getInstance()->updateMenu(
            $id,
            [
                'title' => $title,
                'pId'   => $parentId,
                'icon'  => $icon,
                'href'  => $href,
            ]
        );
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     * @throws MenuDeleteException
     */
    public function destroyMenu(int $id)
    {
        $menus = MenusServices::getInstance()->getParentMenus($id, ['id']);

        if (count($menus)) {
            throw new MenuDeleteException();
        }
        return MenusServices::getInstance()->destroyMenu($id);
    }
}