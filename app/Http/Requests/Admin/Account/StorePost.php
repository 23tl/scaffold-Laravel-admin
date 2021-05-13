<?php


namespace App\Http\Requests\Admin\Account;


use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Validation\Rule;

class StorePost extends AdminRequest
{
    public function rules()
    {
        return [
            'name'     => 'required|unique:admins,name',
            'password' => 'nullable|min:6',
            'account'  => 'required',
            'roleId'   => 'nullable|exists:roles,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => '请输入您要修改的账户.',
            'name.unique'      => '账户重复，请更换.',
            'account.required' => '请输入您要修改的名称.',
            'roleId.required'  => '请选择您要修改的角色.',
            'roleId.exists'    => '角色不存在.',
            'password.min'     => '密码长度最少为6个字符',
        ];
    }
}