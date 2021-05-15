<?php

namespace App\Exceptions;

use ArtARTs36\PushAllSender\Interfaces\PusherInterface;
use ArtARTs36\PushAllSender\Push;

class ExceptionNotifier
{
    protected $pusher;

    public function __construct(PusherInterface $pusher)
    {
        $this->pusher = $pusher;
    }

    public function notify(\Throwable $e): void
    {
        $push = new Push('Произошла ошибка', $e->getMessage());

        $this->pusher->push($push);
    }
}
