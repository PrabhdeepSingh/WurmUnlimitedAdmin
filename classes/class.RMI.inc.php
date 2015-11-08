<?php
namespace WurmUnlimitedAdmin;

use Exception;

class RMI
{

	private $_rmiConfig;

  function __construct()
  {
  	try
  	{
      require(dirname(__FILE__) . "/../includes/config.php");
  	  $this->_rmiConfig = $rmiConfig;
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

    if(!empty($this->_rmiConfig["ip"]) && $this->_rmiConfig["ip"] != "server-ip" && !empty($this->_rmiConfig["ip"]))
    {
      exec("java -jar " . $this->_rmiConfig["wuaClientLocation"] . " \"" . $this->_rmiConfig["ip"] . "\" \"" . $this->_rmiConfig["port"] . "\" \"" . $this->_rmiConfig["password"] . "\" \"isRunning\" \"\" 2>&1", $output);

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
      exec("java -jar " . $this->_rmiConfig["wuaClientLocation"] . " \"" . $this->_rmiConfig["ip"] . "\" \"" . $this->_rmiConfig["port"] . "\" \"" . $this->_rmiConfig["password"] . "\" \"" . $method . "\" \"" . $stringParams . "\" 2>&1", $output);

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
  	$this->_rmiConfig = null;
  }

}
?>