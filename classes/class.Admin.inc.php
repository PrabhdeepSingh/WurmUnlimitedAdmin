<?php
namespace WurmUnlimitedAdmin;
use PDO;

class ADMIN
{

	private $_database;

  function __construct()
  {

  	try
  	{
  		require(dirname(__FILE__) . "/../includes/config.php");
	  	require(dirname(__FILE__) . "/class.Database.inc.php");

	  	$this->_database = new \WurmUnlimitedAdmin\DATABASE($dbConfig["appDB"]);
	  }
	  catch(EXCEPTION $ex)
	  {
	  	throw new EXCEPTION("Failed");
	  }

  }

  /**
   * Creates a account for an admin (GM) to sign in to this system
   * @param array $params Contains username, password and level
   */
  function Create($params = array())
  {
  	$result = array();

  	if(isset($params["username"]) && isset($params["password"]) && isset($params["level"]))
  	{
      $sql = $this->_database->QueryWithBinds("SELECT USERNAME FROM accounts WHERE USERNAME = ?", array($params["username"]));
      $check = $sql->fetchAll();
      if($check != false)
      {
        $result = array("success" => false, "message" => "inuse");
      }
      else
      {
        $options = ['cost' => 12];
        $hashedPassword = password_hash($params["password"], PASSWORD_BCRYPT, $options);
        $sql = $this->_database->QueryWithBinds("INSERT INTO accounts (USERNAME, PASSWORD, LEVEL) VALUES (?, ?, ?);", array($params["username"], $hashedPassword, $params["level"]));
        if($sql->rowCount() > 0)
        {
         $result = array("success" => true);
        }
        else
        {
         $result = array("success" => false);
        }

      }

  	}
  	else
  	{
  		$result = array("success" => false, "message" => "Empty params");
  	}

  	return $result;

  }

  /**
   * Deletes an account from the accounts table
   * @param string $accountID ID of the account
   */
  function Delete($accountID = "")
  {
  	$result = array();

  	if(!empty($accountID))
  	{
  		$sql = $this->_database->QueryWithBinds("DELETE FROM accounts WHERE ID = ?", array($accountID));

	    if($sql->rowCount() > 0)
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
  		$result = array("success" => false, "message" => "No ID supplied");
  	}

  	return $result;

  }

  function GetUsers()
  {
  	$result = array();

  	$sql = $this->_database->QueryWithOutBinds("SELECT ID, USERNAME, LEVEL FROM accounts");
  	while($users = $sql->fetch(PDO::FETCH_ASSOC))
  	{
  		$users["image"] = "../../assets/images/avatars/avatar_".strtolower($users['USERNAME'][0])."_120.png";
  		array_push($result, $users);
  	}

  	return $result;

  }

  function __destruct()
  {
  	$this->_database = null;
  }

}
?>