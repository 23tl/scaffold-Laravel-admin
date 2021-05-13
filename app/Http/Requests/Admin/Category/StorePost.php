<?php


namespace App\Http\Requests\Admin\Category;


use App\Http\Requests\Admin\AdminRequest;
use App\Models\Category;
use Illuminate\Validation\Rule;

class StorePost extends AdminRequest
{
    public function rules()
    {
        return [
            'name'     => 'required',
            'parentId' => 'nullable|exists:categories,parentId',
            'type'      =>  [
                'required',
                Rule::in([
                    Category::TYPE_NEWS,
                    Category::TYPE_GOODS,
                    Category::TYPE_BOTTOM,
                    Category::TYPE_FAST,
                         ])
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => '请输入名称.',
            'parentId.exists'      => '上级分类不存在.',
            'type.required' => '请选择类别.',
            'type.in'  => '类别错误.',
        ];
    }
}