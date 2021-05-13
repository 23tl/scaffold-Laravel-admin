<?php


namespace App\Providers;

use Overtrue\EasySms\EasySms;
use Illuminate\Support\ServiceProvider;

class MessageServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        /**
         * 将短信 easySms 注册为一个单例
         */
        $this->app->singleton(
            'easySms',
            function () {
                return new EasySms(config('easySms'));
            }
        );
    }
}