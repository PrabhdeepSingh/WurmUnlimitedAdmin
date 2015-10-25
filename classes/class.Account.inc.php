<?php
namespace WurmUnlimitedAdmin;
use PDO;

class ACCOUNT
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

  /**
   * Valid user
   * @param array $params Contains username and password
   *
   * @return array true:false
   */
  function Login($params = array())
  {
    try
    {
    	$result = array();

    	if(!empty($params))
    	{
    		$sql = $this->_database->QueryWithBinds("SELECT * FROM accounts WHERE USERNAME = ?", array($params["username"]));
        $getData = $sql->fetch(PDO::FETCH_ASSOC);

    		if($getData != false)
    		{
    			$hashedPassword = password_verify($params["password"], $getData["PASSWORD"]);

    			if($hashedPassword)
    			{
    				$result = array("success" => true, "level" => $getData["LEVEL"]);
    			}
    			else
    			{
    				$result = array("success" => false, "message" => "Incorrect");
    			}

    		}
    		else
    		{
    			$result = array("success" => false, "message" => "Invalid");
    		}

    	}
    	else
    	{
    		$result = array("success" => false, "message" => "Empty");
    	}

    	return $result;
    }
    catch(PDOExecption $ex)
    {
      throw new PDOExecption(json_encode($ex));
    }

  }

  function __destruct()
  {
  	$this->_database = null;
  }

}
?>