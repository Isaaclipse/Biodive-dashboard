#!/bin/bash
#
# Title window
echo -n -e "\033]0;Digital Journal Launcher\007"

# Launch MAMP, if not already open
if ps ax | grep -v grep | grep "MAMP" &> /dev/null; then
    echo "MAMP is running"
else
    open -g /Applications/MAMP/MAMP.app
    /usr/bin/osascript -e 'tell application "System Events" to set visible of process "MAMP" to false'
fi

# Change current director to script's location and then some
cd "`dirname \"$0\"`"

# Minimize terminal window
printf '\e[2t'

# Start server
php -S 0.0.0.0:8081 -t site/api/ site/api/index.php
