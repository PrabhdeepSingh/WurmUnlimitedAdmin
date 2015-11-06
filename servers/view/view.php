<?php
$response = array();

require(dirname(__FILE__) . "/../../classes/class.Server.inc.php");

$server = new \WurmUnlimitedAdmin\SERVER();

$serverList = $server->GetServers($_POST["serverID"]);

$response = $serverList;


echo json_encode($response);
?>