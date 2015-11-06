<?php
namespace WurmUnlimitedAdmin;

use PDO;
use PDOException;
use Exception;

class SERVER
{

	private $_serverDB;

  function __construct()
  {
  	try
  	{
      global $dbConfig;
      global $rmiConfig;
      require(dirname(__FILE__) . "/../includes/config.php");
      require(dirname(__FILE__) . "/../includes/functions.php");
      require(dirname(__FILE__) . "/class.Database.inc.php");

      if(!empty($dbConfig["wurmLoginDB"]))
      {
  	  	$this->_serverDB = new \WurmUnlimitedAdmin\DATABASE($dbConfig["wurmLoginDB"]);
      }
      else
      {
        throw new PDOException("Missing database");
      }

	  }
    catch(PDOException $ex)
    {
      echo json_encode(array(
        "error" => array(
          "message" => $ex->getMessage()
        )
      ));
      exit();
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

  function GetServers($serverID = "")
  {
    $result = array();

    if(!empty($serverID))
    {
      $sql = $this->_serverDB->QueryWithBinds("SELECT * FROM SERVERS WHERE SERVER = ?", array($serverID));
      $server = $sql->fetch(PDO::FETCH_ASSOC);
      
      $server["COUNT"] = $this->GetPlayerCount();
      $server["UPTIME"] = $this->GetUpTime();
      $server["WURMTIME"] = $this->GetWurmTime();

      $server["success"] = true;

      $result = $server;

    }
    else
    {
      $sql = $this->_serverDB->QueryWithOutBinds("SELECT SERVER, NAME, MAXPLAYERS FROM SERVERS");
      while($servers = $sql->fetch(PDO::FETCH_ASSOC))
      {
        $servers["COUNT"] = $this->GetPlayerCount();
        array_push($result, $servers);
      }

    }

    return $result;

  }

  function GetPlayerCount()
  {
    require(dirname(__FILE__) . "/../includes/config.php");
    $result = 0;
    try
    {
      if($rmiConfig["ip"] != "server-ip" && !empty($rmiConfig["ip"]))
      {
        exec("java -jar " . $rmiConfig["wuaClientLocation"] ." \"" . $rmiConfig["ip"] . "\" \"" . $rmiConfig["port"] . "\" \"" . $rmiConfig["password"] . "\" \"playerCount\" \"\" 2>&1", $output);
        if(is_numeric($output[0]))
        {
          $result = $output[0];
        }
        else
        {
          $result = json_encode($output);
        }

      }
      else
      {
        $result = array("success" => false, "message" => "Incorrect config");
      }

    }
    catch(Exception $ex)
    {
      $result = 0;
    }

    return $result;

  }

  function GetTracker($serverID = "")
  {
    $result = array();

    if(!empty($serverID))
    {
      $sql = $this->_serverDB->QueryWithBinds("SELECT NAME, SKILLGAINRATE, ACTIONTIMER, MAXPLAYERS, MAXCREATURES, PERCENT_AGG_CREATURES, PVP, EPIC, MAPNAME FROM SERVERS WHERE SERVER = ?", array($serverID));
      $server = $sql->fetch(PDO::FETCH_ASSOC);
      $server["COUNT"] = $this->GetPlayerCount();
      $server["EXTERNALIP"] = get_real_ip();
      $result = $server;
    }

    return $result;

  }

  function GetUpTime()
  {
    require(dirname(__FILE__) . "/../includes/config.php");
    $result = array();
    try
    {
      if($rmiConfig["ip"] != "server-ip" && !empty($rmiConfig["ip"]))
      {
        exec("java -jar " . $rmiConfig["wuaClientLocation"] ." \"" . $rmiConfig["ip"] . "\" \"" . $rmiConfig["port"] . "\" \"" . $rmiConfig["password"] . "\" \"uptime\" \"\" 2>&1", $output);
        
        $result = $output[0];
      }
      else
      {
        $result = array("success" => false, "message" => "Incorrect config");
      }

    }
    catch(Exception $ex)
    {
      $result = array("success" => false, "message" => json_encode($ex));
    }

    return $result;

  }

  function GetWurmTime() 
  {
    require(dirname(__FILE__) . "/../includes/config.php");
    $result = array();
    try
    {
      if($rmiConfig["ip"] != "server-ip" && !empty($rmiConfig["ip"]))
      {
        exec("java -jar " . $rmiConfig["wuaClientLocation"] ." \"" . $rmiConfig["ip"] . "\" \"" . $rmiConfig["port"] . "\" \"" . $rmiConfig["password"] . "\" \"wurmTime\" \"\" 2>&1", $output);
        
        $result = $output[0];
      }
      else
      {
        $result = array("success" => false, "message" => "Incorrect config");
      }

    }
    catch(Exception $ex)
    {
      $result = array("success" => false, "message" => json_encode($ex));
    }

    return $result;
  
  }

  function SendBroadcastMessage($message = "")
  {
    require(dirname(__FILE__) . "/../includes/config.php");
    $result = array();
    try
    {
      if($rmiConfig["ip"] != "server-ip" && !empty($rmiConfig["ip"]))
      {
        exec("java -jar " . $rmiConfig["wuaClientLocation"] ." \"" . $rmiConfig["ip"] . "\" \"" . $rmiConfig["port"] . "\" \"" . $rmiConfig["password"] . "\" \"broadcast\" \"" . $message . "\"");
        
        $result = array("success" => true);

      }
      else
      {
        $result = array("success" => false, "message" => "Incorrect config");
      }

    }
    catch(Exception $ex)
    {
      $result = array("success" => false, "message" => json_encode($ex));
    }

    return $result;
  
  }

  function __destruct()
  {
  	$this->_serverDB = null;
  }

}
?>