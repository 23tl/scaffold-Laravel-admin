<?php


namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class Requests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

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
