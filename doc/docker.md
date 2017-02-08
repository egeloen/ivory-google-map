# Docker

The most easy way to set up the project is to install [Docker](https://www.docker.com) and
[Docker Composer](https://docs.docker.com/compose/) and build the project.

## Configure

The configuration is shipped with a distribution environment file allowing you to customize your IDE and XDebug
settings as well as your current user/group ID:

``` bash
$ cp .env.dist .env
```

**The most important part is the `USER_ID` and `GROUP_ID` which should match your current user/group.**

## Build

Once you have configured your environment, you can build the project:

``` bash
$ docker-compose build
```

## Composer

Install the dependencies via [Composer](https://getcomposer.org/):

``` bash
$ docker-compose run --rm php composer install
```

## Tests

To run the test suite, you can use:

``` bash
$ docker-compose run --rm php vendor/bin/phpunit
```

If you want to run the test suite against [HHVM](http://hhvm.com/), you can use:

``` bash
$ docker-compose run --rm hhvm vendor/bin/phpunit
```

Some tests requires a [Selenium Server](http://www.seleniumhq.org/), you can start it with:

``` bash
$ docker-compose up -d
```

## XDebug

If you want to use XDebug, make sure you have fully configured your `.env` file and use:

``` bash
$ docker-compose run --rm -e XDEBUG=1 php vendor/bin/phpunit
```
