<?php


namespace App\Http\Requests\Admin\User;


use App\Http\Requests\Admin\AdminRequest;
use App\Models\BaseModel;
use Illuminate\Validation\Rule;

class UpdatePost extends AdminRequest



{
    /**
     * @return array
     */
    public function rules()
    {
        switch ($this->input('method')) {
            case 'info':
                return [
                    'id'          => 'required|exists:users,id',
                    'name'       => [
                        'required',
                        Rule::unique('users')->ignore($this->input('id'))
                    ],
                    'mobile' => [
                        'required',
                        Rule::unique('users')->ignore($this->input('id'))
                    ],
                    'status' => [
                        'required',
                        Rule::in([
                            BaseModel::STATUS_ERROR,
                            BaseModel::STATUS_SUCCESS,
                                 ])
                    ],
                    'image' => 'required',
                ];
                break;
            case 'fund':
                return [
                    'currency'          => 'required',
                    'type' => 'required',
                    'group' => 'required',
                    'amount' => 'required',
                ];
                break;
            case 'node':
                return [
                    'id'          => 'required|exists:users,id',
                ];
                break;
            default:
                return [];
        }
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'id.required'          => '请选择您要修改的用户.',
            'id.exists'            => '您修改的用户不存在.',
            'name.required'        => '请输入您要修改的名称.',
            'name.unique'          => '名称重复，请更换.',
            'mobile.required' => '请输入您要修改的联系方式.',
            'mobile.unique'       => '联系方式重复，请更换.',
            'status.required' =>          '请选择状态.',
            'image.required'          => '请上传图片.',
            'currency.required' => '请选择币种.',
            'type.required' => '请选择类型.',
            'group.required' => '请选择操作类型.',
            'amount.required' => '请填写变更金额.',
        ];
    }
}