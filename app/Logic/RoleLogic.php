<?php


namespace App\Logic;

use App\Services\RolesServices;
use Illuminate\Support\Facades\DB;

class RoleLogic extends BaseLogic
{
    /**
     * 获取所有角色信息
     *
     * @param  array|string[]  $columns
     *
     * @return mixed
     */
    public function getRoles(array $columns = ['*'])
    {
        return RolesServices::getInstance()->getRoles($columns);
    }

    /**
     * 获取某管理员所拥有的节点
     * @param  int  $roleId
     *
     * @return array
     */
    public function getRoleMenusIdx(int $roleId)
    {
        return DB::table('role_menu')
            ->where('roleId', $roleId)
            ->pluck('menuId')
            ->toArray();
    }

    /**
     * 获取角色详情
     *
     * @param  int  $id
     *
     * @return mixed
     */
    public function getRoleById(int $id)
    {
        return RolesServices::getInstance()->getRoleById($id);
    }

    /**
     * 添加角色
     *
     * @param  string  $name
     * @param  string  $displayName
     * @param  array   $menus
     *
     * @return mixed
     */
    public function storeRole(string $name, string $displayName, array $menus = [])
    {
        $role = RolesServices::getInstance()->storeRole(
            [
                'name'        => $name,
                'displayName' => $displayName,
            ]
        );
        foreach ($menus as $menu) {
            DB::table('role_menu')->insert(
                [
                    'roleId' => $role->id,
                    'menuId' => $menu,
                ]
            );
        }

        return $role;
    }

    /**
     * 修改角色
     * @param  int     $id
     * @param  string  $name
     * @param  string  $displayName
     * @param  array   $menus
     *
     * @return mixed
     */
    public function updateRole(int $id, string $name, string $displayName, array $menus = [])
    {
        $role = RolesServices::getInstance()->updateRole(
            $id,
            [
                'name'        => $name,
                'displayName' => $displayName,
            ]
        );
        DB::table('role_menu')
          ->where('roleId', $id)
          ->delete();
        foreach ($menus as $menu) {
            DB::table('role_menu')->insert(
                [
                    'roleId' => $id,
                    'menuId' => $menu,
                ]
            );
        }

        return $role;
    }

    /**
     * 删除角色
     *
     * @param  int  $id
     */
    public function destroyRole(int $id)
    {
        RolesServices::getInstance()->deleteRoleById($id);
        DB::table('role_menu')
          ->where('roleId', $id)
          ->delete();
    }
}