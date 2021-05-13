<?php


namespace App\Services;

use App\Exceptions\Admin\Roles\RoleNotFundException;
use App\Models\Role;
use App\Traits\Singleton;

class RolesServices extends BaseServices
{
    use Singleton;

    /**
     * 返回所有的角色
     *
     * @param  array|string[]  $columns
     *
     * @return mixed
     */
    public function getRoles(array $columns = ['*'])
    {
        return Role::query()->latest()->get($columns);
    }

    /**
     * 获取角色详情
     *
     * @param  int  $id
     *
     * @return mixed
     * @throws RoleNotFundException
     */
    public function getRoleById(int $id)
    {
        $role = Role::where('id', $id)->first();
        if ( ! $role) {
            throw new RoleNotFundException();
        }

        return $role;
    }

    /**
     * 添加角色
     *
     * @param  array  $params
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function storeRole(array $params = [])
    {
        return Role::query()->create($params);
    }

    /**
     * 修改角色
     *
     * @param  int    $id
     * @param  array  $params
     *
     * @return int
     */
    public function updateRole(int $id, array $params = [])
    {
        return Role::query()->where('id', $id)->update($params);
    }

    /**
     * 删除角色
     *
     * @param  int  $id
     *
     * @return mixed
     */
    public function deleteRoleById(int $id)
    {
        return Role::where('id', $id)->delete();
    }
}
