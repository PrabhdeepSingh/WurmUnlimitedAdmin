<?php
session_start();

$response = array();

// Server side check to make sure nothing is blank / empty
if(!empty($_POST))
{
  require_once("../../classes/class.Server.inc.php");

	$server = new \WurmUnlimitedAdmin\SERVER();
	switch($_POST["doing"])
	{
		case "changeGameMode":
			$response = $server->ChangeGameMode($_POST);
			break;
		case "changeGameCluster":
			$response = $server->ChangeGameCluster($_POST);
			break;
		case "changeHomeServer":
			$response = $server->ChangeHomeServer($_POST);
			break;
		case "changeHomeServerKingdom":
			$response = $server->ChangeHomeServerKingdom($_POST);
			break;
		case "changeWurmTime":
			$response = $server->ChangeWurmTime($_POST);
			break;
		case "changePlayerLimit":
			$response = $server->ChangePlayerLimit($_POST);
			break;
		case "shutdown":
			$params = array("user" => $_SESSION["userData"]["username"], "seconds" => $_POST["seconds"], "reason" => $_POST["reason"]);
			$response = $server->Shutdown($params);
			break;
		case "broadcast":
			$response = $server->SendBroadcastMessage($_POST["message"]);
			break;
		default:
			$response = array("success" => false);
			break;
	}

}
else
{
	$response = array("success" => false, "message" => "Blank");
}

echo json_encode($response);
?>