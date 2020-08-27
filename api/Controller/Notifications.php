<?php

namespace Controller;

use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Socket;
use SplObjectStorage;

class Notifications extends Socket implements MessageComponentInterface
{
    protected static $connections;

    public function __construct()
    {
        self::$connections = new SplObjectStorage();
    }

    function onMessage(ConnectionInterface $from, $msg)
    {
        echo $msg . PHP_EOL;
        /** @var ConnectionInterface $client */
        foreach (self::$connections as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                [$event_name, $data_object] = json_decode($msg, true);
                $client->send(json_encode([$event_name, $data_object]));
            }
        }
    }

    public function onOpen(ConnectionInterface $conn)
    {
        self::$connections->attach($conn);

        echo 'new connection' . PHP_EOL;
        $conn->send(json_encode(['message', ['message' => 'Welcome!']]));
    }

    function onClose(ConnectionInterface $conn)
    {
        self::$connections->detach($conn);
    }

    function onError(ConnectionInterface $conn, Exception $e)
    {
        // TODO: Implement onError() method.
    }

}
