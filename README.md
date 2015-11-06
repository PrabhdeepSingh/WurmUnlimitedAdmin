# Introduction
**Wurm Unlimited Admin** - is a web-based admin interface for Wurm Unlimited servers.

# Demo
To see this software in action visit our [Demo](http://wuademo.xplosivegames.com/)

# Requirements / Dependencies
The following programs and modules are required to run Wurm Unlimited Admin

- LAMP/WAMP, Nginx, or UniServer Zero XI running PHP 5.5.0 or higher
- Ability to change php.ini to allow the extension: php_pdo_sqlite.dll
- Wurm Unlimited Server
- [WUAHelper](https://github.com/PrabhdeepSingh/WUAHelper) - Used for RMI

# Installation
#### Download
- Download or clone from GitHub

#### PHP configuration
For this software to work you need to enable the php_pdo_sqlite extension as it will be needed to talk to Wurm Unlimited server database files. To enable the extension do the following
- Navigate to your `php.ini` file
- Do a search for `php_pdo_sqlite` and remove `;` from infront of `extension`

#### Application configuration
This is a basic configuration / setup guide on getting this software up and running on your host.
- Place files from this repo into your `www` folder
- Navigate to the `includes` folder and open `config.php`
- Change the `rootPath` to your website address

#### Wurm Unlimited configuration
To interact with your WU server you need to enable RMI on it, and to do that you need to edit `wurm.ini` file
- Go to your `wurm.ini` file
  - Add the following line at the end of the file: `USE_INCOMING_RMI=true`
  - Save the file and start the server
If everything goes smoothly you should see `RMI Registry listening on ........`

# Usage

- The default username and password to the admin account are:

Username | Password
--- | --- | ---
admin | admin