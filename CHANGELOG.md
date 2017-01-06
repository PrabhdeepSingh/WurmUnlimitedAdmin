# CHANGELOG
## 1.0.0
- Added: Ability to view support tickets (357c418a0200a79c2fb57b7bc63f8c23ce517668).
- Added: Missing in-game items.
- Added: Mulitple server support.
- Fixed: Added functionality to the dashboard.
- Cleanup: Code cleanup.

## 2.0.0-Alpha
- Fixed: Confirm password field not clearing (https://github.com/PrabhdeepSingh/WurmUnlimitedAdmin/issues/4).
- Added: Clickable images for players (https://github.com/PrabhdeepSingh/WurmUnlimitedAdmin/issues/3).
- Added: Added the ability to view villages like viewing players (https://github.com/PrabhdeepSingh/WurmUnlimitedAdmin/issues/5).
- Removed: Namespace on classes.
- Added: Auto load on each class.
- Removed: All javascript console.log(response).

## 1.0.1-Alpha
- Core/Player: Updated methods.
- Core/Player: Fixed `Ban`, `Unban`, `Mute`, and `Unmute` functions when viewing a player.
- Core/CSS: Fixed loader on blank pages.
- Core: Removed debugging logs.
- Core: Made user power and level user friendly / easy to read.
- Core: Added read only user level.

## 1.0.0-Alpha
- WUAHelper/Core: Updated to work with the latest version of `WU`.
- Core/village: Implemented villages.
- Core/Server: Added loader to the server page.
- Core/Server: Disabled buttons if the server is running.
- Core/Server: Added wurm time changer dialog.
- Core/Player: Added GM power restrictions.
- Core/Server: Added GM power restrictions.

## 0.0.19-Alpha
- Core/Player: Fixed `Give Item` so it doesn't show item's that shouldn't be given.

## 0.0.18-Alpha
- Core/Account: Added `Confirm Password` when changing your own password.
- Core/Server: Fixed `Change server kingdom` to update dom when changed. - Thank Adambean for reporting :)

## 0.0.17-Alpha
- Core/Players: Added full list of in-game `Items` when adding to user.

## 0.0.16-Alpha
- Core/Core: Added `bootstrap-multiselect` asset.
- Core/Core: Added `list.js` asset.
- Core/Player: Fixed typo on log file.
- Core/Player: Updated `AddItem` to support adding multiple items.
- Core/Player: Fixed `Kingdom` so now player gets changed to correct kingdom.
- Core/Player: Added `Search bar` when viewing all players.
- Core/RMI: Fixed error that was being caused when the folder path had spaces. - Thanks Xpy for reporting :)
- Core/Config: rootPath needs to be the absolute folder location - Thanks Xpy and Kron :)
- Core/Core: Fixed errors that were being caused on the main `index.php` file.
- WU/Webinterface: New update, includes bug fixes and sends more messages to the player.
- WUAHelper/Core: Updated to with the updated Webinterface.

## 0.0.15-Alpha
- Core/Core: Implemented `Logger` class to handle application / gm logging.
- Core/Player: Added `Logger`.

## 0.0.14-Alpha
- Core/Readme: Updated.
- Core/Server: Added `Change Game Mode` function to change server to PVE or PVP.
- Core/Server: Added `Change Game Cluster` function to change between EPIC and Freedom.
- Core/Server: Added `Change Wurm Time` function to change world time.
- Core/server: Added `Change Player Limit` function to change max players.
- Core/Server: Design change.

## 0.0.13-Alpha
- Core/Player: Fixed `Ban / Unban` function to work with RMI.
- Core/Player: Fixed `Mute / Unmute` function to work with RMI.
- Core/Player: Fixed `Change power` function to work with RMI.
- Core/Player: Fixed `Change kingdom` function to work with RMI.
- Core/Player: Fixed `Change email` function to work with RMI.
- Core/Player: Added `Add item` function to add items to players inventory.

## 0.0.12-Alpha
- Core/Core: Implemented `RMI` class to do RMI related tasks.
- Core/RMI: Added `CheckConnection` function to check if RMI server is on.
- Core/RMI: Added `Execute` function to execute a RMI call.
- Core/Server: Removed hard coded RMI calls and edited some text on the server view.
- Core/Server: Added `ShutDown` function to shutdown a wurm server.
- Core/Player: Removed global variables.
- Core/Player: Updated functions to use the new RMI class.
- Core/Admin: Added `Confirm Password` and `Level Select Box` when adding a new admin to the application.
- Core/Core: Fixed typo in the `header.php` file.

## 0.0.11-Alpha
- Core/Server: Added `GetWurmTime` function to get current wurm time / calender.
- Core/Server: Added `SendBroadcastMessage` function to send a server wide message.
- Core/Server: Fixed typo of variable name.


## 0.0.10-Alpha
- Core/Server: Added `GetUpTime` function to get server uptime.
- Core/Server: Updated `GetServers` function to call `getPlayerCount` and `getUpTime`.
- Core/Core: Removed `WUAHelperRequirements` because they're no longer needed.
- WUAHelper/Core: Updated

## 0.0.9-Alpha
- Core/Server: Added `GetTracker` function which generators data for server tracker.
- Core/Core: Implemented `Tracker` which generatos a image of your server data / settings.

## 0.0.8-Alpha
- Core/Player: Added a bridge connection to the wurm server.
- Core/Core: Implemented `Server` class.
- Core/Server: Added `GetServers` function to get all servers in the login db.
- Core/Server: Added `GetPlayerCount` function to get player count.
- Core/Core: Implemented `WUAHelper` to communicate with wurm server.

## 0.0.7-Alpha
- Core/Core: Changed `$dbConfig` in config.php file to use $serverRoot.
- Core/Core: Updated `Player view` file to update the inventory view when the user clicks the tab.
- Core/Core: Added `GetSkills` function to the get player skills.

## 0.0.6-Alpha
- Core/Core: Fixed `Dashboard` to be more relevant.
- Core/Player: Added `Inventory`, this is just a basic inventory view for now. More coming soon.

## 0.0.5-Alpha
- Core/Player: Added `Change power` function to change a players in-game power.
- Core/Player: Added `Add money` function to add money to a player.
- Core/Player: Added `Change email` function to add money to a player.
- Core/Player: Added `Change kingdom` function to change a players kingdom.
- Core/Core: Added a `Donate via PayPal` link on the footer.
- Core/Core: Changed `Main Navigation Icons` to proper ones.
- Core/Core: Fixed `Main Navigation Menu`, it should now stay open.

## 0.0.4-Alpha
- Core/Player: Fixed `Exception error` that was being caused when loading player page.
- Core/Player: Fixed `First seen` and `Last seen` to print correct date.
- Core/Player: Added `Ban / Unban` function.
- Core/Player: Added `Mute / Unmute` function.

## 0.0.3-Alpha
- Core/Core: Implemented `Player` class.
- Core/Player: Added `GetPlayers` function to get all players : single player from the wurm PLAYERS table.
- Core/Core: Added `wurmSecondsToTime` function to convert PLAYTIME to friendly version.
- Core/Core: Added `wurmConvertMoney` function to convert MONEY to gold, silver, copper and iron.
- Core/Core: Fixed `Error handling` to be more user friendly.

## 0.0.2-Alpha
- Core/Account: Added `Change Password` function.
- Core/Account: Added `Logout` function.
- Core/Account: Fixed `Login` function, `ID` should now be sent back when signing in.
- Core/Admin: Added `Add user` function.
- Core/Admin: Added `Reset password` function.
- Core/Admin: Added `Users` system to view application members.
- Core/Config: Added variables for wurm databases

## 0.0.1-Alpha
- First initial code release.
- Core/Core: Implemented `Account` class.
- Core/Core: Implemented `Admin` class.