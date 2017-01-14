#!/bin/bash

# A script to kill the process using a particular port
# Usage: ./kill-port.sh <PORT>

PORT=${1:-3000}

#kill already running process
PID=$(lsof -t -i:$PORT)

if [ $? -eq 0 ]; then
  kill $PID
else
  echo "No process is using $PORT"
fi
exit 0
