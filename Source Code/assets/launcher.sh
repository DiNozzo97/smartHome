#!/bin/sh
# launcher.sh
# navigate to home directory, then to this directory, then execute python script, then back home

sudo python /var/www/assets/pythonFiles/doorBell.py &sudo python /var/www/assets/pythonFiles/python_asip_client/dataLogger.py

