# Introduction
**Wurm Unlimited Admin** - is a web-based admin interface for Wurm Unlimited servers.

# Demo
To see this software in action visit our [Demo](http://wuademo.xplosivegames.com/)

# Requirements / Dependencies
The following programs and modules are required to run Wurm Unlimited Admin

- LAMP/WAMP, Nginx, or UniServer Zero XI running PHP 5.5.0 or higher
- Ability to change php.ini to allow the extension: php_pdo_sqlite.dll
- Wurm Unlimited Server

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

# Usage

- The default username and password to the admin account are:

Username | Password
--- | --- | ---
admin | admin