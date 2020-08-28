<?php


namespace Controller;


use Controller;
use CoreException;
use Socket;

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

        try {
            $socket = new Socket\Order();
            $socket->setOrder($order);
            $socket->orderOnStatusChange();
        } catch (CoreException $exception) {
            //Skip error
        }

        return compact('order');
    }
}
