<?php

namespace Core\Http\Exceptions;

use Core\Http\Contracts\NotFoundException;
use Core\Http\Request;
use Throwable;

class RouteNotFound extends \Exception implements NotFoundException
{
    public function __construct(Request $request, int $code = 404, Throwable $previous = null)
    {
        $message = "Страница по запросу ". $request->uri() ." не найдена";

        parent::__construct($message, $code, $previous);
    }
}
