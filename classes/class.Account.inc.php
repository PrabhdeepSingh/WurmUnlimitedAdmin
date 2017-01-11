<?php
spl_autoload_register(function ($class_name) {
	include(dirname(__FILE__) . "/class." . ucfirst(strtolower($class_name)) . ".inc.php");
});

class ACCOUNT
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
	 * Valid user
	 * @param array $params Contains username and password
	 *
	 * @return array true:false
	 */
	function Login($params = array())
	{
		$result = array();

		if(!empty($params))
		{
			$username = strtolower($params["username"]);

			$sql = $this->_database->QueryWithBinds("SELECT * FROM accounts WHERE USERNAME = ?", array($username));
			$getData = $sql->fetch(PDO::FETCH_ASSOC);

			if($getData != false)
			{
				$hashedPassword = password_verify($params["password"], $getData["PASSWORD"]);

				if($hashedPassword)
				{
					$result = array("success" => true, "ID" => $getData["ID"], "level" => $getData["LEVEL"], "user_friendly_level" => $this->ParseLevel($getData["LEVEL"]));
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

	/**
	 * Change user password
	 * @param array $params contains accountID, currentPassword and password (new password)
	 *
	 * @return array true:false
	 */
	function ChangePassword($params = array())
	{
		$result = array();

		if(!empty($params))
		{
			$sql = $this->_database->QueryWithBinds("SELECT PASSWORD FROM accounts WHERE ID = ?", array($params["accountID"]));
			$getData = $sql->fetch(PDO::FETCH_ASSOC);

			if($getData != false)
			{
				$hashedPassword = password_verify($params["currentPassword"], $getData["PASSWORD"]);

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

	function ParseLevel($level = 0) {
		switch ($level) {
			case 0:
				return "Read Only";
			break;
			case 1:
				return "HERO";
			break;
			case 2:
				return "GM";
			break;
			case 3:
				return "High God";
			break;
			case 4:
				return "Arch GM";
			break;
			case 5:
				return "Implementor";
			break;
			default:
				return "Unknown Power Level";
			break;
		}

	}

	function __destruct()
	{
		$this->_database = null;
	}

}