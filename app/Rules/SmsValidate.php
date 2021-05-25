<?php

namespace App\Rules;

use App\Cache\SmsCache;
use Illuminate\Contracts\Validation\Rule;

class SmsValidate implements Rule
{
    protected $scenes, $mobile;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $scenes, string $mobile)
    {
        $this->scenes = $scenes;
        $this->mobile = $mobile;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $code = SmsCache::getSmsCode($this->scenes, $this->mobile);
        return (int)$code === (int)$value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '短信验证码不正确';
    }
}
