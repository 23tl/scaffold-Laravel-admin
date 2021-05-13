<?php


namespace App\Logic;


use App\Exceptions\Admin\Account\AdminNotDeleteException;
use App\Models\Admin;
use App\Properties\Parameter\Account\Store;
use App\Properties\Parameter\Account\Update;
use App\Services\AdminServices;

class AccountLogic extends BaseLogic
{
    /**
     * @param  string|null  $keywords
     *
     * @return array
     */
    public function getAccount(string $keywords = null)
    {
        $account = AdminServices::getInstance()->getAccount($keywords);
        $data    = [];
        foreach ($account as $key => $user) {
            $data[$key]['id']          = $user->id;
            $data[$key]['name']        = $user->name;
            $data[$key]['mobile']      = $user->mobile ?? '暂无';
            $data[$key]['account']     = $user->account;
            $data[$key]['createdTime'] = $user->createdTime->toDateTimeString();
            $data[$key]['role']        = optional($user->role)->displayName;
        }

        return $data;
    }

    /**
     * 获取管理员详情
     *
     * @param  int  $id
     *
     * @return mixed
     */
    public function getAccountById(int $id)
    {
        return AdminServices::getInstance()->getAccountById($id);
    }

    /**
     * @param  Store  $params
     *
     * @return mixed
     */
    public function storeAccount(Store $params)
    {
        return AdminServices::getInstance()->storeAccount(
            [
                'name'     => $params->name,
                'account'  => $params->account,
                'mobile'   => $params->mobile,
                'password' => $params->password,
                'roleId'   => $params->roleId,
            ]
        );
    }

    public function updateAccount(Update $params)
    {
        return AdminServices::getInstance()->updateAccount(
            $params->id,
            [
                'name'     => $params->name,
                'account'  => $params->account,
                'mobile'   => $params->mobile,
                'password' => $params->password,
                'roleId'   => $params->roleId,
            ]
        );
    }

    /**
     * 批量删除管理员
     *
     * @param $idx
     *
     * @return mixed
     * @throws AdminNotDeleteException
     */
    public function accountDestroy($idx)
    {
        /**
         * 此处是为了保证 无法删除 最初 的一个管理员，造成无法登陆
         */
        if ( ! is_array($idx)) {
            $idx = [(int)$idx];
        }
        if (in_array(Admin::ADMIN_ACCOUNT_NO_DELETE, $idx, true)) {
            // 该处为批量删除管理员时，如果数组中包含原始管理员，则从数组中删除原始管理员，在进行删除操作
            //$idx = array_diff($idx, [Admin::ADMIN_ACCOUNT_NO_DELETE]);
            throw new AdminNotDeleteException();
        }

        return AdminServices::getInstance()->deleteAccountByIdx($idx);
    }
}