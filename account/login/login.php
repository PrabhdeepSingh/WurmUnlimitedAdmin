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
    
    // Get servers
    require(dirname(__FILE__) . "/../../classes/class.Server.inc.php");
    require(dirname(__FILE__) . "/../../includes/config.php");

    if(count($servers) > 1)
    {
    	$serverList = array();

    	for($i = 0; $i < count($servers); $i++)
    	{
        $server = new SERVER($i);
        $serverInfo = $server->GetServerNameAndIdByInternalPassword($servers[$i]["password"]);
    		array_push($serverList, array("indexInArray" => $i, "name" => $serverInfo["name"], "id" => $serverInfo["id"], "url" => $application["rootPath"] . "?server=" . $i));
    	}

    	$_SESSION["serverList"] = $serverList;
    	$response["message"] = "redirect";
    }
    else
    {
      $server = new SERVER(0);
      $serverInfo = $server->GetServerNameAndIdByInternalPassword($servers[0]["password"]);
    	$_SESSION["userData"]["server"] = array("indexInArray" => 0, "name" => $serverInfo["name"], "id" => $serverInfo["id"]);
      $_SESSION["serverList"] = array(array("indexInArray" => 0, "name" => $serverInfo["name"], "id" => $serverInfo["id"], "url" => $application["rootPath"] . "?server=0"));
    }

    $response["info"] = $_SESSION["serverList"];

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