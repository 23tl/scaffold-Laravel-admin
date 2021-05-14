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
2. API统一格式化返回
3. 短信模块


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

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
