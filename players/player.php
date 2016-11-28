<?php
$response = array();

include(dirname(__FILE__) . "/../classes/class.Player.inc.php");

$player = new PLAYER();

$playerList = $player->GetPlayers($_POST);

$response = $playerList;


echo json_encode($response);
?>