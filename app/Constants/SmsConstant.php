<?php


namespace App\Constants;


class SmsConstant
{
    /**
     *
     */
    const SMS_SEND_HALF_HOUR = 3;

    const SMS_SEND_HOUR_TIME = 6;

    const SMS_SEND_DAY_TIME = 10;

    /**
     * 短信模板
     */
    const SMS_CODE_TEMPLATE = [
        'scenes' => 10001,
        'template' => 'SMS_157980065',
    ];
}
