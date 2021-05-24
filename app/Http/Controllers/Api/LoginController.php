<?php


namespace App\Http\Controllers\Api;


use App\Http\Requests\Api\Auth\LoginPost;
use App\Http\Requests\Api\Auth\RegisterPost;
use App\Logic\UserLogic;
use Illuminate\Http\Request;

class LoginController extends ApiController
{
    protected $logic;

    public function __construct(Request $request, UserLogic $logic)
    {
        parent::__construct($request);

        $this->logic = $logic;
    }


    /**
     * 用户登录
     * @param  LoginPost  $requests
     *
     * @return array
     * @throws \App\Exceptions\Api\User\UserNotPasswordException
     */
    public function login(LoginPost $requests)
    {
        $token = $this->logic->login($requests->input('mobile'), $requests->input('password'));

        return [
            'token' => $token
        ];
    }

    /**
     * @param  RegisterPost  $request
     *
     * @return array
     */
    public function register(RegisterPost $request)
    {
        $mobile = $request->input('mobile');
        $password = $request->input('password');
        $invite = $request->input('invite', null);
        $token = $this->logic->storeUser($mobile, $password, $invite);

        return [
            'token' => $token,
        ];
    }
}
