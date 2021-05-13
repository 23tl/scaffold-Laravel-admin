<?php


namespace App\Http\Requests\Admin\Roles;


use App\Http\Requests\Admin\AdminRequest;

class StorePost extends AdminRequest
{
    public function rules()
    {
        return [
            'name'        => 'required|unique:roles,name',
            'displayName' => 'required',
            'menus'       => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => '请输入角色标识.',
            'name.unique'          => '角色标识重复，请更换.',
            'displayName.required' => '请输入角色名称.',
            'menus.required'       => '请选择权限节点.',
            'menus.array'          => '请选择权限节点.',
        ];
    }
}
