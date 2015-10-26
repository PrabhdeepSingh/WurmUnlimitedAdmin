<?php
session_start();

$response = array();

// Server side check to make sure nothing is blank / empty
if(!empty($_POST))
{
	require(dirname(__FILE__) . "/../../classes/class.Account.inc.php");

	$account = new \WurmUnlimitedAdmin\ACCOUNT();

	$create = $account->Create($_POST);

	$response = $create;

}
else
{
	$response = array("success" => false, "message" => "Blank");
}

echo json_encode($response);
?>