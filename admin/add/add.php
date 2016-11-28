<?php
session_start();

$response = array();

// Server side check to make sure nothing is blank / empty
if(!empty($_POST))
{
	require(dirname(__FILE__) . "/../../classes/class.Admin.inc.php");

	$admin = new ADMIN();

	$create = $admin->Create($_POST);

	$response = $create;

}
else
{
	$response = array("success" => false, "message" => "Blank");
}

echo json_encode($response);
?>