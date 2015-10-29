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
	"version" => "0.0.5-Alpha"
);

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
	"wurmCreaturesDB" => "",
	"wurmDeitiesDB" => "",
	"wurmEconomyDB" => "",
	"wurmItemsDB" => "",
	"wurmLoginDB" => "",
	"wurmLogsDB" => "",
	"wurmPlayersDB" => "",
	"wurmTemplatesDB" => "",
	"wurmZonesDB" => ""
);