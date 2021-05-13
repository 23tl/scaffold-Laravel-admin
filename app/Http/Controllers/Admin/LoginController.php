<?php


namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\Login\LoginPost;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class LoginController extends AdminController
{
    /**
     * 登录模板
     *
     * @return Application|Factory|View
     */
    public function loginShow()
    {
        return view('admin.login');
    }

    /**
     * 管理员登录
     *
     * @param  LoginPost  $requests
     *
     * @return JsonResponse
     */
    public function login(LoginPost $requests)
    {
        $credentials = $requests->only('name', 'password');

        if (Auth::attempt($credentials, $requests->input('loginCheck'))) {
            return response()->json([
                'code' => 0,
                'mag' => '登录成功'
                                    ]);
        }

        return response()->json([
            'code' => 400,
            'msg' => '账号密码错误',
                                ]);

    }

    /**
     * 管理员退出
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function logout()
    {
        Auth::logout();

        return redirect('admin');
    }
}