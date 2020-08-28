<?php


namespace Controller;


use Controller;
use Socket;
use WebSocket\Client;

class Order extends Controller
{
    public function __construct()
    {
        parent::__construct([
            'PATCH' => [
                'status' => 'updatestatus'
            ]
        ]);
    }

    protected function updatestatus($order_id)
    {
        global $_PATCH;
        $order = ['order_id' => $order_id, 'status' => $_PATCH['status']];

        Socket::send_message("orderOnStatusChange", ['order' => $order]);

        return compact('order');
    }
}
