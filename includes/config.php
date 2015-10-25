<?php
define("DEVELOPMENT", 0);
define("PRODUCTION", 1);

$application = array(
	"mode" => DEVELOPMENT,
	"rootPath" => "//localhost/wurmunlimitedadmin/",
	"version" => "0.0.1"
);

$dbConfig = array(
	"appDB" => dirname(__FILE__) . "/sqlite/app.db",
	"wurmCreaturesDB" => "",				// Location of the wurmcreatures.db
	"wurmDeitiesDB" => "",					// Location of the wurmdeities.db
	"wurmEconomyDB" => "",					// Location of the wurmeconomy.db
	"wurmItemsDB" => "",						// Location of the wurmitems.db
	"wurmLoginDB" => "",						// Location of the wurmlogin.db
	"wurmLogsDB" => "",							// Location of the wurmlogs.db
	"wurmPlayersDB" => "",					// Location of the wurmplayers.db
	"wurmTemplatesDB" => "",				// Location of the wurmtemplates.db
	"wurmZonesDB" => ""							// Location of the wurmzones.db
);