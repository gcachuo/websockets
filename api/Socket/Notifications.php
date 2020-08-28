<?php

namespace Socket;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Socket;

class Notifications extends Socket implements MessageComponentInterface
{
    public function onMessage(ConnectionInterface $from, $msg)
    {
        parent::onMessage($from, $msg);
    }
}
