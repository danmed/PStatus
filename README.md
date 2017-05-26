# PStatus
Ping of internal servers and port check of related services with a Web front end.

# Requirements
* Web server running PHP (7 is tested.. 5 should work fine)
* PHP Curl (For email functionality)
* MYSQL Database (import status.sql to a database named "status")
* uptime.php needs to be run as a cron timer - */10 * * * * /usr/bin/php /var/www/html/status/uptime.php

# WIP

21.05.17 - Admin page : So far you can add a server, smart device and a service.. the rest needs to be done in SQL at the moment.

# Planned
* Delete Devices etc..
* Edit Devices etc..
* Display uptime data including last uptime / downtime

# Done
* Add auto refresh rate
* Add services for each parent server
* Add Smart device controls
* Run in backgroud to build stats of uptime
* Reset uptime data
* Email alerts with threshold
* Option to display Smart Devices or not
* Configurable settings via gui

# Screenshot


![Alt text](/../screenshots/pstatus.png?raw=true "Main Screen")

![Alt text](/../screenshots/pstatus2.png?raw=true "Service Screen")

![Alt text](/../screenshots/pstatus3.png?raw=true "Service Screen")

![Alt text](/../screenshots/pstatus4.png?raw=true "Service Screen")

![Alt text](/../screenshots/pstatus5.png?raw=true "Service Screen")

# Credit 
Original idea sparked by https://gist.github.com/k0nsl/733955a3c3093832de49
