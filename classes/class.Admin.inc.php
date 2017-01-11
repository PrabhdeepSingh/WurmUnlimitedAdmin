<?php
spl_autoload_register(function ($class_name) {
	include(dirname(__FILE__) . "/class." . ucfirst(strtolower($class_name)) . ".inc.php");
});

class ADMIN
{

	private $_database;

	function __construct()
	{
		try
		{
			require(dirname(__FILE__) . "/../includes/config.php");

			$this->_database = new DATABASE($application["appDB"]);
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
	 * Creates a account for an admin (GM) to sign in to this system
	 * @param array $params Contains username, password and level
	 */
	function Create($params = array())
	{
		$result = array();

		if(isset($params["username"]) && isset($params["password"]) && isset($params["level"]))
		{
			$username = strtolower($params["username"]);

			$sql = $this->_database->QueryWithBinds("SELECT USERNAME FROM accounts WHERE USERNAME = ?", array($username));
			$check = $sql->fetchAll();
			if($check != false)
			{
				$result = array("success" => false, "message" => "inuse");
			}
			else
			{
				$options = ['cost' => 12];
				$hashedPassword = password_hash($params["password"], PASSWORD_BCRYPT, $options);
				$sql = $this->_database->QueryWithBinds("INSERT INTO accounts (USERNAME, PASSWORD, LEVEL) VALUES (?, ?, ?);", array($username, $hashedPassword, $params["level"]));
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

	/**
	 * Gets a list of all the application admins
	 *
	 * @return array $result List of admins
	 */
	function GetUsers($accountID = "")
	{
		$result = array();
		if(!empty($accountID))
		{
			$sql = $this->_database->QueryWithBinds("SELECT USERNAME, LEVEL FROM accounts WHERE ID = ?", array($accountID));
			$user = $sql->fetch(PDO::FETCH_ASSOC);
			$user["userPicutre"] = "avatar_".strtolower($user['USERNAME'][0])."_120.png";
			$user["success"] = true;

			$result = $user;
		}
		else
		{
			$sql = $this->_database->QueryWithOutBinds("SELECT ID, USERNAME, LEVEL FROM accounts");
			while($users = $sql->fetch(PDO::FETCH_ASSOC))
			{
				$users["image"] = "avatar_".strtolower($users['USERNAME'][0])."_120.png";
				array_push($result, $users);
			}
		}

		return $result;

	}

	/**
	 * Resets an application account password
	 * @param string $accountID The users account ID
	 */
	function ResetPassword($accountID = "")
	{
		$result = array();
		if(!empty($accountID))
		{

			$sql = $this->_database->QueryWithBinds("SELECT USERNAME FROM accounts WHERE ID = ?", array($accountID));
			$check = $sql->fetchAll();
			if($check != false)
			{
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$charactersLength = strlen($characters);
				$randomString = '';
				for ($i = 0; $i < 10; $i++) {
					$randomString .= $characters[rand(0, $charactersLength - 1)];
				}

				$options = ['cost' => 12];
				$hashedPassword = password_hash($randomString, PASSWORD_BCRYPT, $options);
				$sql = $this->_database->QueryWithBinds("UPDATE accounts SET PASSWORD = ? WHERE ID = ?;", array($hashedPassword, $accountID));
				if($sql->rowCount() > 0)
				{
				 $result = array("success" => true, "password" => $randomString);
				}
				else
				{
				 $result = array("success" => false);
				}
			}
			else
			{
				$result = array("success" => false, "message" => "Invalid");
			}

		}
		else
		{
			$result = array("success" => false, "message" => "Empty params");
		}

		return $result;

	}

	function ChangeLevel($params = array())
	{
		$result = array();

		if(!empty($params["accountID"]) && !empty($params["level"]))
		{

			$sql = $this->_database->QueryWithBinds("SELECT USERNAME FROM accounts WHERE ID = ?", array($params["accountID"]));
			$check = $sql->fetchAll();
			if($check != false)
			{
				$sql = $this->_database->QueryWithBinds("UPDATE accounts SET LEVEL = ? WHERE ID = ?;", array($params["level"], $params["accountID"]));
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
				$result = array("success" => false, "message" => "Invalid");
			}

		}
		else
		{
			$result = array("success" => false, "message" => "Empty params");
		}

		return $result;

	}

	function __destruct()
	{
		$this->_database = null;
	}

}
?>