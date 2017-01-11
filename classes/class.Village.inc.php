<?php
spl_autoload_register(function ($class_name) {
	include(dirname(__FILE__) . "/class." . ucfirst(strtolower($class_name)) . ".inc.php");
});

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

class VILLAGE
{

	private $_zonesDB;
	private $_serverRMI;
	private $_Logger;

	function __construct()
	{
		try
		{
			include(dirname(__FILE__) . "/../includes/config.php");
			include(dirname(__FILE__) . "/../includes/functions.php");

			$this->_Logger = new LOGGER();

			if(!empty($servers[$_SESSION["userData"]["server"]["indexInArray"]]["absolutePath"]))
			{
				$this->_zonesDB = new DATABASE($servers[$_SESSION["userData"]["server"]["indexInArray"]]["absolutePath"] . "/sqlite/wurmzones.db");
			}
			else
			{
				throw new PDOException("Missing database configuration");
			}

		}
		catch(PDOException $ex)
		{
			echo json_encode(array(
				"error" => array(
					"message" => $ex->getMessage()
				)
			));
			$this->_Logger->Log("Error", $ex->getMessage());
			exit();
		}
		catch(Exception $ex)
		{
			echo json_encode(array(
				"error" => array(
					"message" => $ex->getMessage()
				)
			));
			$this->_Logger->Log("Error", $ex->getMessage());
			exit();
		}

	}

	/**
	 * Gets all the villages in the server
	 * @param string $villageId If supplied should get everything for only one player
	 */
	function GetVillages($villageId = "")
	{
		$result = array();

		$kingdomNames = array("No kingdom", "Jenn-Kellon", "Mol Rehan", "Horde of the Summoned", "Freedom Isles");

		if(!empty($villageId))
		{
			$sql = $this->_zonesDB->QueryWithBinds("SELECT * FROM VILLAGES WHERE ID = ?", array($villageId));
			$village = $sql->fetch(PDO::FETCH_ASSOC);
			$village["CREATIONDATE"] = date("m/d/Y H:i:s", $village["CREATIONDATE"] / 1000);
			$village["KINGDOMNAME"] = $kingdomNames[$village["KINGDOM"]];
			$village["UPKEEP"] = wurmConvertMoney($village["UPKEEP"]);
			$village["image"] = "avatar_".strtolower($village['NAME'][0])."_120.png";
			$village["success"] = true;
			$village["history"] = $this->GetHistory($villageId);
			$village["citizens"] = $this->GetCitizens($villageId);

			$result = $village;

		}
		else
		{
			$sql = $this->_zonesDB->QueryWithOutBinds("SELECT * FROM VILLAGES ORDER BY NAME");
			while($village = $sql->fetch(PDO::FETCH_ASSOC))
			{
				$village["CREATIONDATE"] = date("m/d/Y H:i:s", $village["CREATIONDATE"] / 1000);
				$village["KINGDOMNAME"] = $kingdomNames[$village["KINGDOM"]];
				$village["UPKEEP"] = wurmConvertMoney($village["UPKEEP"]);
				array_push($result, $village);
			}

		}

		return $result;

	}

	/**
	 * Get history for a village
	 * @param integer $villageId Id for the village
	 */
	function GetHistory($villageId = 0)
	{
		$result = array();

		$sql = $this->_zonesDB->QueryWithBinds("SELECT * FROM HISTORY WHERE VILLAGEID = ? ORDER BY ID DESC", array($villageId));
		while($history = $sql->fetch(PDO::FETCH_ASSOC))
		{
			$history["EVENTDATE"] = date("m/d/Y H:i:s", $history["EVENTDATE"] / 1000);
			array_push($result, $history);
		}

		return $result;

	}

	/**
	 * Get all citizens for a village
	 * @param integer $villageId Id for the village
	 */
	function GetCitizens($villageId = 0)
	{
		$result = array();

		$citizenIds = array();

		$sql = $this->_zonesDB->QueryWithBinds("SELECT WURMID FROM CITIZENS WHERE VILLAGEID = ?", array($villageId));

		while($citizen = $sql->fetch(PDO::FETCH_ASSOC))
		{
			array_push($citizenIds, $citizen["WURMID"]);
		}

		$player = new PLAYER();

		foreach ($citizenIds as $wurmId) {
			$name = $player->GetPlayerName($wurmId);

			if(!empty($name))
			{
				$wurmPlayer = array("name" => $name, "image" => "avatar_".strtolower($name[0])."_120.png", "wurmId" => $wurmId);
				array_push($result, $wurmPlayer);
			}
		}

		return $result;
		
	}

	function __destruct()
	{
		$this->_zonesDB = null;
		$this->_serverRMI = null;
		$this->_Logger = null;
	}

}
?>
