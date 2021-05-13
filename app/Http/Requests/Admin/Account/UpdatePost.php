<?php


namespace App\Http\Requests\Admin\Account;


use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Validation\Rule;

class UpdatePost extends AdminRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'id'       => 'required|exists:admins,id',
            'name'     => [
                'required',
                Rule::unique('admins')->ignore($this->id),
            ],
            'password' => 'nullable|min:6',
            'account'  => 'required',
            'roleId'   => 'nullable|exists:roles,id',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'id.required'      => '请选择您要修改的管理员..',
            'id.exists'        => '您修改的管理员不存在.',
            'name.required'    => '请输入您要修改的账户.',
            'name.unique'      => '账户重复，请更换.',
            'account.required' => '请输入您要修改的名称.',
            'roleId.required'  => '请选择您要修改的角色.',
            'roleId.exists'    => '角色不存在.',
            'password.min'     => '密码长度最少为6个字符',
        ];
    }
}