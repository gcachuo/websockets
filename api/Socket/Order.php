<?php


namespace Socket;


use Ratchet\ComponentInterface;
use Socket;

class Order extends Socket implements ComponentInterface
{
    /** @var array */
    private $order;

    public function orderOnStatusChange()
    {
        $event_name = "orderOnStatusChange";
        Socket::send_message("notifications", $event_name, ['order' => $this->order]);
    }

    /**
     * @param array $order
     */
    public function setOrder(array $order): void
    {
        $this->order = $order;
    }
}
