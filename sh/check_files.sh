#!/bin/bash
ext="pdf"
count=$(find /Users/sujith/Downloads -name "*.$ext" | wc -l)
count=${count//[[:blank:]]/}  ## for trimming string
if [ "$count" == "0" ]; then
  echo "No files exist"
else
  echo "$count files exist"
  curl -s http://192.168.2.172/php-smtp/example/send.php 2>&1 > ocr_watch.log &
fi

