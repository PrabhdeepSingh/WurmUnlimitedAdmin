<?php
namespace WurmUnlimitedAdmin;
use PDO;
use PDOException;
use Exception;

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

      if(!empty($dbConfig["wurmPlayersDB"]) && !empty($dbConfig["wurmItemsDB"]))
      {
  	  	$this->_playerDB = new \WurmUnlimitedAdmin\DATABASE($dbConfig["wurmPlayersDB"]);
        $this->_itemDB = new \WurmUnlimitedAdmin\DATABASE($dbConfig["wurmItemsDB"]);
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

  /**
   * Gets all the players in the server
   * @param string $playerID If supplied should get everything for only one player
   */
  function GetPlayers($playerID = "")
  {
    $result = array();

    if(!empty($playerID))
    {
      $sql = $this->_playerDB->QueryWithBinds("SELECT BANEXPIRY, BANNED, BANREASON, CREATIONDATE, CHEATED, CHEATREASON, EMAIL, INVENTORYID, IPADDRESS, KINGDOM, LASTLOGOUT, MONEY, MUTED, MUTETIMES, MUTEEXPIRY, MUTEREASON, NAME, PLAYINGTIME, POWER, WURMID FROM PLAYERS WHERE WURMID = ?", array($playerID));
      $user = $sql->fetch(PDO::FETCH_ASSOC);
      $user["BANEXPIRY"] = ($user["BANEXPIRY"] != "" || $user["BANEXPIRY"] != "0") ? date("m/d/Y H:i:s", $user["BANEXPIRY"] / 1000) : $user["BANEXPIRY"];
      $user["CREATIONDATE"] = date("m/d/Y H:i:s", $user["CREATIONDATE"] / 1000);
      $user["LASTLOGOUT"] = date("m/d/Y H:i:s", $user["LASTLOGOUT"] / 1000);
      $user["MUTEEXPIRY"] = ($user["MUTEEXPIRY"] != "" || $user["MUTEEXPIRY"] != "0") ? date("m/d/Y H:i:s", $user["MUTEEXPIRY"] / 1000) : $user["MUTEEXPIRY"];
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

  /**
   * Ban or unban a player
   * @param array $params Contains data related to banning or unbanning
   *
   * @return array $result Contains true or false
   */
  function BanUnban($params = array())
  {
    $result = array();
    if(!empty($params))
    {
      /**
       * $params["action"] can only be 0 or 1, 0 means unban, 1 means ban
       */
      if($params["action"] == 0)
      {
        $sql = $this->_playerDB->QueryWithBinds("SELECT IPADDRESS FROM PLAYERS WHERE WURMID = ?;", array($params["wurmID"]));
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if($user != false)
        {
          $sql = $this->_playerDB->QueryWithBinds("UPDATE PLAYERS SET BANNED = ?, BANEXPIRY = ?, BANREASON = ? WHERE WURMID = ?;", array(0, 0, "", $params["wurmID"]));
          
          if($sql)
          {
            $sql = $this->_playerDB->QueryWithBinds("DELETE FROM BANNEDIPS WHERE IPADDRESS = ?;", array($user["IPADDRESS"]));
          
            if($sql)
            {
              $result = array("success" => true);
            }
            else
            {
              $result = array("success" => false);
            }
          }
          else
          {
            $result = array("success" => false);
          }

        }
        else
        {
          $result = array("success" => false, "message" => "Not a player");
        }

      }
      else if($params["action"] == 1)
      {
        $sql = $this->_playerDB->QueryWithBinds("SELECT IPADDRESS FROM PLAYERS WHERE WURMID = ?;", array($params["wurmID"]));
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if($user != false)
        {
          $banExpiryToMili = round(microtime(true) * 1000) + (int) $params["banDays"] * 86400000;
          $sql = $this->_playerDB->QueryWithBinds("UPDATE PLAYERS SET BANNED = ?, BANEXPIRY = ?, BANREASON = ? WHERE WURMID = ?;", array(1, $banExpiryToMili, $params["banReason"], $params["wurmID"]));
          
          if($sql)
          {
            $sql = $this->_playerDB->QueryWithBinds("INSERT INTO BANNEDIPS (IPADDRESS, BANREASON, BANEXPIRY) VALUES(?,?,?);", array($user["IPADDRESS"], $params["banReason"], $banExpiryToMili));
            
            if($sql)
            {
              $result = array("success" => true, "BANEXPIRY" => date("m/d/Y H:i:s", $banExpiryToMili / 1000));
            }
            else
            {
              $result = array("success" => false);
            }

          }
          else
          {
            $result = array("success" => false);
          }

        }
        else
        {
          $result = array("success" => false, "message" => "Not a player");
        }

      }
      else
      {
        $result = array("success" => false, "message" => "Not a valid action");
      }

    }

    return $result;

  }

  /**
   * Mute or unmute a player
   * @param array $params Contains data related to muting or unmuting
   *
   * @return array $result Contains true or false
   */
  function MuteUnmute($params = array())
  {
    $result = array();
    
    if(!empty($params))
    {
      /**
       * $params["action"] can only be 0 or 1, 0 means unmute, 1 means muted
       */
      if($params["action"] == 0)
      {
        $sql = $this->_playerDB->QueryWithBinds("UPDATE PLAYERS SET MUTED = ?, MUTEEXPIRY = ?, MUTEREASON = ? WHERE WURMID = ?;", array(0, 0, "", $params["wurmID"]));
        
        if($sql)
        {
          $result = array("success" => true);
        }
        else
        {
          $result = array("success" => false);
        }

      }
      else if($params["action"] == 1)
      {
        $muteExpiryToMili = round(microtime(true) * 1000) + (int) $params["muteHours"] * 3600000;
        $sql = $this->_playerDB->QueryWithBinds("UPDATE PLAYERS SET MUTETIMES = MUTETIMES + 1, MUTED = ?, MUTEEXPIRY = ?, MUTEREASON = ? WHERE WURMID = ?;", array(1, $muteExpiryToMili, $params["muteReason"], $params["wurmID"]));
        
        if($sql)
        {
          $result = array("success" => true, "MUTEEXPIRY" => date("m/d/Y H:i:s", $muteExpiryToMili / 1000));
        }
        else
        {
          $result = array("success" => false);
        }

      }
      else
      {
        $result = array("success" => false, "message" => "Not a valid action");
      }

    }

    return $result;

  }

  /**
   * Changes the players in-game powers
   * @param array $params Contains players wurmID and what power to change to
   *
   * @return array $result Contains true or false
   */
  function ChangePower($params = array())
  {
    $result = array();
    
    if(!empty($params))
    {
      $sql = $this->_playerDB->QueryWithBinds("UPDATE PLAYERS SET POWER = ? WHERE WURMID = ?;", array($params["power"], $params["wurmID"]));
          
      if($sql)
      {
        $result = array("success" => true);
      }
      else
      {
        $result = array("success" => false);
      }

    }

    return $result;

  }

  /**
   * Adds money to a player's bank account
   * @param array $params Contains players wurmID and money to add
   *
   * @return array $result Contains true or false
   */
  function AddMoney($params = array())
  {
    $result = array();
    
    if(!empty($params))
    {
      $sql = $this->_playerDB->QueryWithBinds("UPDATE PLAYERS SET MONEY = MONEY + ? WHERE WURMID = ?;", array($params["money"], $params["wurmID"]));
          
      if($sql)
      {
        $sql = $this->_playerDB->QueryWithBinds("SELECT MONEY FROM PLAYERS WHERE WURMID = ?;", array($params["wurmID"]));
        $user = $sql->fetch(PDO::FETCH_ASSOC);
        if($user != false)
        {
          $result = array("success" => true, "money" => wurmConvertMoney($user["MONEY"]));
        }
        else
        {
          $result = array("success" => false);
        }

      }
      else
      {
        $result = array("success" => false);
      }

    }

    return $result;

  }

  /**
   * Changes the players email address
   * @param array $params Contains players wurmID and new email address
   *
   * @return array $result Contains true or false
   */
  function ChangeEmail($params = array())
  {
    $result = array();
    
    if(!empty($params))
    {
      $sql = $this->_playerDB->QueryWithBinds("UPDATE PLAYERS SET EMAIL = ? WHERE WURMID = ?;", array($params["email"], $params["wurmID"]));
          
      if($sql)
      {
        $sql = $this->_playerDB->QueryWithBinds("INSERT INTO PLAYEREHISTORYEMAIL (PLAYERID,EMAIL_ADDRESS,DATED) VALUES(?,?,?);", array($params["wurmID"], $params["email"], round(microtime(true) * 1000)));
        if($sql)
        {
          $result = array("success" => true);
        }
        else
        {
          $result = array("success" => false);
        }

      }
      else
      {
        $result = array("success" => false);
      }

    }

    return $result;

  }

  /**
   * Changes the players kingdom
   * @param array $params Contains players wurmID and new kingdom
   *
   * @return array $result Contains true or false
   */
  function ChangeKingdom($params = array())
  {
    $result = array();
    
    if(!empty($params))
    {
      $sql = $this->_playerDB->QueryWithBinds("UPDATE PLAYERS SET KINGDOM = ? WHERE WURMID = ?;", array($params["kingdom"], $params["wurmID"]));
          
      if($sql)
      {
        $result = array("success" => true);
      }
      else
      {
        $result = array("success" => false);
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