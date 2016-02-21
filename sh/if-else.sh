#!/bin/bash

echo -n "enter a number between 1 and 3 >"
read number

echo "$number"
if [ "$number" = "1" ]; then
  echo "You entered one"
else
  if [ "$number" = "2" ]; then
    echo "The number is two"
  else
    if [ "$number" = "3" ]; then 
      echo "the number is three"
    else
      echo "The number is not between 1 and 3"
    fi
  fi
fi
