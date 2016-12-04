<?php
spl_autoload_register(function ($class_name) {
    include(dirname(__FILE__) . "/class." . ucfirst(strtolower($class_name)) . ".inc.php");
});

class SERVER
{

	private $_serverDB;
  private $_serverRMI;
  private $_ticketCategoryCode = array("Unknown", "Account security problems", "Boat stuck", "Bug reports", "Forum access", "Griefing / harassment", "Lost horse", "Password resets", "Payment issues", "Stuck", "Other");
  private $_ticketStateCode = array("New", "On Hold", "Resolved", "Responded", "Cancelled", "Watching", "Taken", "Forwarded", "Reopened");
  private $_ticketLevelCode = array("", "CM", "GM", "ARCH", "DEV");


  function __construct()
  {
  	try
  	{
      require(dirname(__FILE__) . "/../includes/config.php");
      require(dirname(__FILE__) . "/../includes/functions.php");

      if(!empty($dbConfig["wurmLoginDB"]))
      {
  	  	$this->_serverDB = new DATABASE($dbConfig["wurmLoginDB"]);
        $this->_serverRMI = new RMI();
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

    try
    {
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

  function GetServerName($serverId = 0)
  {
    $sql = $this->_serverDB->QueryWithBinds("SELECT NAME FROM SERVERS WHERE SERVER = ?", array($serverId));
    return $sql->fetch(PDO::FETCH_ASSOC);
  
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

  function ChangeGameMode($params = array())
  {
    try
    {
      $result = array();

      $sql = $this->_serverDB->QueryWithBinds("UPDATE SERVERS SET PVP = ? WHERE SERVER = ?", array($params["newGameMode"], $params["serverID"]));

      if($sql->rowCount() > 0)
      {
        $result = array("success" => true);
      }
      else
      {
        $result = array("success" => false);
      }

      return $result;

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

  function ChangeGameCluster($params = array())
  {
    try
    {
      $result = array();

      $sql = $this->_serverDB->QueryWithBinds("UPDATE SERVERS SET EPIC = ? WHERE SERVER = ?", array($newGameCluster, $params["serverID"]));

      if($sql->rowCount() > 0)
      {
        $result = array("success" => true);
      }
      else
      {
        $result = array("success" => false);
      }

      return $result;

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

  function ChangeHomeServer($params = array())
  {
    try
    {
      $result = array();

      $sql = $this->_serverDB->QueryWithBinds("UPDATE SERVERS SET HOMESERVER = ? WHERE SERVER = ?", array($params["homeServer"], $params["serverID"]));

      if($sql->rowCount() > 0)
      {
        $result = array("success" => true);
      }
      else
      {
        $result = array("success" => false);
      }

      return $result;

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

  function ChangeHomeServerKingdom($params = array())
  {
    try
    {
      $result = array();

      $sql = $this->_serverDB->QueryWithBinds("UPDATE SERVERS SET KINGDOM = ? WHERE SERVER = ?", array($params["homeServerKingdom"], $params["serverID"]));

      if($sql->rowCount() > 0)
      {
        $result = array("success" => true);
      }
      else
      {
        $result = array("success" => false);
      }

      return $result;

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

  function ChangeWurmTime($params = array())
  {
    try
    {
      $result = array();

      $sql = $this->_serverDB->QueryWithBinds("UPDATE SERVERS SET WORLDTIME = ? WHERE SERVER = ?", array($params["newWurmTime"], $params["serverID"]));

      if($sql->rowCount() > 0)
      {
        $result = array("success" => true);
      }
      else
      {
        $result = array("success" => false);
      }

      return $result;

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

  function ChangePlayerLimit($params = array())
  {
    try
    {
      $result = array();

      $sql = $this->_serverDB->QueryWithBinds("UPDATE SERVERS SET MAXPLAYERS = ? WHERE SERVER = ?", array($params["newPlayerLimit"], $params["serverID"]));

      if($sql->rowCount() > 0)
      {
        $result = array("success" => true);
      }
      else
      {
        $result = array("success" => false);
      }

      return $result;

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

  function GetTickets($ticketId = 0)
  {
    $result = array();

    if(!empty($ticketId))
    {
      $sql = $this->_serverDB->QueryWithBinds("SELECT * FROM TICKETS WHERE TICKETID = ?", array($ticketId));
      $ticket = $sql->fetch(PDO::FETCH_ASSOC);

      $ticket["SERVERNAME"] = $this->GetServerName($ticket["SERVERID"])["NAME"];
      $ticket["CATEGORYNAME"] = $this->_ticketCategoryCode[$ticket["CATEGORYCODE"]];
      $ticket["STATENAME"] = $this->_ticketStateCode[$ticket["STATECODE"]];
      $ticket["LEVELNAME"] = $this->_ticketLevelCode[$ticket["LEVELCODE"]];

      $player = new PLAYER();

      $ticket["PLAYER"] = $player->GetPlayers($ticket["PLAYERWURMID"]);

      $ticket["TICKETDATE"] = date("m/d/Y H:i:s", $ticket["TICKETDATE"] / 1000);

      if ($ticket["CLOSEDDATE"] > 0)
      {
        $ticket["CLOSEDDATE"] = date("m/d/Y H:i:s", $ticket["CLOSEDDATE"] / 1000);
      }
      else
      {
        $ticket["CLOSEDDATE"] = "Never";
      }

      $ticket["ACTIVITY"] = $this->GetTicketAction($ticketId);

      $ticket["success"] = true;

      $result = $ticket;

    }
    else
    {
      $sql = $this->_serverDB->QueryWithOutBinds("SELECT PLAYERNAME, CATEGORYCODE, STATECODE, TICKETDATE, TICKETID FROM TICKETS ORDER BY TICKETDATE DESC");
      while($ticket = $sql->fetch(PDO::FETCH_ASSOC))
      {
        $ticket["CATEGORYNAME"] = $this->_ticketCategoryCode[$ticket["CATEGORYCODE"]];
        $ticket["STATENAME"] = $this->_ticketStateCode[$ticket["STATECODE"]];
        $ticket["TICKETDATE"] = date("m/d/Y H:i:s", $ticket["TICKETDATE"] / 1000);
        array_push($result, $ticket);
      }

    }

    return $result;
  }

  function GetTicketAction($ticketId = 0)
  {
    $result = array();

    $sql = $this->_serverDB->QueryWithBinds("SELECT BYWHOM, NOTE, ACTIONDATE, ACTIONTYPE FROM TICKETACTIONS WHERE TICKETID = ? ORDER BY ACTIONDATE DESC", array($ticketId));
    while($ticket = $sql->fetch(PDO::FETCH_ASSOC))
    {
      $ticket["ACTIONDATE"] = date("m/d/Y H:i:s", $ticket["ACTIONDATE"] / 1000);
      array_push($result, $ticket);
    }

    return $result;

  }

  function __destruct()
  {
  	$this->_serverDB = null;
  }

}
?>