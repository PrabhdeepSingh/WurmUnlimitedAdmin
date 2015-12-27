<?php
$response = array();

require(dirname(__FILE__) . "/../classes/class.Village.inc.php");

$village = new \WurmUnlimitedAdmin\VILLAGE();

$villageList = $village->GetVillages($_POST);

$response = $villageList;


echo json_encode($response);
?>