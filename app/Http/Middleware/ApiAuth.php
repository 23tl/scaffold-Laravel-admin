<?php

namespace App\Http\Middleware;

use App\Exceptions\User\UserTokenNotException;
use App\Logic\UserLogic;
use App\Services\UserServices;
use Closure;
use Illuminate\Http\Request;

class ApiAuth
{
    /**
     * @param  Request  $request
     * @param  Closure  $next
     *
     * @return mixed
     * @throws UserTokenNotException
     */
    public function handle(Request $request, Closure $next)
    {
        if ( ! $token = $request->header('Authorization')) {
            if ( ! $token = $request->input('token')) {
                throw new UserTokenNotException();
            }
        }
        if ( ! $userData = (new UserLogic())->decryptToken($token)) {
            throw new UserTokenNotException();
        }
        $user            = UserServices::getInstance()->getUserById($userData['id']);
        app('app')->user = $user;
        $request->setUserResolver(
            function () use ($user) {
                return $user;
            }
        );

        return $next($request);
    }
}
