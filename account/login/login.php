<?php
session_start();

$response = array();

// Server side check to make sure nothing is blank / empty
if(!empty($_POST))
{
	require(dirname(__FILE__) . "/../../classes/class.Account.inc.php");

	$account = new ACCOUNT();

	$loginCheck = $account->Login($_POST);

	if($loginCheck["success"])
	{
		$response["success"] = true;

    $_SESSION["userData"] = array("username" => $_POST["username"], "ID" => $loginCheck["ID"], "level" => $loginCheck["level"], "user_friendly_level" => $loginCheck["user_friendly_level"]);
    $_SESSION['accountLoggedinTime'] = time();

	}
	else
	{
		$response = array("success" => false, "message" => $loginCheck["message"]);
	}

}
else
{
	$response = array("success" => false, "message" => "Blank");
}

echo json_encode($response);
?>