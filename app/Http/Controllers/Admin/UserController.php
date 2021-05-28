<?php


namespace App\Http\Controllers\Admin;


use App\Facades\Json\Json;
use App\Http\Requests\Admin\User\UpdatePost;
use App\Http\Resources\Admin\Users\UsersCollection;
use App\Logic\UserLogic;
use App\Properties\Parameter\User\Update;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends AdminController
{
    protected $logic;

    public function __construct(Request $request, UserLogic $logic)
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
            $keywords = Json::decode($this->request->input('searchParams', Json::encode([])));
            $users    = $this->logic->getUsersList(
                $this->request->input('page', 1),
                $this->request->input('limit', 15),
                $keywords,
                [
                    'id',
                    'name',
                    'invite',
                    'mobile',
                    'parentId',
                    'avatar',
                    'availableBalance',
                    'electronicBalance',
                    'freezeBalance',
                    'status',
                    'createdTime'
                ]
            );

            return $this->success(UsersCollection::collection($users));
        }

        return view('admin.users.index');
    }

    public function edit(int $id)
    {
        $user = $this->logic->getUserById($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * @param  UpdatePost  $request
     *
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function update(UpdatePost $request)
    {
        switch ($request->input('method')) {
            case 'info':
                $this->logic->updateUserInfo(
                    $request->input('id'),
                    $request->input('name'),
                    $request->input('mobile'),
                    $request->input('status'),
                    $request->input('image'),
                    $request->input('password', null)
                );
                break;
            case 'fund':
                $this->logic->updateUserFund(
                    $request->input('id'),
                    $request->input('currency'),
                    $request->input('type'),
                    $request->input('group'),
                    $request->input('amount')
                );
                break;
            case 'node':
                $this->logic->updateUserNode();
                break;
            default:
                return [];
        }

        return $this->success([]);
    }
}