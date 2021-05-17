<?php


namespace App\Http\Requests\Admin\News;


use App\Http\Requests\Admin\AdminRequest;

class StorePost extends AdminRequest
{
    public function rules()
    {
        return [
            'categoryId' => 'required|exists:categories,id',
            'name'    => 'required',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'categoryId.exists' => '新闻分类不存在.',
            'categoryId.required' => '请选择分类.',
            'name.required'  => '请输入标题.',
            'content.required'   => '请输入正文内容.',
        ];
    }
}