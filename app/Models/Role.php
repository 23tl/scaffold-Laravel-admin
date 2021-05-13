<?php

namespace App\Models;

class Role extends BaseModel
{
    protected $table = 'roles';

    protected $guarded = ['id'];

    /**
     * 获取角色所拥有的菜单节点
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'role_menu', 'roleId', 'menuId');
    }
}
