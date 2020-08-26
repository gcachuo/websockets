<?php
?>
<script>
    const ws = new WebSocket('ws://127.0.0.1:8080');
    ws.onopen = function(msg) {
        // Logic for opened connection
        console.log('Connection successfully opened');
    };
    ws.onmessage = function(msg) {
        // Handle received data
        console.log(msg);
    };
    ws.onclose = function(msg) {
        // Logic for closed connection
        console.log('Connection was closed.');
    }
    ws.error =function(err){
        console.error(err); // Write errors to console
    }
</script>
