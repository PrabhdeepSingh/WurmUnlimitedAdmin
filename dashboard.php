<?php
$response = array();

require(dirname(__FILE__) . "/classes/class.Server.inc.php");

$server = new SERVER();
$response = array("playerCount" => $server->GetPlayerCount(), "uptime" => $server->GetUpTime(), "activeTickets" => $server->GetActiveTicketCount());

echo json_encode($response);