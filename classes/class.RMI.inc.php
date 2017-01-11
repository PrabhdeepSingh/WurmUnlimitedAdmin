<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

class RMI
{
	private $_wuaClientLocation;
	private $_server;

	function __construct()
	{
		try
		{
			require(dirname(__FILE__) . "/../includes/config.php");
			$this->_wuaClientLocation = $application["wuaClientLocation"];
			$this->_server = $servers[$_SESSION["userData"]["server"]["indexInArray"]];
			
		}
		catch(Exception $ex)
		{
			echo json_encode(array(
				"error" => array(
					"message" => $ex->getMessage()
				)
			));
			exit();
		}

	}

	function CheckConnection()
	{
		$result = array();

		if(!empty($this->_server["ip"]) && !empty($this->_server["port"]) && !empty($this->_server["password"]))
		{
			exec("java -jar \"" . $this->_wuaClientLocation . "\" \"" . $this->_server["ip"] . "\" \"" . $this->_server["port"] . "\" \"" . $this->_server["password"] . "\" \"isRunning\" \"\" 2>&1", $output);

			if($output[0] == true && count($output) == 1)
			{
				$result = array("success" => true);
			}
			else
			{
				$result = array("success" => false, "message" => "Offline");
			}

		}
		else
		{
			$result = array("success" => false, "message" => "Incorrect config");
		}

		return $result;

	}

	function Execute($method = "", $params = array())
	{
		$result = array();
		$isOnline = $this->CheckConnection();
		$stringParams = implode(",", $params);

		if($isOnline["success"] == true)
		{
			exec("java -jar \"" . $this->_wuaClientLocation . "\" \"" . $this->_server["ip"] . "\" \"" . $this->_server["port"] . "\" \"" . $this->_server["password"] . "\" \"" . $method . "\" \"" . $stringParams . "\" 2>&1", $output);

			$result = $output;

		}
		else
		{
			$result = $isOnline;
		}

		return $result;

	}

	function __destruct()
	{
		$this->_server = null;
	}

}