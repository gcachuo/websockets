<?php
?>
<button id="btn-send-event">Change status</button>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script>
    $(() => {
        ws = new WebSocket('ws://localhost/websockets/api/websocket/notifications');
        ws.onopen = function (msg) {
            // Logic for opened connection
            console.log('Connection successfully opened');
        };
        ws.onmessage = function (event) {
            // Handle received data
            const {data} = event;
            const [event_name, data_object] = JSON.parse(data);
            if (window[event_name]) {
                window[event_name](data_object);
            }
        };
        ws.onclose = function (evt) {
            // Logic for closed connection
            if (evt.code === 3001) {
                console.log('Connection was closed.');
                ws = null;
            } else {
                ws = null;
                console.error('Cannot connect to websocket.'); // Write errors to console
                toastr.error('Cannot connect to websocket.');
            }
        }
        ws.error = function (err) {
            console.error(err); // Write errors to console
            toastr.error('Cannot connect to websocket.');
        }
    });
    $("#btn-send-event").on('click', () => {
        $.ajax({
            url: 'http://localhost/websockets/api/order/status/10',
            method: 'PATCH',
            data: {
                "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE1OTg1NTE0ODIsImRhdGEiOnsiaWQiOjEsImxvZ2luIjoiY2FjaHUifX0.Mx-oZuvyAXVQgQITOGPFITt0BiEAZKN7rtK2cZpzhoU",
                "status": "Pending"
            }
        }).fail(({responseJSON: {response: {message}}}) => {
            console.error(message)
            toastr.error(message);
        });
    });

    function message({message}) {
        toastr.info(message);
    }

    function orderOnStatusChange({order}) {
        const {order_id, status} = order;
        toastr.success(`Order #${order_id} has changed to status "${status}"`);
    }
</script>
