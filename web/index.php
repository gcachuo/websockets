<?php
?>
<button id="btn-send-event">Send event</button>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    ws = new WebSocket('ws://localhost:8080/notifications');
    ws.onopen = function (msg) {
        // Logic for opened connection
        console.log('Connection successfully opened');
    };
    ws.onmessage = function (data) {
        // Handle received data
        const {data: message} = data;
        console.info(message);
    };
    ws.onclose = function (msg) {
        // Logic for closed connection
        console.log('Connection was closed.');
    }
    ws.error = function (err) {
        console.error(err); // Write errors to console
    }
    $("#btn-send-event").on('click', () => {
        $.ajax({
            url: 'http://localhost/websockets/api/order/status/10',
            method: 'PATCH',
            data: {
                "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE1OTg1NTE0ODIsImRhdGEiOnsiaWQiOjEsImxvZ2luIjoiY2FjaHUifX0.Mx-oZuvyAXVQgQITOGPFITt0BiEAZKN7rtK2cZpzhoU",
                "status": "Pending"
            }
        })
    })
</script>
