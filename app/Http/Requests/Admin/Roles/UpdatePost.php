<?php


namespace App\Http\Requests\Admin\Roles;


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
            'id'          => 'required|exists:roles,id',
            'name'        => [
                'required',
                Rule::unique('roles')->ignore($this->id),
            ],
            'displayName' => 'required',
            'menus'       => 'required|array',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'id.required'          => '请选择您要修改的角色.',
            'id.exists'            => '您修改的角色不存在.',
            'name.required'        => '请输入您要修改的角色标识.',
            'name.unique'          => '角色标识重复，请更换.',
            'displayName.required' => '请输入您要修改的角色名称.',
            'menus.required'       => '请选择权限节点.',
            'menus.array'          => '请选择权限节点.',
        ];
    }
}