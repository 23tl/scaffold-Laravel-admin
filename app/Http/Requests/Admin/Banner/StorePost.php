<?php


namespace App\Http\Requests\Admin\Banner;


use App\Http\Requests\Admin\AdminRequest;
use App\Models\Banner;
use Illuminate\Validation\Rule;

class StorePost extends AdminRequest
{
    public function rules()
    {
        return [
            'type' => [
                'required',
                Rule::in([
                    Banner::TYPE_INDEX,
                         ])
            ],
            'name'    => 'required',
            'url' => 'required',
            'urlType' => [
                'required',
                Rule::in([
                    Banner::URL_TYPE,
                    Banner::URL_WEB
                         ])
            ],
            'image' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'type.in' => '广告位置不正确.',
            'type.required' => '请选择广告位置.',
            'name.required'  => '请输入广告标题.',
            'url.required'   => '请输入广告链接.',
            'urlType.required'   => '请选择广告链接类型.',
            'urlType.in'   => '请选择广告链接类型.',
            'image.required' => '请上传广告图片.'
        ];
    }
}