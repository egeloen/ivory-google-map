#!/usr/bin/env bash

set -e

DOCKER_BUILD=${DOCKER_BUILD-false}
TRAVIS_PHP_VERSION=${TRAVIS_PHP_VERSION-5.6}

if [ "$DOCKER_BUILD" = false ] && [ ! "$TRAVIS_PHP_VERSION" = "hhvm" ]; then
    wget https://scrutinizer-ci.com/ocular.phar
    php ocular.phar code-coverage:upload --format=php-clover build/clover.xml
fi
