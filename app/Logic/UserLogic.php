<?php


namespace App\Logic;


use App\Exceptions\User\UserNotPasswordException;
use App\Exceptions\User\UserTokenNotException;
use App\Facades\Json\Json;
use App\Services\UserServices;
use App\Cache\UserCache;
use Illuminate\Support\Facades\Hash;

class UserLogic extends BaseLogic
{
    public function getUserByMobile(string $mobile)
    {
        return UserServices::getInstance()->getUserByMobile($mobile);
    }

    /**
     * @param  string       $mobile
     * @param  string       $password
     * @param  string|null  $invite
     *
     * @return string
     */
    public function storeUser(string $mobile, string $password, string $invite = null)
    {
        $inviteUser = null;
        if ($invite) {
            $inviteUser = UserServices::getInstance()->getUserByCode($invite);
        }
        $user = UserServices::getInstance()->storeUser([
            'name' => $mobile,
            'mobile' => $mobile,
            'password' => Hash::make($password),
            'parentId' => optional($inviteUser)->id ?? 0,
                                               ]);

        if ($inviteUser) {
            $user->path = $inviteUser->path .','.$user->id;
        }
        $user->invite = enCode($user->id);
        $user->save();

        return $this->applyToken($user->id, $user->name, $user->mobile);
    }


    /**
     * 用户登录返回TOKEN
     * @param  string  $mobile
     * @param  string  $password
     *
     * @return string
     * @throws UserNotPasswordException
     */
    public function login(string $mobile, string $password)
    {
        $user = $this->getUserByMobile($mobile);
        if ( ! Hash::check($password, $user->password)) {
            throw new UserNotPasswordException();
        }

        return $this->applyToken($user->id, $user->name, $user->mobile);
    }

    /**
     * 生成凭证token
     * @param  int     $userId
     * @param  string  $name
     * @param  string  $mobile
     *
     * @return string
     */
    public function applyToken(int $userId, string $name, string $mobile)
    {
        $userData = Json::encode(
            [
                'id'     => $userId,
                'name'   => $name,
                'mobile' => $mobile,
                'date'   => date('Y-m-d H:i:s', time()),
            ]
        );

        $key = md5($userData);

        UserCache::setUserToken($key, $userData, config('auth.password_timeout'));

        return $key;
    }

    /**
     * 解密凭证token
     * @param  string  $key
     *
     * @return mixed
     * @throws UserTokenNotException
     */
    public function decryptToken(string $key)
    {
        if ( ! UserCache::hasUserToken($key)) {
            throw new UserTokenNotException();
        }

        return Json::decode(UserCache::getUserToken($key));
    }
}
