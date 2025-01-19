<?php
require_once 'src/vendor/autoload.php';

use websocket\Server;

$server = new Server();
$server->run();
