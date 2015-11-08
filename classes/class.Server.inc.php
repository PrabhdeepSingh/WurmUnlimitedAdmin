<?php
namespace WurmUnlimitedAdmin;

use PDO;
use PDOException;
use Exception;

class SERVER
{

	private $_serverDB;
  private $_serverRMI;

  function __construct()
  {
  	try
  	{
      require(dirname(__FILE__) . "/../includes/config.php");
      require(dirname(__FILE__) . "/../includes/functions.php");
      require(dirname(__FILE__) . "/class.Database.inc.php");
      require(dirname(__FILE__) . "/class.RMI.inc.php");

      if(!empty($dbConfig["wurmLoginDB"]))
      {
  	  	$this->_serverDB = new \WurmUnlimitedAdmin\DATABASE($dbConfig["wurmLoginDB"]);
        $this->_serverRMI = new \WurmUnlimitedAdmin\RMI();
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
    $result = 0;
    $output = $this->_serverRMI->Execute("playerCount");

    if(is_numeric($output[0]))
    {
      $result = $output[0];
    }
    else
    {
      $result = $output;
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
    $result = array();
    $output = $this->_serverRMI->Execute("uptime");

    if($output["success"] == false)
    {
      $result = $output;
    }
    else
    {
      $result = $output[0];
    }

    return $result;

  }

  function GetWurmTime() 
  {
    $result = array();
    $output = $this->_serverRMI->Execute("wurmTime");
    
    if($output["success"] == false)
    {
      $result = $output;
    }
    else
    {
      $result = $output[0];
    }

    return $result;
  
  }

  function SendBroadcastMessage($message = "")
  {
    $result = array();
    $output = $this->_serverRMI->Execute("broadcast", array($message));

    if($output[0])
    {
      $result = array("success" => true);
    }
    else
    {
      $result = array("success" => false);
    }

    return $result;
  
  }

  function Shutdown($params = array())
  {
    $result = array();
    $output = $this->_serverRMI->Execute("shutDown", array($params["user"], $params["seconds"], $params["reason"]));

    if($output[0])
    {
      $result = array("success" => true);
    }
    else
    {
      $result = array("success" => false);
    }

    return $result;

  }

  function __destruct()
  {
  	$this->_serverDB = null;
  }

}
?>