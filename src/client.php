<?php
$host = "127.0.0.1";
$port = 1234;
$username_min_length = 2;
$username_max_length = 32;
$creation_failed_message = "Socket creation failed!\n";
$username = null;

$is_username_valid = false;
while(!$is_username_valid){
    echo "Enter your username... :> ";
    $input = trim(fgets(STDIN));
    if ($input == 'Q') {
        exit;
    }else if (IsNullOrEmptyString($input) || strlen($input) < $username_min_length || strlen($input) > $username_max_length) {
        echo "Please use between $username_min_length and $username_max_length characters.\n";
    }else if ($input == "-help") {
        echo "Q - Enter Q to quit.\n";
    } else {
        $username = $input;
        $is_username_valid = true;
    }
}

while(1){
    echo "-- Type a message... :> ";
    $message = trim(fgets(STDIN));
    if ($message == 'Q') {
        exit;
    }

    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if ($socket === false) {
        echo $creation_failed_message;
    }

    $is_connected = socket_connect($socket, $host, $port);
    if ($is_connected === false) {
        echo $creation_failed_message;
    } else {
        socket_write($socket, "[$username] --> $message\n", 1024);
    }
}

function IsNullOrEmptyString($input){
    return (!isset($input) || trim($input)==='');
}