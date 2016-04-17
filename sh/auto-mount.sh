#!/bin/bash

# Script for mounting windows shared directory from ubuntu with credentials.
BACK_LOC="192.168.2.30"
MOUNT_POINT=/mnt/backup

mkdir -p $MOUNT_POINT
mount -t cifs //192.168.2.31/my_shared_loc/ $MOUNT_POINT -o username=my.username,password=my.secret,uid=1000,gid=1000
cd $MOUNT_POINT/$BACK_LOC/

echo `ls`

umount $MOUNT_POINT
