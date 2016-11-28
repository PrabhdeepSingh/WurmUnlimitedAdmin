<?php
require_once("../../classes/class.Server.inc.php");

$server = new SERVER();
$servers = $server->GetServers();
$serverInfo = $server->GetTracker($servers[0]["SERVER"]);
$gameStyle = ($serverInfo["PVP"] == 1) ? 'PVP' : 'PVE';
$cluster = ($serverInfo["EPIC"] == 1) ? 'Epic' : 'Freedom';

$img = imagecreatefrompng("hor.png");
$color = imagecolorallocate($img, 255, 255, 255);
imagestring($img, 4, 160, 24, $serverInfo["NAME"], $color);

imagestring($img, 4, 160, 54, $serverInfo["COUNT"] . "/" . $serverInfo["MAXPLAYERS"], $color);

imagestring($img, 4, 160, 84, "Game mode: " . $gameStyle, $color);
imagestring($img, 4, 160, 100, "Cluster: " . $cluster, $color);
imagestring($img, 4, 160, 116, "Max creatures: " . $serverInfo["MAXCREATURES"], $color);
imagestring($img, 4, 160, 132, "Aggressive creatures: " . round($serverInfo["MAXCREATURES"] * ($serverInfo["PERCENT_AGG_CREATURES"] / 100)) . "(" . $serverInfo["PERCENT_AGG_CREATURES"] ."%)", $color);
imagestring($img, 4, 160, 148, "Skill gain rate: " . $serverInfo["SKILLGAINRATE"], $color);
imagestring($img, 4, 160, 162, "Action timer: " . $serverInfo["ACTIONTIMER"], $color);

header('Content-Type: image/png');
imagepng($img);
imagedestroy($img);


?>