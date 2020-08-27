<?php

namespace Controller;

use Controller;
use CoreException;
use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class Notifications extends Controller implements MessageComponentInterface
{
    public function __construct()
    {
        parent::__construct([]);
    }

    public function onOpen(ConnectionInterface $conn)
    {
        echo 'new connection';
    }

    function onClose(ConnectionInterface $conn)
    {
        // TODO: Implement onClose() method.
    }

    function onError(ConnectionInterface $conn, Exception $e)
    {
        // TODO: Implement onError() method.
    }

    function onMessage(ConnectionInterface $from, $msg)
    {
        throw new CoreException($msg, 200);
    }
}