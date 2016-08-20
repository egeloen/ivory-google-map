# Business Account

When using a service for business purpose, you will receive a business account from Google. This one allows you to
bypass Google limitation according to your billing plan.

## Build

First of all, if you want to use a business account, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Service\BusinessAccount;

$businessAccount = new BusinessAccount('client_id', 'secret');
```

The business account constructor requires a client id as first argument and a secret as second argument. It also 
accepts additional parameters such as channel (default null):

``` php
use Ivory\GoogleMap\Service\BusinessAccount;

$businessAccount = new BusinessAccount('client_id', 'secret', 'channel');
```

## Configure client id

If you want to update the client id, you can use:

``` php
$businessAccount->setClientId('client_id');
```

The client id is not prefixed by `gme-` (it is automatically prepended by the library).

## Configure secret

If you want to update the secret, you can use:

``` php
$businessAccount->setSecret('secret');
```

## Configure channel

If you want to update the channel, you can use:

```
$businessAccount->setChannel('channel');
```

## Use with services

When you have built you business account, you need to configure it on a service.

### Direction

If you want to use the direction service with a Google business account, you need to set it on the service:

``` php
$direction->setBusinessAccount($businessAccount);
```

If you want to go back the normal behavior (anonymous), you need to reset the business account:

``` php
$direction->setBusinessAccount(null);
```

### Distance Matrix

If you want to use the distance matrix service with a Google business account, you need to set it on the service:

``` php
$distanceMatrix->setBusinessAccount($businessAccount);
```

If you want to go back the normal behavior (anonymous), you need to reset the business account:

``` php
$distanceMatrix->setBusinessAccount(null);
```

### Geocoder

If you want to use the geocoder service with a Google business account, you need to set it on the provider:

``` php
$geocoder->setBusinessAccount($businessAccount);
```

If you want to go back the normal behavior (anonymous), you need to reset the business account:

``` php
$geocoder->setBusinessAccount(null);
```
