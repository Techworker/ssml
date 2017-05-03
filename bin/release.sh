#!/usr/bin/env bash

# error routing
error () {
    echo "";
    echo "------------------------------------------------------------";
    echo "ERROR";
    echo $1;
    echo "------------------------------------------------------------";
    echo "";
    echo "";
}

tip () {
    echo "";
    echo "------------------------------------------------------------";
    echo "TIP";
    echo $1;
    echo "------------------------------------------------------------";
    echo "";
    echo "";
}

# refresh
git pull --rebase

if [ $# -lt 1 ]; then
  error "Version number parameter is missing.";
  tip "Use major.minor.patch versioning."
  exit;
fi

VERSION=$1

[[ $VERSION == +([0-9]).+([0-9]).+([0-9]) ]] || error "Invalid version format provided, use major.minor.patch"

BRANCH=$(git rev-parse --abbrev-ref HEAD)
if [ $BRANCH != "master" ]
then
    error "You are on branch ${BRANCH} - Please switch to branch 'master'";
    exit;
fi

OPENCOMMITS=$(git log origin/master..HEAD --pretty=oneline --abbrev-commit | wc -l)

if [ $OPENCOMMITS -gt 0 ]; then
    error "There are unpushed commits in the branch:"
    git log origin/master..HEAD
    tip "Use git reset --hard origin/master to discard local commits, but make sure you know what you are doing."
    exit;
fi

UNSTAGEDFILES=$(git diff --numstat | wc -l)

if [ $UNSTAGEDFILES -gt 0 ]; then
    error "There are files not staged for a commit. Make sure the master branch is clean!"
    git status
    exit;
fi

DIFFDEVEL=$(git diff --name-status origin/master..origin/devel | wc -l)
if [ $DIFFDEVEL -gt 0 ]; then
    while true; do
        echo "There are ${DIFFDEVEL} differences between origin/master and origin/devel";
        read -p "Are you sure you want to create the tag? [y/n] " yn
        case $yn in
            [Yy]* ) break;;
            [Nn]* ) exit;;
            * ) echo "Please answer yes or no.";;
        esac
    done
fi

LATEST=$(git describe --abbrev=0)
echo -e "\e[32mEnvironment ok\e[0m";
echo -e "The latest tag is \e[1;93m${LATEST}\e[0m";
echo -e "This script will create a new tag named \e[1;93mv${VERSION}\e[0m"

while true; do
    read -p "Are you sure you want to proceed? [y/n] " yn
    case $yn in
        [Yy]* ) break;;
        [Nn]* ) exit;;
        * ) echo "Please answer yes or no.";;
    esac
done

echo "UPDATING VERSION...";

sed -i -E "s/(\"version\"\s*:\s*\").*?(\",)/\1${VERSION}\2/g" composer.json
sed -i -E "s/(define\('APP_VERSION',\s*').*?('\);)/\1${VERSION}\2/g" public/index.php

echo "BUILDING ASSETS...";
make build

git add *
git commit -m"Updated version no (${VERSION})"
git push

git tag -a v${VERSION} -m "Version ${VERSION}"
git push origin v${VERSION}

echo -e "\e[32mTag created";