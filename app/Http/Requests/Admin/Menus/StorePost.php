<?php


namespace App\Http\Requests\Admin\Menus;


use App\Http\Requests\Admin\AdminRequest;

class StorePost extends AdminRequest
{
    public function rules()
    {
        return [
            'parentId' => 'nullable|exists:menus,id',
            'title'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            'parentId.exists' => '上级菜单不存在.',
            'title.required'  => '请输入菜单名称.',
            'href.required'   => '请输入菜单链接名称.',
            'icon.required'   => '请输入菜单ICON.',
        ];
    }
}