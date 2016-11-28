<?php
$response = array();

require(dirname(__FILE__) . "/../../classes/class.Admin.inc.php");

$admin = new ADMIN();

$userList = $admin->GetUsers($_POST);

$response = $userList;


echo json_encode($response);
?>