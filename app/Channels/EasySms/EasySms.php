<?php


namespace App\Channels\EasySms;

use App\Cache\SmsCache;
use App\Services\SmsServices;
use Illuminate\Notifications\Notification;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;

class EasySms
{
    /**
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
            $result  = app('easySms')->send($mobile, $message);
            foreach ($result as $value) {
                if ($value['status'] === 'success') {
                    // 如果 参数 中包含 code ，则该短信为验证码短信，记录缓存
                    if (array_key_exists('code', $message->data)) {
                        SmsCache::setSmsCache($message->scenes, $mobile, $message->data['code']);
                    }
                    SmsServices::getInstance()->storeSmsLog(
                        [
                            'mobile'  => $mobile,
                            'params'  => $message->data,
                            'userId'  => app('app')->user ? app('app')->user->id : 0,
                            'content' => $message->content,
                            'scenes'  => $message->scenes,
                        ]
                    );
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