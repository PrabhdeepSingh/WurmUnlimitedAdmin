<?php
namespace WurmUnlimitedAdmin;
use PDO;

class DATABASE
{

	private $_database;

  function __construct($dbName = "")
  {
  	try
    {
      $this->_database = new PDO("sqlite:" . $dbName);
      $this->_database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
    catch(Exception $ex)
    {
      throw new Exception("Could not open application database");
    }

  }


  /**
   * Executes a PDO query with binds (values)
   * @param string $query Query string to execute
   * @param array  $binds Binds to link to the $query
   *
   * @return PDO query result
   */
  function QueryWithBinds($query = "", $binds = array())
  {
  	try
  	{
  		$query = $this->_database->prepare($query);
  		$cleanedBinds = $this->CleanBinds($binds);

  		if($query->execute($cleanedBinds))
  		{
  			return $query;
  		}
  	}
  	catch(Exception $ex)
  	{
  		throw new Exception("Error proccessing query", 1);
  	}

  }

  /**
   * Executes a PDO query without binds
   * @param string $query Query string to execute
   *
   * @return PDO query result
   */
  function QueryWithOutBinds($query = "")
  {
  	try
  	{
  		$query = $this->_database->prepare($query);

      if($query->execute())
      {
  		  return $query;
      }

  	}
  	catch(Exception $ex)
  	{
  		throw new Exception("Error proccessing query", 1);
  	}

  }

  /**
   * Clean binds inputed by the user
   * @param array $bind List of binds
   *
   * @return Cleaned database friend version of binds
   */
  function CleanBinds($bind = array())
  {
    $cleanedBind = array();
    foreach($bind as $value)
    {
      $clean = is_string($value) ? trim($value) : $value;
      $clean = htmlentities(strip_tags($clean), ENT_QUOTES);
      array_push($cleanedBind, $clean);
    }

    return $cleanedBind;

  }

  /**
   * Gets the last ID inserted into a table
   *
   * @return int Row ID
   */
  function LastInsertedID()
  {
  	return $this->_database->lastInsertId();
  }

  function __destruct()
  {
  	$this->_database = null;
  }

}
?>