#!/bin/bash

# A script to check if another instance of it is already runnig
# and exit if it is already runnning

set -e
if pidof -x "`basename $0`" -o $$ >/dev/null; then
    echo "Process already running"
    exit 0
fi
sleep 30
