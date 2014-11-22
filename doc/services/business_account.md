# Business Account

When using a service for business purpose, you will receive a business account from Google. This one allows you to
bypass Google limitation according to your billing plan.

## Create your business account

``` php
use Ivory\GoogleMap\Services\BusinessAccount;

$businessAccount = new BusinessAccount('client_id', 'secret');
```

## Configure your business account

### Configure the client id

``` php
$businessAccount->setClient('client_id');
```

The client identifier is not prefixed by `gme-` (it is automatically prepended by the library).

### Configure the secret

``` php
$businessAccount->setSecret('secret');
```

### Configure the channel

``` php
$businessAccount->setChannel('channel');
```

## Set the business account on the service

### Geocoder

``` php
use Ivory\GoogleMap\Services\BusinessAccount;

$geocoderProvider->setBusinessAccount(new BusinessAccount('client_id', 'secret'));
```

## Directions

``` php
use Ivory\GoogleMap\Services\BusinessAccount;

$directions->setBusinessAccount(new BusinessAccount('client_id', 'secret'));
```

## Distance Matrix

``` php
use Ivory\GoogleMap\Services\BusinessAccount;

$distanceMatrix->setBusinessAccount(new BusinessAccount('client_id', 'secret'));
```
