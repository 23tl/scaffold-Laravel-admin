<?php


namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\Roles\StorePost;
use App\Http\Requests\Admin\Roles\UpdatePost;
use App\Logic\MenusLogic;
use App\Logic\RoleLogic;
use App\Models\Menu;
use Illuminate\Http\Request;

class RolesController extends AdminController
{
    /**
     * @var RoleLogic
     */
    public $logic;

    /**
     * RolesController constructor.
     *
     * @param  Request    $request
     * @param  RoleLogic  $logic
     */
    public function __construct(Request $request, RoleLogic $logic)
    {
        parent::__construct($request);

        $this->logic = $logic;
    }

    /**
     * 管理员列表
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if ($this->request->ajax()) {
            $roles = $this->logic->getRoles(['id', 'name', 'displayName', 'createdTime']);

            return $this->success($roles);
        }

        return view('admin.roles.index');
    }

    /**
     * 创建角色模板
     *
     * @param  MenusLogic  $logic
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(MenusLogic $logic)
    {
        $menus = $logic->getMenusAuthority(['id', 'title']);

        return view('admin.roles.create', compact('menus'));
    }

    /**
     * 编辑角色模板
     *
     * @param  int         $id
     * @param  MenusLogic  $logic
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id, MenusLogic $logic)
    {
        $role      = $this->logic->getRoleById($id);
        $menus     = $logic->getMenusAuthority(['id', 'title']);
        $roleMenus = $this->logic->getRoleMenusIdx($id);

        return view('admin.roles.edit', compact('role', 'roleMenus', 'menus'));
    }

    /**
     * 保存角色
     *
     * @param  StorePost  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePost $request)
    {
        $this->logic->storeRole($request->input('name'), $request->input('displayName'), $request->input('menus', []));

        return $this->success([]);
    }

    /**
     * 编辑角色
     *
     * @param  UpdatePost  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePost $request)
    {
        $this->logic->updateRole(
            $request->input('id'),
            $request->input('name'),
            $request->input('displayName'),
            $request->input('menus', [])
        );

        return $this->success([]);
    }

    /**
     * 删除角色
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy()
    {
        $this->logic->destroyRole($this->request->input('id', 0) ?? 0);

        return $this->success([]);
    }
}
