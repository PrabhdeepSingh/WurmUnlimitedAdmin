<?php
$response = array();

require(dirname(__FILE__) . "/../../classes/class.Player.inc.php");

$player = new PLAYER();

$playerList = $player->GetPlayer($_POST["wurmID"]);

$response = $playerList;

echo json_encode($response);
