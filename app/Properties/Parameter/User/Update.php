<?php


namespace App\Properties\Parameter\User;


use Illuminate\Support\Str;

class Update
{
    /**
     * 参数
     * @var
     */
    protected $params;

    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    protected function info()
    {
        return [

        ];
    }

    protected function fund()
    {
        return [

        ];
    }

    protected function node()
    {
        return [

        ];
    }

    protected function make($method)
    {
        $gateway = Str::lower($method);
        return $this->{$gateway}();
    }

    public static function __callStatic($method, $params)
    {
        $app = new self(...$params);

        return $app->make($method);
    }
}