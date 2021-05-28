<?php


namespace App\Logic;


use App\Exceptions\User\UserNotPasswordException;
use App\Exceptions\User\UserTokenNotException;
use App\Facades\Json\Json;
use App\Models\FundLogs;
use App\Services\FundLogsServices;
use App\Services\UserServices;
use App\Cache\UserCache;
use Illuminate\Support\Facades\Hash;

class UserLogic extends BaseLogic
{
    /**
     * @param  int|int         $page
     * @param  int|int         $limit
     * @param  array           $keywords
     * @param  array|string[]  $columns
     *
     * @return mixed
     */
    public function getUsersList(int $page = 1, int $limit = 15, array $keywords = [], array $columns = ['*'])
    {
        return UserServices::getInstance()->getUsersList($page, $limit, $keywords, $columns);
    }

    /**
     * @param  string  $mobile
     *
     * @return mixed
     */
    public function getUserByMobile(string $mobile)
    {
        return UserServices::getInstance()->getUserByMobile($mobile);
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     */
    public function getUserById(int $id)
    {
        return UserServices::getInstance()->getUserById($id);
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
        $user = UserServices::getInstance()->storeUser(
            [
                'name'     => $mobile,
                'mobile'   => $mobile,
                'password' => Hash::make($password),
                'parentId' => optional($inviteUser)->id ?? 0,
            ]
        );

        if ($inviteUser) {
            $user->path = $inviteUser->path . ',' . $user->id;
        }
        $user->invite = enCode($user->id);
        $user->save();

        return $this->applyToken($user->id, $user->name, $user->mobile);
    }

    /**
     * @param  int          $id
     * @param  string       $name
     * @param  string       $mobile
     * @param  int          $status
     * @param  string       $image
     * @param  string|null  $password
     *
     * @return mixed
     */
    public function updateUserInfo(
        int $id,
        string $name,
        string $mobile,
        int $status,
        string $image,
        string $password = null
    ) {
        $params = [
            'name'   => $name,
            'mobile' => $mobile,
            'status' => $status,
            'avatar'  => $image,
        ];

        if ($password) {
            $params = array_merge(
                $params,
                [
                    'password' => Hash::make($password),
                ]
            );
        }

        return UserServices::getInstance()->updateUserInfo($id, $params);
    }

    /**
     * @param  int  $id
     * @param  int  $currency
     * @param  int  $type
     * @param  int  $group
     * @param  int  $amount
     *
     * @return bool
     */
    public function updateUserFund(int $id, int $currency, int $type, int $group, int $amount)
    {
        $method = 'increment';  // 增加
        if ($type === FundLogs::TYPE_LESS) {
            $method = 'decrement';
        }
        $icon = 'availableBalance';
        if ($currency === FundLogs::FUND_TYPE_ENECTRONIC) {
            $icon = 'electronicBalance';
        } elseif ($currency === FundLogs::FUND_TYPE_INTERNAL) {
            $icon = 'integral';
        } elseif ($currency === FundLogs::FUND_TYPE_FREEZE) {
            $icon = 'freezeBalance';
        }

        UserServices::getInstance()->updateUserFund($id, $method, $icon, ($amount * 100));

        FundLogsServices::getInstance()->storeFundLog($id, $currency, $type, $group, $amount);
        return true;
    }

    public function updateUserNode()
    {

    }

    /**
     * 用户登录返回TOKEN
     *
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
     *
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
     *
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
