<?php
$response = array();

require(dirname(__FILE__) . "/../../classes/class.Server.inc.php");

$server = new SERVER();

$response = $server->GetTicket($_POST["ticketId"]);

echo json_encode($response);
?>