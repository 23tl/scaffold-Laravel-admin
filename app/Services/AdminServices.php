<?php


namespace App\Services;

use App\Exceptions\Account\AdminNotFundException;
use App\Models\Admin;
use App\Traits\Singleton;

class AdminServices extends BaseServices
{
    use Singleton;

    /**
     * 获取所有管理员
     * @param  string|null     $keywords
     * @param  array|string[]  $columns
     *
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAccount(string $keywords = null, array $columns = ['*'])
    {
        return Admin::query()->when($keywords, function ($query) use ($keywords) {
            return $query->where('name', 'like', '%'.$keywords.'%');
        })->latest()->get($columns);
    }

    /**
     * 获取管理员详情
     * @param  int  $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     * @throws AdminNotFundException
     */
    public function getAccountById(int $id)
    {
        $admin = Admin::query()->where('id', $id)->first();
        if (!$admin) {
            throw new AdminNotFundException();
        }
        return $admin;
    }

    /**
     * @param  string  $name
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     * @throws AdminNotFundException
     */
    public function getAccountByName(string $name)
    {
        $admin = Admin::query()->where('name', $name)->first();
        if (!$admin) {
            throw new AdminNotFundException();
        }
        return $admin;
    }

    /**
     * 保存管理员
     * @param  array  $params
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function storeAccount(array $params = [])
    {
        return Admin::query()->create($params);
    }

    /**
     * 修改管理员
     * @param  int    $id
     * @param  array  $params
     *
     * @return int
     */
    public function updateAccount(int $id, array $params = [])
    {
        return Admin::query()->where('id', $id)->first()->update($params);
    }

    /**
     * 批量删除管理员
     * @param  array  $idx
     *
     * @return mixed
     */
    public function deleteAccountByIdx($idx = [])
    {
        return Admin::query()->whereIn('id', $idx)->delete();
    }
}