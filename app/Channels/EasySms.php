<?php


namespace App\Channels;

use Illuminate\Notifications\Notification;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;

class EasySms
{
    /**
     * 发送短信
     *
     * @param                $notifiable
     * @param  Notification  $notification
     */
    public function send($notifiable, Notification $notification)
    {
        try {
            if ( ! $mobile = $notifiable->routeNotificationFor('sms')) {
                return;
            }
            $message = $notification->toSms($notifiable);

            $result = app('easySms')->send($mobile, $message);
            foreach ($result as $value) {
                if ($value['status'] === 'success') {
                    // 短信发送成功操作 在该地方可以保存短信缓存以及记录短信记录入库操作
                }
            }
        } catch (NoGatewayAvailableException $exception) {
            foreach ($exception->getExceptions() as $exception) {
                // 短信发送失败
                // $exception->raw['Message']  获取具体的错误信息
            }
        }
    }
}