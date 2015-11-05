# CHANGELOG

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