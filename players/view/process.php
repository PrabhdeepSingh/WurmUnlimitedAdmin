<?php
session_start();

$response = array();

// Server side check to make sure nothing is blank / empty
if(!empty($_POST))
{
  require_once("../../classes/class.Player.inc.php");

	$player = new \WurmUnlimitedAdmin\PLAYER();
	switch($_POST["doing"])
	{
		case "banFunction":
			$response = $player->BanUnban($_POST);
			break;
		case "muteFunction":
			$response = $player->MuteUnmute($_POST);
			break;
		case "changePower":
			$response = $player->ChangePower($_POST);
			break;
		case "addMoney":
			$response = $player->AddMoney($_POST);
			break;
		case "changeEmail":
			$response = $player->ChangeEmail($_POST);
			break;
		case "changeKingdom":
			$response = $player->ChangeKingdom($_POST);
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