<?php
session_start();

$response = array();

// Server side check to make sure nothing is blank / empty
if(!empty($_POST))
{
  require_once("../classes/class.Server.inc.php");
  require_once("../includes/config.php");

	$server = new SERVER();
	switch($_POST["doing"])
	{
		case "changeGameMode":
			if($_SESSION["userData"]["level"] >= $application["minAdminLevel"])
			{
				$response = $server->ChangeGameMode($_POST);
			}
			else
			{
				$response = array("error" => array("message" => "You do not have enough power to do this action."));
			}
			
			break;

		case "changeGameCluster":
			if($_SESSION["userData"]["level"] >= $application["minAdminLevel"])
			{
				$response = $server->ChangeGameCluster($_POST);
			}
			else
			{
				$response = array("error" => array("message" => "You do not have enough power to do this action."));
			}
			
			break;

		case "changeHomeServer":
			if($_SESSION["userData"]["level"] >= $application["minAdminLevel"])
			{
				$response = $server->ChangeHomeServer($_POST);
			}
			else
			{
				$response = array("error" => array("message" => "You do not have enough power to do this action."));
			}
			
			break;

		case "changeHomeServerKingdom":
			if($_SESSION["userData"]["level"] >= $application["minAdminLevel"])
			{
				$response = $server->ChangeHomeServerKingdom($_POST);
			}
			else
			{
				$response = array("error" => array("message" => "You do not have enough power to do this action."));
			}

			break;

		case "changeWurmTime":
			if($_SESSION["userData"]["level"] >= $application["minAdminLevel"])
			{
				$response = $server->ChangeWurmTime($_POST);
			}
			else
			{
				$response = array("error" => array("message" => "You do not have enough power to do this action."));
			}
			
			break;

		case "changePlayerLimit":
			if($_SESSION["userData"]["level"] >= $application["minAdminLevel"])
			{
				$response = $server->ChangePlayerLimit($_POST);
			}
			else
			{
				$response = array("error" => array("message" => "You do not have enough power to do this action."));
			}
			
			break;

		case "shutdown":
			if($_SESSION["userData"]["level"] >= $application["minAdminLevel"])
			{
				$params = array("user" => $_SESSION["userData"]["username"], "seconds" => $_POST["seconds"], "reason" => $_POST["reason"]);
				$response = $server->Shutdown($params);
			}
			else
			{
				$response = array("error" => array("message" => "You do not have enough power to do this action."));
			}
			
			break;

		case "broadcast":
			if($_SESSION["userData"]["level"] >= $application["minAdminLevel"])
			{
				$response = $server->SendBroadcastMessage($_POST["message"]);
			}
			else
			{
				$response = array("error" => array("message" => "You do not have enough power to do this action."));
			}
			
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