<?php

namespace App\Http\Controller;

class BaseController
{

    /**
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        throw new \Exception("Method {$name} is not supported.\n");
    }
}