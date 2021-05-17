<?php


namespace App\Services;

use App\Exceptions\Admin\Menus\MenuNotFundException;
use App\Models\Menu;
use App\Models\Role;
use App\Traits\Singleton;
use Illuminate\Support\Facades\DB;

/**
 * Class MenusServices
 *
 * @package App\Services
 */
class MenusServices extends BaseServices
{
    use Singleton;

    /**
     * 获取当前登录用户的菜单节点
     * @param  Role            $role
     * @param  array|string[]  $columns
     *
     * @return array
     */
    public function getRoleMenus(Role $role, array $columns = ['*'])
    {
        return $role->menus()->get($columns)->toArray();
    }

    /**
     * 获取所有菜单
     * @param  array|string[]  $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getMenusAuthority(array $columns = ['*'])
    {
        return Menu::query()->get($columns);
    }

    /**
     * @param  int|int         $parentId
     * @param  array|string[]  $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getParentMenus(int $parentId = 0, array $columns = ['*'])
    {
        return Menu::query()->where('pId', $parentId)->get($columns);
    }

    /**
     * @param  int  $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     * @throws MenuNotFundException
     */
    public function getMenuById(int $id)
    {
        $menu = Menu::query()->where('id', $id)->first();
        if (!$menu) {
            throw new MenuNotFundException();
        }
        return $menu;
    }

    /**
     * @param  array  $params
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function storeMenu(array $params = [])
    {
        return Menu::query()->create($params);
    }

    /**
     * @param  int    $id
     * @param  array  $params
     *
     * @return int
     */
    public function updateMenu(int $id, array $params = [])
    {
        return Menu::query()->where('id', $id)->update($params);
    }

    /**
     * 删除
     * @param  int  $id
     *
     * @return mixed
     */
    public function destroyMenu(int $id)
    {
        return Menu::query()->where('id', $id)->delete();
    }
}
