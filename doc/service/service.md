# Services

All services (direction, distance matrix, geocoder, ...) share common features.  

## Configure http client

If you want to update the service http client, you can use:

``` php
use Http\Adapter\Guzzle6\Client;

$service->setClient(new Client());
```

Here, I have chosen to use the [Guzzle6](http://docs.guzzlephp.org/en/latest/psr7.html) client but since 
[Httplug](http://httplug.io/) supports the most popular http clients, you can choose you preferred one instead.

## Configure message factory

If you want to update the message factory, you can use:

``` php
use Http\Message\MessageFactory\GuzzleMessageFactory;

$service->setMessageFactory(new GuzzleMessageFactory());
```

Here, I have chosen to use the [Guzzle6](http://docs.guzzlephp.org/en/latest/psr7.html) message factory but since 
[Httplug](http://httplug.io/) supports the most popular http clients, you can choose you preferred one instead.

## Configure https

If you want to rely on http instead of https, you can use:

``` php
$service->setHttps(false);
```

## Configure format

If you want to rely on XML instead of JSON, you wan use:

``` php
use Ivory\GoogleMap\Service\AbstractService;

$service->setFormat(AbstractService::FORMAT_XML);
```

## Configure API key

If you have an API key, you can use:

``` php
$service->setKey('api-key');
```

## Configure business account

If you want to use a service with a business account, you can read this [documentation](/doc/service/business_account.md).
