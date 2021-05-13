<?php


namespace App\Exceptions;

use Exception;
use Throwable;

class BaseException extends Exception
{
    const ERROR = ['message' => '', 'code' => 0];

    public function __construct(Throwable $previous = null)
    {
        parent::__construct(static::ERROR['message'], static::ERROR['code'], $previous);
    }
}