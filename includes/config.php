<?php
define("DEVELOPMENT", 0);
define("PRODUCTION", 1);

/**
 * This array is used through out the website
 * @var mode Determines if errors should show or stay hidden
 * @var rootPath The web address to this software
 * @var minAdminLevel This determines if the user is able to see the admin page ( add users, edit users ) and server settings page
 * @var version This is just a versioning variable nothing else
 */
$application = array(
	"mode" => DEVELOPMENT,
	"rootPath" => "//localhost/wurmunlimitedadmin/", // CHANGE ME
	"minAdminLevel" => 5,
	"version" => "0.0.8-Alpha"
);

/**
 * Location of where your world directory for the wurm server is located
 */
$serverRoot	= "/path/to/wurm-server/world-dir/sqlite";

/**
 * This array is used for connecting to different databases
 * @var appDB Location of the app.db
 * @var wurmCreaturesDB Location of the wurmcreatures.db
 * @var wurmDeitiesDB Location of the wurmdeities.db
 * @var wurmEconomyDB Location of the wurmeconomy.db
 * @var wurmItemsDB Location of the wurmitems.db
 * @var wurmLoginDB Location of the wurmlogin.db
 * @var wurmLogsDB Location of the wurmlogs.db
 * @var wurmPlayersDB Location of the wurmplayers.db
 * @var wurmTemplatesDB Location of the wurmtemplates.db
 * @var wurmZonesDB Location of the wurmzones.db
 */
$dbConfig = array(
	"appDB" => dirname(__FILE__) . "/sqlite/app.db",
	"wurmCreaturesDB"	=> "{$serverRoot}/wurmcreatures.db",
	"wurmDeitiesDB"		=> "{$serverRoot}/wurmdeities.db",
	"wurmEconomyDB"		=> "{$serverRoot}/wurmeconomy.db",
	"wurmItemsDB"		  => "{$serverRoot}/wurmitems.db",
	"wurmLoginDB"		  => "{$serverRoot}/wurmlogin.db",
	"wurmLogsDB"		  => "{$serverRoot}/wurmlogs.db",
	"wurmPlayersDB"		=> "{$serverRoot}/wurmplayers.db",
	"wurmTemplatesDB"	=> "{$serverRoot}/wurmtemplates.db",
	"wurmZonesDB"		  => "{$serverRoot}/wurmzones.db"
);

$rmiConfig = array(
	"wuaClientLocation" => dirname(__FILE__) . "/WUAHelper.jar",
	"ip" => "server-ip",
	"port" => 7220,
	"password" => "RMI-password"
);