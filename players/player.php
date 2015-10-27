<?php
$response = array();

require(dirname(__FILE__) . "/../classes/class.Player.inc.php");

$player = new \WurmUnlimitedAdmin\PLAYER();

$playerList = $player->GetPlayers($_POST);

$response = $playerList;


echo json_encode($response);
?>