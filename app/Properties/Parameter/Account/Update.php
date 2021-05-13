<?php


namespace App\Properties\Parameter\Account;

use Illuminate\Support\Facades\Hash;

class Update
{
    public $id, $name, $account, $mobile, $password, $roleId;

    public function __construct(
        int $id,
        string $name,
        string $account,
        int $roleId = 0,
        string $mobile = null,
        string $password = null
    ) {
        $this->id       = $id;
        $this->name     = $name;
        $this->account  = $account;
        $this->password = $password;
        $this->roleId   = $roleId;
        $this->mobile   = $mobile;
    }
}
