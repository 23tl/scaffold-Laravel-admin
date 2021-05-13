<?php


namespace App\Properties\Parameter\Account;


use App\Properties\Parameter\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Store
{
    public $name, $account, $mobile, $password, $roleId;

    public function __construct(string $name, string $account, string $password, int $roleId = 0, string $mobile = null)
    {
        $this->name     = $name;
        $this->account  = $account;
        $this->password = $password;
        $this->roleId   = $roleId;
        $this->mobile   = $mobile;
    }
}