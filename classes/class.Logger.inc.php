<?php

class LOGGER
{

	private $_logDir;

	function __construct()
	{
		$this->_logDir = dirname(__FILE__) . "/../logs";
		if (!file_exists($this->_logDir)) {
			mkdir($this->_logDir, 0777, true);
		}
	}

	function Log($type = "", $log = "")
	{
		if($type == "Error" || $type == "Warning" || $type == "Info")
		{
			$fh = fopen($this->_logDir . "/" . $type . ".log", (file_exists($this->_logDir . "/" . $type . ".log")) ? 'a' : 'w');
		}
		else
		{
			/**
			 * It's probably a GM log
			 */

			if (!file_exists($this->_logDir . "/gm")) {
				mkdir($this->_logDir . "/gm", 0777, true);
			}

			$fh = fopen($this->_logDir . "/gm/" . $type . ".log", (file_exists($this->_logDir . "/gm/" . $type . ".log")) ? 'a' : 'w');

		}

		$prefix = "[" . date("F j, Y, g:i a") . "] [" . strtoupper($type) . "]: ";

		fwrite($fh, $prefix . $log . "\n");
		fclose($fh);

	}

	function __destruct()
	{
		$this->_logDir = null;
	}

}
?>