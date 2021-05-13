<?php


namespace App\Http\Requests\Admin\Category;


use App\Http\Requests\Admin\AdminRequest;
use App\Models\Category;
use Illuminate\Validation\Rule;

class UpdatePost extends AdminRequest
{
    public function rules()
    {
        return [
            'id'       => 'required|exists:categories,id',
            'name'     => 'required',
            'parentId' => 'nullable|exists:categories,parentId',
            'type'     => [
                'required',
                Rule::in(
                    [
                        Category::TYPE_NEWS,
                        Category::TYPE_GOODS,
                        Category::TYPE_BOTTOM,
                        Category::TYPE_FAST,
                    ]
                ),
            ],
        ];
    }

    public function messages()
    {
        return [
            'id.required'     => '请选择您要修改的分类.',
            'id.exists'       => '分类不存在.',
            'name.required'   => '请输入名称.',
            'parentId.exists' => '上级分类不存在.',
            'type.required'   => '请选择类别.',
            'type.in'         => '类别错误.',
        ];
    }
}