<?php
?>
<script>
    ws = new WebSocket('ws://localhost:8080/notifications');
    ws.onopen = function (msg) {
        // Logic for opened connection
        console.log('Connection successfully opened');
        ws.send('Hello Me!');
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
</script>
