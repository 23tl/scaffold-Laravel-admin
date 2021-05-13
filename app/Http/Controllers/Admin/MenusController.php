<?php


namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Menus\StorePost;
use App\Http\Requests\Admin\Menus\UpdatePost;
use App\Logic\MenusLogic;
use Illuminate\Http\Request;

class MenusController extends AdminController
{
    protected $logic;

    public function __construct(Request $request, MenusLogic $logic)
    {
        parent::__construct($request);

        $this->logic = $logic;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if ($this->request->ajax()) {
            $menus = $this->logic->getMenus(['id', 'title', 'pId', 'href', 'createdTime']);

            return $this->success($menus);
        }

        return view('admin.menus.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $menus = $this->logic->getOneMenus(0, ['id', 'title']);

        return view('admin.menus.create', compact('menus'));
    }

    /**
     * @param  int  $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $menu = $this->logic->getMenuById($id);
        $menus = $this->logic->getOneMenus(0, ['id', 'title']);

        return view('admin.menus.edit', compact('menu', 'menus'));
    }

    /**
     * @param  StorePost  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePost $request)
    {
        $this->logic->storeMenu(
            $request->input('title'),
            $request->input('parentId', 0),
            $request->input('href', null),
            'fa '.$request->input('icon', null)
        );

        return $this->success([]);
    }

    /**
     * @param  UpdatePost  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePost $request)
    {
        $this->logic->updateMenu(
            $request->input('id'),
            $request->input('title'),
            $request->input('parentId', 0),
            $request->input('href', null),
            $request->input('icon', null)
        );

        return $this->success([]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\Admin\Menus\MenuDeleteException
     */
    public function destroy()
    {
        $this->logic->destroyMenu($this->request->input('id'));

        return $this->success([]);
    }
}