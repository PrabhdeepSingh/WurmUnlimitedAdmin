<?php
$response = array();

require(dirname(__FILE__) . "/../classes/class.Server.inc.php");

$server = new SERVER();

switch($_POST["getDataFor"])
{
	case "playerCount":
		$response = array("playerCount" => $server->GetPlayerCount(), "uptime" => $server->GetUpTime());
		break;
	case "serverInfo":
		$response = $server->GetServer();
		break;
}

echo json_encode($response);