#!/bin/bash

# Check if the script is run with sufficient arguments
if [ "$#" -ne 1 ]; then
    echo "Usage: $0 <domain.conf>"
    exit 1
fi

# Get the domain configuration file name
CONF_FILE="$1"

# Check if the configuration file exists in sites-available
if [ ! -f "/etc/apache2/sites-available/$CONF_FILE" ]; then
    echo "Error: Configuration file /etc/apache2/sites-available/$CONF_FILE does not exist."
    exit 1
fi

# Enable the site using a2ensite
echo "Enabling site $CONF_FILE..."
sudo a2ensite "$CONF_FILE"
if [ $? -ne 0 ]; then
    echo "Error: Failed to enable site $CONF_FILE."
    exit 1
fi

# Restart Apache to apply changes
echo "Restarting Apache..."
sudo service apache2 reload
if [ $? -ne 0 ]; then
    echo "Error: Failed to reload Apache."
    exit 1
fi

echo "Site $CONF_FILE enabled and Apache restarted successfully."
