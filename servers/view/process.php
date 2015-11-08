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