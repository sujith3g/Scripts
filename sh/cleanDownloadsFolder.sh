#! /bin/bash

#A script to arrange files in the ~/Downloads folder
a=0
b=0
DIRLIST="tsv docs compressed pdf pics packages"
#creeate directories first
for dir in $DIRLIST
do
  mkdir -p ~/Downloads/$dir
done

#perform re-arranging
for filename in  ~/Downloads/*
do
  if [ -f "$filename" ]
  then
    case $filename in
      *.tsv)
        echo "moved $filename"
        mv "$filename" ~/Downloads/tsv/
        b=`expr $b + 1`
        ;;
      *.docx|*.doc)
        echo "moved $filename"
        mv  "$filename" ~/Downloads/docs/
        b=`expr $b + 1`
        ;;
      *.xlsx|*.xlsm|*.xls)
        echo "moved $filename"
        mv "$filename" ~/Downloads/docs/
        b=`expr $b + 1`
        ;;
      *.zip)
        echo "moved $filename"
        mv "$filename" ~/Downloads/compressed/
        b=`expr $b + 1`
        ;;
      *.tar)
        echo "moved $filename"
        mv "$filename" ~/Downloads/compressed/
        b=`expr $b + 1`
        ;;
      *.gz)
        echo "moved $filename"
        mv "$filename" ~/Downloads/compressed/
        b=`expr $b + 1`
        ;;
      *.pdf)
        echo "moved $filename"
        mv "$filename" ~/Downloads/pdf/
        b=`expr $b + 1`
        ;;
      *.deb)
        echo "moved $filename"
        mv "$filename" ~/Downloads/packages/
        b=`expr $b + 1`
        ;;
      *.jpg)
        echo "moved $filename"
        mv "$filename" ~/Downloads/pics/
        b=`expr $b + 1`
        ;;
      *.png)
        echo "moved $filename"
        mv "$filename" ~/Downloads/pics/
        b=`expr $b + 1`
        ;;
      *.bmp)
        echo "moved $filename"
        mv "$filename" ~/Downloads/pics/
        b=`expr $b + 1`
        ;;
    esac
    #echo $a
    a=`expr $a + 1`
  fi
done
echo "$b files moved from a total of $a files"
