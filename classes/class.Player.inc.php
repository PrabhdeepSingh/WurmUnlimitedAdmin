<?php
namespace WurmUnlimitedAdmin;

use PDO;
use PDOException;
use Exception;

class PLAYER
{

	private $_playerDB;
  private $_itemDB;
  private $_serverRMI;

  function __construct()
  {
  	try
  	{
      require(dirname(__FILE__) . "/../includes/config.php");
      require(dirname(__FILE__) . "/../includes/functions.php");
      require(dirname(__FILE__) . "/class.Database.inc.php");
      require(dirname(__FILE__) . "/class.RMI.inc.php");

      if(!empty($dbConfig["wurmPlayersDB"]) && !empty($dbConfig["wurmItemsDB"]))
      {
  	  	$this->_playerDB = new \WurmUnlimitedAdmin\DATABASE($dbConfig["wurmPlayersDB"]);
        $this->_itemDB = new \WurmUnlimitedAdmin\DATABASE($dbConfig["wurmItemsDB"]);
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
        $sql = $this->_playerDB->QueryWithBinds("SELECT NAME, IPADDRESS FROM PLAYERS WHERE WURMID = ?;", array($params["wurmID"]));
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if($user != false)
        {
          try
          {
            $output = $this->_serverRMI->Execute("pardon", array($user["NAME"], $user["IPADDRESS"]));

            if($output[0] == true)
            {
              $result = array("success" => true);
            }
            else
            {
              $result = array("success" => false, "message" => "Unable to unban");
            }

          }
          catch(Exception $ex)
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
        $sql = $this->_playerDB->QueryWithBinds("SELECT NAME, IPADDRESS FROM PLAYERS WHERE WURMID = ?;", array($params["wurmID"]));
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if($user != false)
        {
          try
          {
            $banExpiryToMili = round(microtime(true) * 1000) + (int) $params["banDays"] * 86400000;
            $output = $this->_serverRMI->Execute("ban", array($user["NAME"], $user["IPADDRESS"], $params["banReason"], $params["banDays"]));

            if($output[0] == true)
            {
              $result = array("success" => true, "BANEXPIRY" => date("m/d/Y H:i:s", $banExpiryToMili / 1000));
            }
            else
            {
              $result = array("success" => false, "message" => "Unable to ban");
            }

          }
          catch(Exception $ex)
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
   * Mute or unmute a player (This does not working yet)
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
        $sql = $this->_playerDB->QueryWithBinds("SELECT NAME FROM PLAYERS WHERE WURMID = ?;", array($params["wurmID"]));
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if($user != false)
        {
          try
          {
            $output = $this->_serverRMI->Execute("unMutePlayer", array($user["NAME"]));

            if($output[0] == true)
            {
              $result = array("success" => true);
            }
            else
            {
              $result = array("success" => false, "message" => "Unable to unmute");
            }

          }
          catch(Exception $ex)
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
        $sql = $this->_playerDB->QueryWithBinds("SELECT NAME FROM PLAYERS WHERE WURMID = ?;", array($params["wurmID"]));
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if($user != false)
        {
          try
          {
            $muteExpiryToMili = round(microtime(true) * 1000) + (int) $params["muteHours"] * 3600000;
            $output = $this->_serverRMI->Execute("mutePlayer", array($user["NAME"], $params["muteReason"], $params["muteHours"]));

            if($output[0] == true)
            {
              $result = array("success" => true, "MUTEEXPIRY" => date("m/d/Y H:i:s", $muteExpiryToMili / 1000));
            }
            else
            {
              $result = array("success" => false, "message" => "Unable to mute");
            }

          }
          catch(Exception $ex)
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
      $sql = $this->_playerDB->QueryWithBinds("SELECT NAME FROM PLAYERS WHERE WURMID = ?;", array($params["wurmID"]));
      $user = $sql->fetch(PDO::FETCH_ASSOC);

      if($user != false)
      {
        try
        {
          $output = $this->_serverRMI->Execute("changePower", array($user["NAME"], $params["power"]));

          if($output[0] == true)
          {
            $result = array("success" => true);
          }
          else
          {
            $result = array("success" => false, "message" => "Unable to change power");
          }

        }
        catch(Exception $ex)
        {
          $result = array("success" => false);
        }

      }
      else
      {
        $result = array("success" => false, "message" => "Not a player");
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
      $sql = $this->_playerDB->QueryWithBinds("SELECT NAME, MONEY FROM PLAYERS WHERE WURMID = ?;", array($params["wurmID"]));
      $user = $sql->fetch(PDO::FETCH_ASSOC);

      if($user != false)
      {
        try
        {
          $output = $this->_serverRMI->Execute("addMoney", array($user["NAME"], $params["money"]));

          if($output[0] == true)
          {
            $result = array("success" => true, "money" => wurmConvertMoney($params["money"]), "totalMoney" => wurmConvertMoney($user["MONEY"] + $params["money"]));
          }
          else
          {
            $result = array("success" => false, "message" => "Unable to money");
          }

        }
        catch(Exception $ex)
        {
          $result = array("success" => false);
        }

      }
      else
      {
        $result = array("success" => false, "message" => "Not a player");
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
      $sql = $this->_playerDB->QueryWithBinds("SELECT NAME, EMAIL FROM PLAYERS WHERE WURMID = ?;", array($params["wurmID"]));
      $user = $sql->fetch(PDO::FETCH_ASSOC);

      if($user != false)
      {
        try
        {
          $output = $this->_serverRMI->Execute("changeEmail", array($user["NAME"], $user["EMAIL"], $params["email"]));

          if($output[0] == true)
          {
            $result = array("success" => true);
          }
          else
          {
            $result = array("success" => false, "message" => "Unable to change email");
          }

        }
        catch(Exception $ex)
        {
          $result = array("success" => false);
        }

      }
      else
      {
        $result = array("success" => false, "message" => "Not a player");
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
      $sql = $this->_playerDB->QueryWithBinds("SELECT NAME FROM PLAYERS WHERE WURMID = ?;", array($params["wurmID"]));
      $user = $sql->fetch(PDO::FETCH_ASSOC);

      if($user != false)
      {
        try
        {
          $output = $this->_serverRMI->Execute("changeKingdom", array($user["NAME"], $params["kingdom"]));

          if($output[0] == true)
          {
            $result = array("success" => true);
          }
          else
          {
            $result = array("success" => false, "message" => "Unable to change kingdom");
          }

        }
        catch(Exception $ex)
        {
          $result = array("success" => false);
        }

      }
      else
      {
        $result = array("success" => false, "message" => "Not a player");
      }

    }

    return $result;

  }

  /**
   * Gets all the items in the players inventory
   * @param string $playerID The players wurm ID
   */
  function GetInventory($playerID = "")
  {
    $result = array();

    if(!empty($playerID))
    {
      $sql = $this->_itemDB->QueryWithBinds("SELECT CREATIONDATE, CREATOR, DAMAGE, NAME, ORIGINALQUALITYLEVEL, QUALITYLEVEL, RARITY, WEIGHT FROM ITEMS WHERE OWNERID = ? AND NAME != ?", array($playerID, "inventory"));
      while($items = $sql->fetch(PDO::FETCH_ASSOC))
      {
        array_push($result, $items);
      }

    }

    return $result;

  }

  /**
   * Gets all the players skills
   * @param string $playerID The players wurm ID
   */
  function GetSkills($playerID = "")
  {
    $result = array();

    if(!empty($playerID))
    {
      $sql = $this->_playerDB->QueryWithBinds("SELECT NUMBER, VALUE, MINVALUE FROM SKILLS WHERE OWNER = ? ORDER BY NUMBER", array($playerID));
      while($items = $sql->fetch(PDO::FETCH_ASSOC))
      {
        switch ($items["NUMBER"]) {
          case 2147483646:
            $items["NAME"] = "CHARACTERISTICS";
            break;
          case 2147483645:
            $items["NAME"] = "FAITH";
            break;
          case 2147483644:
            $items["NAME"] = "FAVOR";
            break;
          case 2147483643:
            $items["NAME"] = "RELIGION";
            break;
          case 2147483642:
            $items["NAME"] = "ALIGNMENT";
            break;
          case 1:
            $items["NAME"] = "BODY";
            break;
          case 2:
            $items["NAME"] = "MIND";
            break;
          case 3:
            $items["NAME"] = "SOUL";
            break;
          case 100:
            $items["NAME"] = "MIND LOGIC";
            break;
          case 101:
            $items["NAME"] = "MIND SPEED";
            break;
          case 102:
            $items["NAME"] = "BODY STRENGTH";
            break;
          case 103:
            $items["NAME"] = "BODY STAMINA";
            break;
          case 104:
            $items["NAME"] = "BODY CONTROL";
            break;
          case 105:
            $items["NAME"] = "SOUL STRENGTH";
            break;
          case 106:
            $items["NAME"] = "SOUL DEPTH";
            break;
          case 1000:
            $items["NAME"] = "SWORDS";
            break;
          case 1001:
            $items["NAME"] = "KNIVES";
            break;
          case 1002:
            $items["NAME"] = "SHIELDS";
            break;
          case 1003:
            $items["NAME"] = "AXES";
            break;
          case 1004:
            $items["NAME"] = "MAULS";
            break;
          case 1005:
            $items["NAME"] = "CARPENTRY";
            break;
          case 1007:
            $items["NAME"] = "WOODCUTTING";
            break;
          case 1008:
            $items["NAME"] = "MINING";
            break;
          case 1009:
            $items["NAME"] = "DIGGING";
            break;
          case 1010:
            $items["NAME"] = "FIREMAKING";
            break;
          case 1011:
            $items["NAME"] = "POTTERY";
            break;
          case 1012:
            $items["NAME"] = "TAILORING";
            break;
          case 1013:
            $items["NAME"] = "MASONRY";
            break;
          case  1014:
            $items["NAME"] = "ROPEMAKING";
            break;
          case  1015:
            $items["NAME"] = "SMITHING";
            break;
          case  1016:
            $items["NAME"] = "WEAPON SMITHING";
            break;
          case  1017:
            $items["NAME"] = "ARMOUR SMITHING";
            break;
          case  1018:
            $items["NAME"] = "COOKING";
            break;
          case  1019:
            $items["NAME"] = "NATURE";
            break;
          case  1020:
            $items["NAME"] = "MISCELLANEOUS";
            break;
          case  1021:
            $items["NAME"] = "ALCHEMY";
            break;
          case  1022:
            $items["NAME"] = "TOYS";
            break;
          case  1023:
            $items["NAME"] = "FIGHTING";
            break;
          case  1024:
            $items["NAME"] = "HEALING";
            break;
          case  1025:
            $items["NAME"] = "CLUBS";
            break;
          case  1026:
            $items["NAME"] = "RELIGION";
            break;
          case  1027:
            $items["NAME"] = "HAMMERS";
            break;
          case  1028:
            $items["NAME"] = "THIEVERY";
            break;
          case  1029:
            $items["NAME"] = "WARMACHINES";
            break;
          case  1030:
            $items["NAME"] = "ARCHERY";
            break;
          case  1031:
            $items["NAME"] = "BOWYERY";
            break;
          case  1032:
            $items["NAME"] = "FLETCHING";
            break;
          case  1033:
            $items["NAME"] = "POLEARMS";
            break;
          case 10001:
            $items["NAME"] = "SMALL AXE";
            break;
          case 10002:
            $items["NAME"] = "SHOVEL";
            break;
          case 10003:
            $items["NAME"] = "HATCHET";
            break;
          case 10004:
            $items["NAME"] = "RAKE";
            break;
          case 10005:
            $items["NAME"] = "LONG SWORD";
            break;
          case 10006:
            $items["NAME"] = "MEDIUM METAL SHIELD";
            break;
          case 10007:
            $items["NAME"] = "CARVING KNIFE";
            break;
          case 10008:
            $items["NAME"] = "SAW";
            break;
          case 10009:
            $items["NAME"] = "PICKAXE";
            break;
          case 10010:
            $items["NAME"] = "WEAPON BLADES";
            break;
          case 10011:
            $items["NAME"] = "WEAPON HEADS";
            break;
          case 10012:
            $items["NAME"] = "ARMOUR CHAIN";
            break;
          case 10013:
            $items["NAME"] = "ARMOUR PLATE";
            break;
          case 10014:
            $items["NAME"] = "SHIELDS";
            break;
          case 10015:
            $items["NAME"] = "BLACKSMITHING";
            break;
          case 10016:
            $items["NAME"] = "CLOTHTAILORING";
            break;
          case 10017:
            $items["NAME"] = "LEATHERWORKING";
            break;
          case 10018:
            $items["NAME"] = "TRACKING";
            break;
          case 10019:
            $items["NAME"] = "SMALL WOOD SHIELD";
            break;
          case 10020:
            $items["NAME"] = "MEDIUM WOOD SHIELD";
            break;
          case 10021:
            $items["NAME"] = "LARGE WOOD SHIELD";
            break;
          case 10022:
            $items["NAME"] = "SMALL METAL SHIELD";
            break;
          case 10023:
            $items["NAME"] = "LARGE METAL SHIELD";
            break;
          case 10024:
            $items["NAME"] = "LARGE AXE";
            break;
          case 10025:
            $items["NAME"] = "HUGE AXE";
            break;
          case 10026:
            $items["NAME"] = "HAMMER";
            break;
          case 10027:
            $items["NAME"] = "SHORT SWORD";
            break;
          case 10028:
            $items["NAME"] = "TWOHANDED SWORD";
            break;
          case 10029:
            $items["NAME"] = "BUTCHERING KNIFE";
            break;
          case 10030:
            $items["NAME"] = "STONE CHISEL";
            break;
          case 10031:
            $items["NAME"] = "PAVING";
            break;
          case 10032:
            $items["NAME"] = "PROSPECT";
            break;
          case 10033:
            $items["NAME"] = "FISHING";
            break;
          case 10034:
            $items["NAME"] = "LOCKSMITHING";
            break;
          case 10035:
            $items["NAME"] = "REPAIR";
            break;
          case 10036:
            $items["NAME"] = "COALING";
            break;
          case 10037:
            $items["NAME"] = "COOKING DAIRIES";
            break;
          case 10038:
            $items["NAME"] = "COOKING STEAKING";
            break;
          case 10039:
            $items["NAME"] = "COOKING BAKING";
            break;
          case 10040:
            $items["NAME"] = "MILLING";
            break;
          case 10041:
            $items["NAME"] = "METALLURGY";
            break;
          case 10042:
            $items["NAME"] = "ALCHEMY NATURAL";
            break;
          case 10043:
            $items["NAME"] = "GOLDSMITHING";
            break;
          case 10044:
            $items["NAME"] = "CARPENTRY FINE";
            break;
          case 10045:
            $items["NAME"] = "GARDENING";
            break;
          case 10046:
            $items["NAME"] = "SICKLE";
            break;
          case 10047:
            $items["NAME"] = "SCYTHE";
            break;
          case 10048:
            $items["NAME"] = "FORESTRY";
            break;
          case 10049:
            $items["NAME"] = "FARMING";
            break;
          case 10050:
            $items["NAME"] = "YOYO";
            break;
          case 10051:
            $items["NAME"] = "TOYMAKING";
            break;
          case 10052:
            $items["NAME"] = "WEAPONLESS FIGHTING";
            break;
          case 10053:
            $items["NAME"] = "FIGHT AGGRESSIVESTYLE";
            break;
          case 10054:
            $items["NAME"] = "FIGHT DEFENSIVESTYLE";
            break;
          case 10055:
            $items["NAME"] = "FIGHT NORMALSTYLE";
            break;
          case 10056:
            $items["NAME"] = "FIRSTAID";
            break;
          case 10057:
            $items["NAME"] = "TAUNTING";
            break;
          case 10058:
            $items["NAME"] = "SHIELDBASHING";
            break;
          case 10059:
            $items["NAME"] = "BUTCHERING";
            break;
          case 10060:
            $items["NAME"] = "MILKING";
            break;
          case 10061:
            $items["NAME"] = "LARGE MAUL";
            break;
          case 10062:
            $items["NAME"] = "MEDIUM MAUL";
            break;
          case 10063:
            $items["NAME"] = "SMALL MAUL";
            break;
          case 10064:
            $items["NAME"] = "HUGE CLUB";
            break;
          case 10065:
            $items["NAME"] = "PREACHING";
            break;
          case 10066:
            $items["NAME"] = "PRAYER";
            break;
          case 10067:
            $items["NAME"] = "CHANNELING";
            break;
          case 10068:
            $items["NAME"] = "EXORCISM";
            break;
          case 10069:
            $items["NAME"] = "ARTIFACTS";
            break;
          case 10070:
            $items["NAME"] = "WARHAMMER";
            break;
          case 10071:
            $items["NAME"] = "FORAGING";
            break;
          case 10072:
            $items["NAME"] = "BOTANIZING";
            break;
          case 10073:
            $items["NAME"] = "CLIMBING";
            break;
          case 10074:
            $items["NAME"] = "STONECUTTING";
            break;
          case 10075:
            $items["NAME"] = "STEALING";
            break;
          case 10076:
            $items["NAME"] = "LOCKPICKING";
            break;
          case 10077:
            $items["NAME"] = "CATAPULT";
            break;
          case 10078:
            $items["NAME"] = "TAMEANIMAL";
            break;
          case 10079:
            $items["NAME"] = "SHORT BOW";
            break;
          case 10080:
            $items["NAME"] = "MEDIUM BOW";
            break;
          case 10081:
            $items["NAME"] = "LONG BOW";
            break;
          case 10082:
            $items["NAME"] = "SHIP BUILDING";
            break;
          case 10083:
            $items["NAME"] = "COOKING BEVERAGES";
            break;
          case 10084:
            $items["NAME"] = "TRAPS";
            break;
          case 10085:
            $items["NAME"] = "BREEDING";
            break;
          case 10086:
            $items["NAME"] = "MEDITATING";
            break;
          case 10087:
            $items["NAME"] = "PUPPETEERING";
            break;
          case 10088:
            $items["NAME"] = "LONG SPEAR";
            break;
          case 10089:
            $items["NAME"] = "HALBERD";
            break;
          case 10090:
            $items["NAME"] = "STAFF";
            break;
          case 10091:
            $items["NAME"] = "PAPYRUSMAKING";
            break;
          case 10092:
            $items["NAME"] = "THATCHING";
            break;
          case 10093:
            $items["NAME"] = "BALLISTA";
            break;
          case 10094:
            $items["NAME"] = "TREBUCHET";
            break;
          case 10095:
            $items["NAME"] = "PEWPEWDIE";
            break;
          default:
            $items["NAME"] = "Uknown ID: " . $items["NUMBER"];
            break;
        }
        array_push($result, $items);
      }

    }

    return $result;

  }

  /**
   * Adds an item to the players inventory
   * @param array $params Contains users wurmID and item template ID
   */
  function AddItem($params = array())
  {
    $result = array();

    if(!empty($params))
    {
      $sql = $this->_playerDB->QueryWithBinds("SELECT NAME FROM PLAYERS WHERE WURMID = ?;", array($params["wurmID"]));
      $user = $sql->fetch(PDO::FETCH_ASSOC);

      if($user != false)
      {
        try
        {
          $output = $this->_serverRMI->Execute("addItem", array($user["NAME"], $params["itemTemplateID"], $params["itemQuality"], $params["itemRarity"], $params["creator"], $params["itemAmount"]));

          if($output[0] == true)
          {
            $result = array("success" => true);
          }
          else
          {
            $result = array("success" => false, "message" => "Unable to add item");
          }

        }
        catch(Exception $ex)
        {
          $result = array("success" => false);
        }

      }
      else
      {
        $result = array("success" => false, "message" => "Not a player");
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