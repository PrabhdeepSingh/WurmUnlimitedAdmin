<?php
session_start();

$response = array();

// Server side check to make sure nothing is blank / empty
if(!empty($_POST))
{
  require_once("../../../classes/class.Admin.inc.php");

	$admin = new ADMIN();
	switch($_POST["doing"])
	{
		case "loadUser":
			$response = $admin->GetUsers($_POST["accountID"]);
			break;
		case "changeLevel":
			$response = $admin->ChangeLevel(array("accountID" => $_POST["accountID"], "level" => $_POST["level"]));
			break;
		case "resetPassword":
			$response = $admin->ResetPassword($_POST["accountID"]);
			break;
		case "deleteUser":
			$response = $admin->Delete($_POST["accountID"]);
			break;
		default:
			$response = array("success" => false);
			break;
	}

}
else
{
	$response = array("success" => false, "message" => "Blank");
}

echo json_encode($response);
?>