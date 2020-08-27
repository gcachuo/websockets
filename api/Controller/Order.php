<?php


namespace Controller;


use Controller;
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

    protected function updatestatus()
    {
        global $_PATCH;
        $notifications = new Notifications();
        Socket::triggerEvent(
            'orderOnStatusChange',
            [
                'order' => [
                    'order_id' => 10,
                    'status' => $_PATCH['status']
                ]
            ]
        );
    }
}
