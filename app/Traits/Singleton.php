<?php


namespace App\Traits;


trait  Singleton
{
    /**
     * @var
     */
    private static $instance;

    /**
     * Singleton constructor.
     */
    private function __construct()
    {
    }

    /**
     * 最终返回调用类的实例
     * @return Singleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}