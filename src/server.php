<?php
$host = "127.0.0.1";
$port = 1234;

$socket = socket_create(AF_INET, SOCK_STREAM, 0);
if ($socket === false) {
    die("Could not create socket.\n");
}

$is_bound = socket_bind($socket, $host, $port);
if ($is_bound === false) {
    die("Could not bind to socket.\n");
}

$is_listening = socket_listen($socket);
if ($is_listening === false) {
    die("Could not set up socket listener.\n");
}

echo "Waiting for connections... \n";

while(1){
    $socket_resource = socket_accept($socket);
    if ($socket_resource === false) {
        die("Could not accept incoming connection.\n");
    }

    echo socket_read($socket_resource, 1024);;

    socket_close($socket_resource);
}

socket_close($socket);