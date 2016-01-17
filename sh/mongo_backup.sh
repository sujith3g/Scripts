#!/bin/bash
## A script for taking backup from mongo db.
## Creates backup to <db-name>-YYYY-MM-DD.tar in MONGO_BACKUP/<db_name>/YYYY-MM-DD/ directory

if [ -z "$1" ]
then

  echo "db_name is missing !  Usage: ./mongo_backup.sh <db_name>"

elif ! [ -z "$1" ]
then

echo "creating backup for $1"
MONGO_BACKUP="$HOME/mongo_backup"
TODAY=$(date +%F)
mkdir -p "$MONGO_BACKUP/$1/$TODAY"
cd "$MONGO_BACKUP/$1/$TODAY"
echo "$(pwd) directory created."
mongodump -h localhost -p 27017 -d $1 -o $(pwd)
tar -cf $1-$TODAY.tar $1
echo "backup $1-$TODAY.tar created successfully."

fi
