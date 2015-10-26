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
    				$result = array("success" => true, "ID" => $getData["ID"], "level" => $getData["LEVEL"]);
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

  /**
   * Change user password
   * @param array $params contains accountID, currentPassword and password (new password)
   *
   * @return array true:false
   */
  function ChangePassword($params = array())
  {
    $result = array();

    try
    {
      $result = array();

      if(!empty($params))
      {
        $sql = $this->_database->QueryWithBinds("SELECT PASSWORD FROM accounts WHERE ID = ?", array($params["accountID"]));
        $getData = $sql->fetch(PDO::FETCH_ASSOC);

        if($getData != false)
        {
          $hashedPassword = password_verify($params["password"], $getData["PASSWORD"]);

          if($hashedPassword)
          {
            $options = ['cost' => 12];
            $newHashedPassword = password_hash($params["password"], PASSWORD_BCRYPT, $options);
            $sql = $this->_database->QueryWithBinds("UPDATE accounts SET PASSWORD = ? WHERE ID = ?", array($newHashedPassword, $params["accountID"]));
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

    return $result;
  
  }

  function __destruct()
  {
  	$this->_database = null;
  }

}
?>