<?php
namespace WurmUnlimitedAdmin;

use PDO;
use PDOException;
use Exception;

class VILLAGE
{

	private $_zonesDB;
  private $_serverRMI;
  private $_Logger;

  function __construct()
  {
  	try
  	{
      require(dirname(__FILE__) . "/../includes/config.php");
      require(dirname(__FILE__) . "/../includes/functions.php");
      require(dirname(__FILE__) . "/class.Database.inc.php");
      require(dirname(__FILE__) . "/class.RMI.inc.php");
      require(dirname(__FILE__) . "/class.Logger.inc.php");

      $this->_Logger = new \WurmUnlimitedAdmin\LOGGER();

      if(!empty($dbConfig["wurmZonesDB"]))
      {
  	  	$this->_zonesDB = new \WurmUnlimitedAdmin\DATABASE($dbConfig["wurmZonesDB"]);
      }
      else
      {
        throw new PDOException("Missing database configuration");
      }

      if(!empty($rmiConfig["ip"]) && !empty($rmiConfig["port"]) && !empty($rmiConfig["password"]))
      {
        $this->_serverRMI = new \WurmUnlimitedAdmin\RMI();
      }
      else
      {
        throw new Exception("Missing RMI configuration");
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
   * Gets all the players in the server
   * @param string $playerID If supplied should get everything for only one player
   */
  function GetVillages($villageID = "")
  {
    try
    {
      $result = array();

      $villageNames = array("No kingdom", "Jenn-Kellon", "Mol Rehan", "Horde of the Summoned", "freedom Isles");

      if(!empty($villageID))
      {
        $sql = $this->_zonesDB->QueryWithBinds("SELECT * FROM VILLAGES WHERE ID = ?", array($villageID));
        $village = $sql->fetch(PDO::FETCH_ASSOC);
        $village["CREATIONDATE"] = date("m/d/Y H:i:s", $village["CREATIONDATE"] / 1000);
        $village["KINGDOMNAME"] = $villageNames[$village["KINGDOM"]];
        $village["UPKEEP"] = wurmConvertMoney($village["UPKEEP"]);
        $village["success"] = true;

        $result = $village;

      }
      else
      {
        $sql = $this->_zonesDB->QueryWithOutBinds("SELECT * FROM VILLAGES ORDER BY NAME");
        while($village = $sql->fetch(PDO::FETCH_ASSOC))
        {
          $village["CREATIONDATE"] = date("m/d/Y H:i:s", $village["CREATIONDATE"] / 1000);
          $village["KINGDOMNAME"] = $villageNames[$village["KINGDOM"]];
          $village["UPKEEP"] = wurmConvertMoney($village["UPKEEP"]);
          array_push($result, $village);
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

  function __destruct()
  {
  	$this->_zonesDB = null;
    $this->_serverRMI = null;
    $this->_Logger = null;
  }

}
?>