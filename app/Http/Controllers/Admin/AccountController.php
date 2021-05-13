<?php


namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\Account\StorePost;
use App\Http\Requests\Admin\Account\UpdatePost;
use App\Logic\AccountLogic;
use App\Logic\RoleLogic;
use App\Properties\Parameter\Account\Store;
use App\Properties\Parameter\Account\Update;
use Illuminate\Http\Request;

class AccountController extends AdminController
{
    /**
     * @var AccountLogic
     */
    public $logic;

    /**
     * AccountController constructor.
     *
     * @param  Request       $request
     * @param  AccountLogic  $accountLogic
     */
    public function __construct(Request $request, AccountLogic $accountLogic)
    {
        parent::__construct($request);

        $this->logic = $accountLogic;
    }

    /**
     * 管理员列表
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if ($this->request->ajax()) {
            $admin = $this->logic->getAccount();

            return $this->success($admin);
        }

        return view('admin.account.index');
    }

    /**
     * 创建管理员
     *
     * @param  RoleLogic  $logic
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(RoleLogic $logic)
    {
        $roles = $logic->getRoles(['id', 'displayName']);

        return view('admin.account.create', compact('roles'));
    }

    /**
     * 管理员详情
     *
     * @param  int        $id
     * @param  RoleLogic  $logic
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id, RoleLogic $logic)
    {
        $account = $this->logic->getAccountById($id);
        $roles   = $logic->getRoles(['id', 'displayName']);

        return view('admin.account.edit', compact('account', 'roles'));
    }

    /**
     * 保存添加管理员
     *
     * @param  StorePost  $request
     * @param  Store      $params
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePost $request)
    {
        $this->logic->storeAccount(
            new Store(
                $request->input('name'),
                $request->input('account'),
                $request->input('password'),
                $request->input('roleId', 0),
                $request->input('mobile', null)
            )
        );

        return $this->success([]);
    }

    /**
     * 修改管理员资料
     *
     * @param  UpdatePost  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePost $request)
    {
        $this->logic->updateAccount(
            new Update(
                $request->input('id'),
                $request->input('name'),
                $request->input('account'),
                $request->input('roleId', 0) ?? 0,
                $request->input('mobile', null),
                $request->input('password', null)
            )
        );

        return $this->success([]);
    }

    /**
     * 删除管理员
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\Admin\AdminNotDeleteException
     */
    public function destroy()
    {
        $this->logic->accountDestroy($this->request->input('idx', null));

        return $this->success([]);
    }
}
