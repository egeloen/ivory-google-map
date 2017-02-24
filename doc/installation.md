# Installation

To install the Ivory Google Map library, you will need [Composer](http://getcomposer.org).  It's a PHP 5.3+ dependency 
manager which allows you to declare the dependent libraries your project needs and it will install & autoload them for 
you.

## Set up Composer

Composer comes with a simple phar file. To easily access it from anywhere on your system, you can execute:

``` bash
$ curl -s https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
```

## Download the library

Require the library in your `composer.json` file:

``` bash
$ composer require egeloen/google-map
```

## Download additional libraries

### Httplug

If you want to use a service (geocoder, direction, ...), you will need an http client and message factory via 
[Httplug](http://httplug.io/) which is an http client abstraction library:

``` bash
$ composer require php-http/guzzle6-adapter
$ composer require php-http/message
```

Here, I have chosen to use [Guzzle6](http://docs.guzzlephp.org/en/latest/psr7.html) but since Httplug supports the 
most popular http clients, you can install your preferred one instead.

### Ivory Serializer

If you want to use a service (geocoder, direction, ...), you will need the 
[Ivory Serializer](https://github.com/egeloen/ivory-serializer) in order to deserialize the http response:

``` bash
$ composer require egeloen/serializer
```

## Autoload

So easy, you just have to require the generated autoload file and you are already ready to play:

``` php
<?php

require __DIR__.'/vendor/autoload.php';

use Ivory\GoogleMap;

// ...
```

The Ivory Google Map library follows the [PSR-4 Standard](http://www.php-fig.org/psr/psr-4/). 
If you prefer install it manually, it can be autoload by any convenient autoloader.
