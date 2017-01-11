<?php
spl_autoload_register(function ($class_name) {
	include(dirname(__FILE__) . "/class." . ucfirst(strtolower($class_name)) . ".inc.php");
});

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

class SERVER
{

	private $_serverDB;
	private $_serverRMI;
	private $_ticketCategoryCode = array("Unknown", "Account security problems", "Boat stuck", "Bug reports", "Forum access", "Griefing / harassment", "Lost horse", "Password resets", "Payment issues", "Stuck", "Other");
	private $_ticketStateCode = array("New", "On Hold", "Resolved", "Responded", "Canceled", "Watching", "Taken", "Forwarded", "Reopened");
	private $_ticketLevelCode = array("", "CM", "GM", "ARCH", "DEV");
	private $_logger;

	function __construct($serverIndexInArray = null)
	{
		try
		{
			require(dirname(__FILE__) . "/../includes/config.php");
			require(dirname(__FILE__) . "/../includes/functions.php");

			$_logger = new LOGGER();

			if(isset($_SESSION["userData"]["server"]) && !empty($servers[$_SESSION["userData"]["server"]["indexInArray"]]))
			{
				$this->_serverDB = new DATABASE($servers[$_SESSION["userData"]["server"]["indexInArray"]]["absolutePath"] . "/sqlite/wurmlogin.db");
			}
			else if(!isset($_SESSION["userData"]["server"]))
			{
				$this->_serverDB = new DATABASE($servers[$serverIndexInArray]["absolutePath"] . "/sqlite/wurmlogin.db");
			}
			else
			{
				throw new PDOException("Missing database configuration");
			}

		}
		catch(PDOException $ex)
		{
			$_logger->Log("Error", $ex->getMessage());
			echo json_encode(array(
				"error" => array(
					"message" => $ex->getMessage()
				)
			));
			exit();
		}
		catch(Exception $ex)
		{
			$_logger->Log("Error", $ex->getMessage());
			echo json_encode(array(
				"error" => array(
					"message" => $ex->getMessage()
				)
			));
			exit();
		}

	}

	function GetServer()
	{
		$result = array();

		$sql = $this->_serverDB->QueryWithBinds("SELECT * FROM SERVERS WHERE SERVER = ?", array($_SESSION["userData"]["server"]["id"]));
		$result = $sql->fetch(PDO::FETCH_ASSOC);

		$result["COUNT"] = $this->GetPlayerCount();
		$result["UPTIME"] = $this->GetUpTime();
		$result["WURMTIME"] = $this->GetWurmTime();

		$result["success"] = true;

		return $result;

	}

	function GetServerName($serverId = 0)
	{
		$sql = $this->_serverDB->QueryWithBinds("SELECT NAME FROM SERVERS WHERE SERVER = ?", array($serverId));
		$name = $sql->fetch(PDO::FETCH_ASSOC);
		return $name["NAME"];
	}

	function GetPlayerCount()
	{
		$result = 0;
		$this->_serverRMI = new RMI();
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

	function GetUpTime()
	{
		$this->_serverRMI = new RMI();
		$result = $this->_serverRMI->Execute("uptime");

		return $result;

	}

	function GetWurmTime()
	{
		$this->_serverRMI = new RMI();
		$result = $this->_serverRMI->Execute("wurmTime");

		return $result;

	}

	function ChangeGameMode($params = array())
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

	function ChangeGameCluster($params = array())
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

	function ChangeHomeServer($params = array())
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

	function ChangeHomeServerKingdom($params = array())
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

	function ChangeWurmTime($params = array())
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

	function ChangePlayerLimit($params = array())
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

	function SendBroadcastMessage($message = "")
	{
		$result = array();
		$this->_serverRMI = new RMI();
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
		$this->_serverRMI = new RMI();
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

	function GetActiveTicketCount()
	{
		$sql = $this->_serverDB->QueryWithBinds("SELECT Count(*) as count FROM TICKETS WHERE SERVERID = ? AND STATECODE != 2 AND STATECODE != 4", array($_SESSION["userData"]["server"]["id"]));
		$count = $sql->fetch(PDO::FETCH_ASSOC);
		return $count["count"];
	}

	function GetTickets()
	{
		$result = array();

		$sql = $this->_serverDB->QueryWithBinds("SELECT PLAYERNAME, CATEGORYCODE, STATECODE, TICKETDATE, TICKETID FROM TICKETS WHERE SERVERID = ? ORDER BY TICKETDATE DESC", array($_SESSION["userData"]["server"]["id"]));
		while($ticket = $sql->fetch(PDO::FETCH_ASSOC))
		{
			$ticket["CATEGORYNAME"] = $this->_ticketCategoryCode[$ticket["CATEGORYCODE"]];
			$ticket["STATENAME"] = $this->_ticketStateCode[$ticket["STATECODE"]];
			$ticket["TICKETDATE"] = date("m/d/Y H:i:s", $ticket["TICKETDATE"] / 1000);
			array_push($result, $ticket);
		}

		return $result;

	}

	function GetTicket($ticketId = 0)
	{
		$result = array();

		$sql = $this->_serverDB->QueryWithBinds("SELECT * FROM TICKETS WHERE TICKETID = ?", array($ticketId));
		$ticket = $sql->fetch(PDO::FETCH_ASSOC);

		$ticket["SERVERNAME"] = $this->GetServerName($ticket["SERVERID"]);
		$ticket["CATEGORYNAME"] = $this->_ticketCategoryCode[$ticket["CATEGORYCODE"]];
		$ticket["STATENAME"] = $this->_ticketStateCode[$ticket["STATECODE"]];
		$ticket["LEVELNAME"] = $this->_ticketLevelCode[$ticket["LEVELCODE"]];

		$player = new PLAYER();

		$ticket["PLAYER"] = $player->GetPlayerName($ticket["PLAYERWURMID"]);

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