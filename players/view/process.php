<?php
session_start();

$response = array();

// Server side check to make sure nothing is blank / empty
if(!empty($_POST))
{
  require_once("../../classes/class.Player.inc.php");

	$player = new \WurmUnlimitedAdmin\PLAYER();
	$_POST["gmUserName"] = $_SESSION["userData"]["username"];
	switch($_POST["doing"])
	{
		case "banFunction":
			if($_SESSION["userData"]["level"] > 1)
			{
				$response = $player->BanUnban($_POST);
			}
			else
			{
				$response = array("error" => array("message" => "You do not have enough power to do this action."));
			}

			break;

		case "muteFunction":
			if($_SESSION["userData"]["level"] > 1)
			{
				$response = $player->MuteUnmute($_POST);
			}
			else
			{
				$response = array("error" => array("message" => "You do not have enough power to do this action."));
			}
			
			break;

		case "changePower":
			if($_SESSION["userData"]["level"] > 3)
			{
				$response = $player->ChangePower($_POST);
			}
			else
			{
				$response = array("error" => array("message" => "You do not have enough power to do this action."));
			}
			
			break;

		case "addMoney":
			if($_SESSION["userData"]["level"] > 2)
			{
				$response = $player->AddMoney($_POST);
			}
			else
			{
				$response = array("error" => array("message" => "You do not have enough power to do this action."));
			}
			
			break;

		case "changeEmail":
			if($_SESSION["userData"]["level"] > 3)
			{
				$response = $player->ChangeEmail($_POST);
			}
			else
			{
				$response = array("error" => array("message" => "You do not have enough power to do this action."));
			}
			
			break;

		case "changeKingdom":
			if($_SESSION["userData"]["level"] > 1)
			{
				$response = $player->ChangeKingdom($_POST);
			}
			else
			{
				$response = array("error" => array("message" => "You do not have enough power to do this action."));
			}
			
			break;

		case "getInventory":
			$response = $player->GetInventory($_POST["playerID"]);
			break;
		case "addItem":
			if($_SESSION["userData"]["level"] > 2)
			{
				$response = $player->AddItem($_POST);
			}
			else
			{
				$response = array("error" => array("message" => "You do not have enough power to do this action."));
			}
			
			break;
			
		case "getSkills":
			$response = $player->GetSkills($_POST["playerID"]);
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