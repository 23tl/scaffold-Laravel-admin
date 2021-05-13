<?php


namespace App\Services;

use App\Traits\Singleton;

class BaseServices
{
    use Singleton;

    /**
     * @var
     */
    public $server;

    public function __construct()
    {
    }
}