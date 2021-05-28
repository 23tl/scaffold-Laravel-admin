<?php


namespace App\Services;


use App\Exceptions\User\UserNotFundException;
use App\Models\User;
use App\Traits\Singleton;

class UserServices extends BaseServices
{
    use Singleton;

    public function getUsersList(int $page = 1, int $limit = 15, array $keywords = [], array $columns = ['*'])
    {
        return User::query()->where(
            function ($query) use ($keywords) {
                if (array_key_exists('name', $keywords)) {
                    $query->where('name', 'like', '%'.$keywords['name'].'%');
                }
                if (array_key_exists('mobile', $keywords)) {
                    $query->where('mobile', 'like', '%'.$keywords.'%');
                }
                if (array_key_exists('status', $keywords)) {
                    $query->where('status', $keywords['status']);
                }
            }
        )->with(['parent'])->latest()->paginate($limit, $columns, 'page', $page);
    }

    /**
     * @param  string  $mobile
     *
     * @return mixed
     * @throws UserNotFundException
     */
    public function getUserByMobile(string $mobile)
    {
        $user = User::query()->where('mobile', $mobile)->getUserSuccess()->first();
        if ( ! $user) {
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
        if ( ! $user) {
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
        if ( ! $user) {
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

    /**
     * @param  int    $id
     * @param  array  $params
     *
     * @return bool|int
     */
    public function updateUserInfo(int $id, array $params = [])
    {
        return User::query()->where('id', $id)->first()->update($params);
    }

    /**
     * @param  int     $id
     * @param  string  $method
     * @param  string  $icon
     * @param  int     $amount
     *
     * @return mixed
     */
    public function updateUserFund(int $id, string $method, string $icon, int $amount)
    {
        return User::query()->where('id', $id)->{$method}($icon, $amount);
    }
}