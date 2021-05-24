<?php


namespace App\Services;


use App\Exceptions\Api\User\UserNotFundException;
use App\Models\User;
use App\Traits\Singleton;

class UserServices extends BaseServices
{
    use Singleton;

    /**
     * @param  string  $mobile
     *
     * @return mixed
     * @throws UserNotFundException
     */
    public function getUserByMobile(string $mobile)
    {
        $user = User::query()->where('mobile', $mobile)->getUserSuccess()->first();
        if (!$user) {
            throw new UserNotFundException();
        }
        return $user;
    }

    /**
     * @param  string  $code
     *
     * @return mixed
     * @throws UserNotFundException
     */
    public function getUserByCode(string $code)
    {
        $user = User::query()->where('code', $code)->getUserSuccess()->first();
        if (!$user) {
            throw new UserNotFundException();
        }
        return $user;
    }

    public function getUserByParent()
    {

    }

    /**
     * @param  int  $id
     *
     * @return mixed
     * @throws UserNotFundException
     */
    public function getUserById(int $id)
    {
        $user = User::query()->where('id', $id)->getUserSuccess()->first();
        if (!$user) {
            throw new UserNotFundException();
        }
        return $user;
    }

    /**
     * @param  array  $params
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function storeUser(array $params = [])
    {
        return User::query()->create($params);
    }
}