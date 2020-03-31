#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"

cd ${DIR}

echo "cellar Setup Assistant"
echo "----------------------"
echo ""

read -p "MariaDB username [root]: " MariaDbUsername
MariaDbUsername=${MariaDbUsername:-root}

read -sp "MariaDB password [<blank>]: " MariaDbPassword
echo ""

read -p "cellar.sql location [${DIR}/cellar.sql]: " dbfile
dbfile=${dbfile:-${DIR}/cellar.sql}

read -p "Enable Google Maps Embed [false]: " GoogleMapsEmbedEnabled
GoogleMapsEmbedEnabled=${GoogleMapsEmbedEnabled:-false}

if [ $GoogleMapsEmbedEnabled ]; then
	read -p "Google Maps Embed API Key [null]: " GoogleMapsEmbedApiKey
	GoogleMapsEmbedApiKey=${GoogleMapsEmbedApiKey:-false}
else
	GoogleMapsEmbedApiKey="null"
fi

# CREATE DB
# -----------
# If /root/.my.cnf exists then it won't ask for root password
if [ -f /root/.my.cnf ]; then
	mysql -e "CREATE DATABASE `cellar`;"
	mysql -D cellar < ${dbfile}
	
# If /root/.my.cnf doesn't exist then it'll ask for root password   
else
	mysql -u${MariaDbUsername} -p${MariaDbPassword} -e "CREATE DATABASE cellar;"
	mysql -u${MariaDbUsername} -p${MariaDbPassword} -D cellar < ${dbfile}
fi

# SETUP CONFKEYS
# -----------
echo ${GoogleMapsEmbedEnabled} > ${DIR}/config/GoogleMapsEmbedEnabled
echo ${GoogleMapsEmbedApiKey} > ${DIR}/config/GoogleMapsEmbedApiKey

composer install

echo