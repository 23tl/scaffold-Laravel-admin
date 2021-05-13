<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => '常规管理',
                'url' => '',
                'pId' => 0,
                'icon' => 'fa fa-address-book',
            ],
            [
                'id' => 2,
                'pId' => 1,
                'name' => '主页',
                'url' => '',
                'icon' => 'fa fa-home',
            ],
            [
                'id' => 3,
                'pId' => 1,
                'name' => '系统',
                'url' => '',
                'icon' => 'fa fa-gears',
            ],
            [
                'id' => 4,
                'pId' => 3,
                'name' => '管理员',
                'url' => 'admin/account',
                'icon' => 'fa fa-circle-o'
            ],
            [
                'id' => 5,
                'pId' => 3,
                'name' => '角色',
                'url' => 'admin/roles',
                'icon' => 'fa fa-circle-o',
            ],
            [
                'id' => 6,
                'pId' => 3,
                'name' => '菜单',
                'url' => 'admin/menus',
                'icon' => 'fa fa-circle-o',
            ],
            [
                'id' => 7,
                'pId' => 3,
                'name' => '快捷入口',
                'url' => 'admin/category?type='.Category::TYPE_FAST,
                'icon' => 'fa fa-circle-o',
            ]
        ];

        $role = Role::create([
            'name' => 'Administrator',
            'displayName' => '超级管理员',
                               ]);

        foreach ($data as $val) {
            $menu = Menu::create([
                'id' => $val['id'],
                'title' => $val['name'],
                'pId' => $val['pId'],
                'href' => $val['url'],
                'icon' => $val['icon']
                         ]);

            DB::table('role_menu')
                ->insert([
                    'roleId' => $role->id,
                    'menuId' => $menu->id,
                         ]);
        }

        Admin::create([
            'name' => 'admin',
            'account' => '超级管理员',
            'password' => Hash::make('admin123'),
            'roleId' => $role->id,
                      ]);
    }
}
