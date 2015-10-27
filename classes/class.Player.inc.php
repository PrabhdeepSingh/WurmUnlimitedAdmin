<?php
namespace WurmUnlimitedAdmin;
use PDO;

require(dirname(__FILE__) . "/../includes/functions.php");

class PLAYER
{

	private $_playerDB;
  private $_itemDB;

  function __construct()
  {
  	try
  	{
	  	require(dirname(__FILE__) . "/../includes/config.php");
	  	require(dirname(__FILE__) . "/class.Database.inc.php");

	  	$this->_playerDB = new \WurmUnlimitedAdmin\DATABASE($dbConfig["wurmPlayersDB"]);
      $this->_itemDB = new \WurmUnlimitedAdmin\DATABASE($dbConfig["wurmItemsDB"]);
	  }
	  catch(EXCEPTION $ex)
	  {
	  	throw new EXCEPTION("Failed");
	  }

  }

  /**
   * Gets all the players in the server
   * @param string $playerID If supplied should get everything for only one player
   */
  function GetPlayers($playerID = "")
  {
    $result = array();
    if(!empty($playerID))
    {
      $sql = $this->_playerDB->QueryWithBinds("SELECT BANEXPIRY, BANNED, BANREASON, CREATIONDATE, CHEATED, CHEATREASON, EMAIL, INVENTORYID, IPADDRESS, KINGDOM, LASTLOGOUT, MONEY, NAME, PLAYINGTIME, POWER, WURMID FROM PLAYERS WHERE WURMID = ?", array($playerID));
      $user = $sql->fetch(PDO::FETCH_ASSOC);
      $user["PLAYINGTIME"] = wurmSecondsToTime($user["PLAYINGTIME"]);
      $user["MONEY"] = wurmConvertMoney($user["MONEY"]);
      $user["image"] = "../../assets/images/avatars/avatar_".strtolower($user['NAME'][0])."_120.png";
      $user["success"] = true;

      $result = $user;

    }
    else
    {
      $sql = $this->_playerDB->QueryWithOutBinds("SELECT WURMID, NAME, POWER FROM PLAYERS");
      while($users = $sql->fetch(PDO::FETCH_ASSOC))
      {
        $users["image"] = "../assets/images/avatars/avatar_".strtolower($users['NAME'][0])."_120.png";
        array_push($result, $users);
      }

    }

    return $result;

  }

  function __destruct()
  {
  	$this->_playerDB = null;
    $this->_itemDB = null;
  }

}
?>