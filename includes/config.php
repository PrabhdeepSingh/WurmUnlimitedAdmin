<?php
if(!defined("DEVELOPMENT")) define("DEVELOPMENT", 0);
if(!defined("PRODUCTION")) define("PRODUCTION", 1);

/**
 * This array is used through out the website
 * @var mode          Determines if errors should show or stay hidden
 * @var rootPath      The web address to this software
 * @var minAdminLevel This determines if the user is able to see the admin page ( add users, edit users ) and server settings page
 * @var version       This is just a versioning variable nothing else
 */
$application = array(
	"mode" => DEVELOPMENT,
	"minAdminLevel" => 5,
	"version" => "1.0.0",
	"appDB" => dirname(__FILE__) . "/sqlite/app.db",
	"wuaClientLocation" => dirname(__FILE__) . "/WUAHelper.jar",
);

$servers = array(
	array(
		"absolutePath" => "/path/to/wurm-server/world-dir",
		"serverId" => 0,
		"ip" => "",
		"port" => 7220,
		"password" => ""
	),
	// array(
	// 	"absolutePath" => "/path/to/wurm-server/world-dir",
	//	"serverId" => 0,
	// 	"ip" => "",
	// 	"port" => 7220,
	// 	"password" => ""
	// ),
);