<?php


namespace App\Http\Requests\Admin\News;


use App\Http\Requests\Admin\AdminRequest;

class UpdatePost extends AdminRequest
{
    public function rules()
    {
        return [
            'id'       => 'required|exists:news,id',
            'categoryId' => 'required|exists:categories,id',
            'name'    => 'required',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id.required'     => '请选择您要修改的新闻.',
            'id.exists'       => '新闻不存在.',
            'categoryId.required'   => '请选择新闻分类.',
            'categoryId.exists' => '分类不存在.',
            'name.required'  => '请输入标题.',
            'content.required'   => '请输入正文内容.',
        ];
    }
}