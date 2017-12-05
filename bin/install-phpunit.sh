#!/bin/bash

echo "## Installing PHPUnit"
mkdir -p $HOME/phpunit-bin

if [[ ${TRAVIS_PHP_VERSION:0:2} == "7." ]]; then
  PHPUNIT_VERSION='5.7'
elif [[ ${TRAVIS_PHP_VERSION:0:3} != "5.2" ]]; then
  PHPUNIT_VERSION='4.8'
fi

composer global require "phpunit/phpunit=$PHPUNIT_VERSION"

export PATH=$HOME/phpunit-bin/:$PATH
