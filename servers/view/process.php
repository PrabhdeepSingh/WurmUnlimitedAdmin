<?php
session_start();

$response = array();

// Server side check to make sure nothing is blank / empty
if(!empty($_POST))
{
  require_once("../../classes/class.Server.inc.php");

	$server = new \WurmUnlimitedAdmin\SERVER();
	switch($_POST["doing"])
	{
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