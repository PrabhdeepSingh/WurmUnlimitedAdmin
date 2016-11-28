<?php
$response = array();

require(dirname(__FILE__) . "/../../classes/class.Village.inc.php");

$village = new VILLAGE();

$v = $village->GetVillages($_POST["villageId"]);

echo json_encode($v);
?>