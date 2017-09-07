#! /bin/bash

## usage of Array in shell script

declare -a FILES_TO_SYMLINK=(

  'git/gitattributes'
  'git/gitconfig'
  'git/gitignore'

)

# FILES_TO_SYMLINK="$FILES_TO_SYMLINK .vim bin" # add in vim and the binaries

# Move any existing dotfiles in homedir to dotfiles_old directory, then create symlinks from the homedir to any files in the ~/dotfiles directory specified in $files

for i in ${FILES_TO_SYMLINK[@]}; do
  echo "Moving any existing dotfiles from ~ to $dir_backup"
  echo "mv ~/.${i##*/} ~/dotfiles_old/";
done
