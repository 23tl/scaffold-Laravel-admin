# Laravel Api Starter Designed With ❤️

简化基于 Laravel 新项目初始化的时间;开箱即用，加速 Api 开发;少许的依赖安装

## 已完成功能
1. 管理后台基本功能
    1. 管理员模块
    2. 菜单模块
    3. 角色权限模块
    4. Artisan 修改管理员账号密码
    5. 后台快捷入口管理
    6. 后台基础数据转为数据迁移
    7. 内容管理
    8. 广告管理
    9. 用户管理
    10. 资金明细管理
2. API统一格式化返回
3. 短信模块
4. 支付模块


### 编写发送短信实例
```php
use App\Notifications\SmsNotify;
use Illuminate\Support\Facades\Notification;

Notification::route('sms', '17638163353')->notify(
        new SmsNotify(
            [
                'content' => '验证码内容',
                'params'    => [
                    'code' => 1234,
                ],
                'template' => 'SMS_157980065',
            ]
        )
);
```
### 支付模块实例
```php
use Illuminate\Support\Facades\Http;

Http::post('payment/pay', [
    'gateway' => 'alipay', // 支付网关
    'method' => 'app',    // 支付方法，支付，app、wap
    'orderNo' => '123455', // 订单号
]);
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
