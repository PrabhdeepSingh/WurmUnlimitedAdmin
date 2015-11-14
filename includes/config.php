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
	"rootPath" => "//localhost/wurmunlimitedadmin/", // CHANGE ME
	"minAdminLevel" => 5,
	"version" => "0.0.18-Alpha"
);

/**
 * Location of where your world directory for the wurm server is located NOTE: This has to be the absolute path to your server I.E: D:\GameServers\WurmUnlimited\Server1\XplosiveGames
 */
$serverRoot	= "/path/to/wurm-server/world-dir";

/**
 * This array is used for connecting to different databases
 * @var appDB           Location of the app.db
 * @var wurmCreaturesDB Location of the wurmcreatures.db
 * @var wurmDeitiesDB   Location of the wurmdeities.db
 * @var wurmEconomyDB   Location of the wurmeconomy.db
 * @var wurmItemsDB     Location of the wurmitems.db
 * @var wurmLoginDB     Location of the wurmlogin.db
 * @var wurmLogsDB      Location of the wurmlogs.db
 * @var wurmPlayersDB   Location of the wurmplayers.db
 * @var wurmTemplatesDB Location of the wurmtemplates.db
 * @var wurmZonesDB     Location of the wurmzones.db
 */
$dbConfig = array(
	"appDB" => dirname(__FILE__) . "/sqlite/app.db",
	"wurmCreaturesDB"	=> "{$serverRoot}/sqlite/wurmcreatures.db",
	"wurmDeitiesDB"		=> "{$serverRoot}/sqlite/wurmdeities.db",
	"wurmEconomyDB"		=> "{$serverRoot}/sqlite/wurmeconomy.db",
	"wurmItemsDB"		  => "{$serverRoot}/sqlite/wurmitems.db",
	"wurmLoginDB"		  => "{$serverRoot}/sqlite/wurmlogin.db",
	"wurmLogsDB"		  => "{$serverRoot}/sqlite/wurmlogs.db",
	"wurmPlayersDB"		=> "{$serverRoot}/sqlite/wurmplayers.db",
	"wurmTemplatesDB"	=> "{$serverRoot}/sqlite/wurmtemplates.db",
	"wurmZonesDB"		  => "{$serverRoot}/sqlite/wurmzones.db"
);

/**
 * Your servers RMI connection details
 * @var wuaClientLocation Location of WUAHelper.jar
 * @var ip:               IP of your RMI Registery
 * @var port              Port of your RMI
 * @var password          Your RMI password
 */
$rmiConfig = array(
	"wuaClientLocation" => dirname(__FILE__) . "/WUAHelper.jar",
	"ip" => "",
	"port" => 7220,
	"password" => ""
);