<?php

namespace Controller;

use Controller;
use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use SplObjectStorage;

class Notifications extends Controller implements MessageComponentInterface
{
    protected $connections;

    public function __construct()
    {
        $this->connections = new SplObjectStorage;
        parent::__construct([]);
    }

    public function onOpen(ConnectionInterface $conn)
    {
        echo 'new connection' . PHP_EOL;
        $conn->send('Welcome!');
        $this->connections->attach($conn);
    }

    function onClose(ConnectionInterface $conn)
    {
        $this->connections->detach($conn);
    }

    function onError(ConnectionInterface $conn, Exception $e)
    {
        // TODO: Implement onError() method.
    }

    function onMessage(ConnectionInterface $from, $msg)
    {
        echo $msg . PHP_EOL;
        foreach ($this->connections as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        }
    }
}
