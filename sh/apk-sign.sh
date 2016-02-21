#!/bin/bash

ZIPALIGN_LOC=~/coding/android/sdk/android-sdk-macosx/build-tools/21.0.0
APP_NAME="ebooks"
APP_VER="0.0.2"
BUILD_LOC=~/coding/app_build
KEYSTORE=/Users/sujith/.keystore
KEYSTORE_ALIAS="mykeystore-alias"

if [ -d $BUILD_LOC/$APP_NAME-$APP_VER ]; then
  cd $BUILD_LOC/$APP_NAME-$APP_VER/android/
  jarsigner -verbose -sigalg SHA1withRSA -keystore $KEYSTORE -digestalg SHA1 release-unsigned.apk $KEYSTORE_ALIAS

  $ZIPALIGN_LOC/zipalign 4 $BUILD_LOC/$APP_NAME-$APP_VER/android/release-unsigned.apk $BUILD_LOC/$APP_NAME-$APP_VER/android/$APP_NAME-production-$APP_VER.apk
  echo "$APP_NAME-production-$APP_VER.apk created in $BUILD_LOC/$APP_NAME-$APP_VER/android"
  exit 0
else
  echo "build $BUILD_LOC/$APP_NAME-$APP_VER not found"
  exit 1
fi
