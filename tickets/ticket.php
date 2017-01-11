<?php
$response = array();

require(dirname(__FILE__) . "/../classes/class.Server.inc.php");

$server = new SERVER();

$response = $server->GetTickets();

echo json_encode($response);
?>