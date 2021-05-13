<?php


namespace App\Http\Controllers\Admin;

use App\Logic\CategoryLogic;
use App\Models\Category;
use App\Services\MenusServices;

class IndexController extends AdminController
{
    public function index()
    {
        return view('admin.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function welcome()
    {
        $fast = (new CategoryLogic())->getCategories(Category::TYPE_FAST, 'sort', ['name', 'image', 'url'])->take(8);

        return view('admin.welcome', compact('fast'));
    }

    /**
     * 获取当前登录用户的操作菜单
     * @return \Illuminate\Http\JsonResponse
     */
    public function nav()
    {
        $menus = MenusServices::getInstance()->getRoleMenus(auth()->user()->role);
        $trees = myTree($menus);

        return response()->json([
            'homeInfo' => [
                'title' => '首页',
                'href' => url('admin/welcome'),
            ],
            'logoInfo' => [
                'title' => config('app.name'),
                'image' => getFile('laiyanxue.png'),
                'href' => url('admin')
            ],
            'menuInfo' => $trees,
                                ]);
    }
}