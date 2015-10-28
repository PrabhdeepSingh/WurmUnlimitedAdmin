# CHANGELOG

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