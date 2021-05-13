<?php


namespace App\Http\Requests\Admin;


use App\Http\Requests\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdminRequest extends Requests
{
    /**
     * 验证钩子 重写 验证错误
     * @param  Validator  $validator
     */
    public function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(
            response()->json(
                [
                    'message' => $validator->errors()->first(),
                ],
                422
            )
        ));
    }
}