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

## Configure http plugins

[Httplug](http://httplug.io/) supports a set of plugins we recommend to use in order to get better performance as well 
as a better experience with the library. The following are the most interesting ones:

 - Http Error Plugin: Convert 4xx & 5xx responses to exceptions.
 - Google Error Plugin: Convert Google invalid responses to exceptions.
 - Retry Plugin: Retry an error responses (exceptions).
 - Cache Plugin: Cache responses using a [PSR-6](http://www.php-fig.org/psr/psr-6/) compliant cache system.

To use theses plugins, first install them:

``` bash
$ composer require php-http/client-common
$ composer require php-http/cache-plugin
$ composer require symfony/cache
```

Here, I have chosen to use the Symfony Cache PSR-6 component but you can choose your preferred one instead. 
Then, create a plugin client:

``` php
use Http\Adapter\Guzzle6\Client;
use Http\Client\Common\Plugin\CachePlugin;
use Http\Client\Common\Plugin\ErrorPlugin as HttpErrorPlugin;
use Http\Client\Common\Plugin\RetryPlugin;
use Http\Message\StreamFactory\GuzzleStreamFactory;
use Ivory\GoogleMap\Service\Plugin\ErrorPlugin as GoogleErrorPlugin;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

$service->setClient(new PluginClient(new Client(), [
    new RetryPlugin(),
    new HttpErrorPlugin(),
    new GoogleErrorPlugin(),
    new CachePlugin(
        new FilesystemAdapter(__DIR__.'/cache'),
        new GuzzleStreamFactory(),
        [
            'cache_lifetime'        => null,
            'default_ttl'           => null,
            'respect_cache_headers' => false,
        ]
    ),
]));
```

In this example, we use the `FilesystemAdapter` as well as an infinite caching strategy but you can configure it 
according to your needs. 

## Configure message factory

If you want to update the message factory, you can use:

``` php
use Http\Message\MessageFactory\GuzzleMessageFactory;

$service->setMessageFactory(new GuzzleMessageFactory());
```

Here, I have chosen to use the [Guzzle6](http://docs.guzzlephp.org/en/latest/psr7.html) message factory but since 
[Httplug](http://httplug.io/) supports the most popular http clients, you can choose you preferred one instead.

## Configure serializer

If you want to update the serializer, you can use:

``` php
use Ivory\Serializer\Serializer;

$service->setSerializer(new Serializer());
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
