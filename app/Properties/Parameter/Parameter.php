<?php


namespace App\Properties\Parameter;


use Illuminate\Http\Request;

/**
 * Class Parameter
 *
 * @package App\Properties\Parameter
 */
class Parameter
{
    /**
     * @var Request
     */
    private $request;

    /**
     * Parameter constructor.
     *
     * @param  Request  $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->request->{$name}($arguments);
    }
}
