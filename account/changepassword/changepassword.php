<?php
session_start();

$response = array();

// Server side check to make sure nothing is blank / empty
if(!empty($_POST))
{
	require(dirname(__FILE__) . "/../../classes/class.Account.inc.php");

	$account = new ACCOUNT();
	$params = $_POST;
	$params["accountID"] = $_SESSION["userData"]["ID"];
	$passChange = $account->ChangePassword($params);

	if($passChange["success"])
	{
		$response["success"] = true;
	}
	else
	{
		$response = array("success" => false, "message" => $passChange["message"]);
	}

}
else
{
	$response = array("success" => false, "message" => "Blank");
}

echo json_encode($response);
?>