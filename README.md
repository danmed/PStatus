# PStatus
Ping of internal servers and port check of related services with a Web front end.

# Requirements
* Web server running PHP (7 is tested.. 5 should work fine)
* PHP Pear - https://wonderphp.wordpress.com/2014/02/28/installing-pear-mail-for-php-on-ubuntu/
* MYSQL Database (import status.sql to a database)
* uptime.php needs to be run as a cron timer - */10 * * * * /usr/bin/php /var/www/html/status/uptime.php

# Configuration
* Change all configurable options in config.inc.php
* Access page and go to settings to configure email details and email threshold
* Set up a cronjob to run uptime.php as often as you want to collect uptime

# WIP
* Enable / Disable email alerts

# Planned
* Edit Services
* Enable Disable alerts per device

# Done
* Add auto refresh rate
* Add services for each parent server
* Add Smart device controls
* Run in backgroud to build stats of uptime
* Reset uptime data
* Email alerts with threshold
* Option to display Smart Devices or not
* Configurable settings via gui
* Delete Servers and Services
* Edit Servers
* removed smart devices and tables
* Added search / sorting for main device table
* Display uptime data including last uptime / downtime

# Screenshot


![Alt text](/../screenshots/pstatus.png?raw=true "Main Screen")

![Alt text](/../screenshots/pstatus2.png?raw=true "Service Screen")

![Alt text](/../screenshots/pstatus3.png?raw=true "Service Screen")

![Alt text](/../screenshots/pstatus4.png?raw=true "Service Screen")

![Alt text](/../screenshots/pstatus5.png?raw=true "Service Screen")

# Credit 
Original idea sparked by https://gist.github.com/k0nsl/733955a3c3093832de49
