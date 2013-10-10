# Business Account

When using a service for business purpose, you will receive a business account from Google. This one allows you to
bypass Google limitation according to your billing plan. In order to use this feature, you will need an
`Ivory\GoogleMap\Services\BusinessAccount`:

``` php
use Ivory\GoogleMap\Services\BusinessAccount;

$businessAccount = new BusinessAccount('client_id', 'secret');

$clientId = $businessAccount->getClientId();
$businessAccount->setClientId($clientId);

$secret = $businessAccount->getSecret();
$businessAccount->setSecret($secret);
```

Note that the client identifier is not prefixed by `gme-` (it is automatically prepended by the library).

Additionally, you can use channel:

```
$businessAccount = new BusinessAccount('client_id', 'secret', 'my_channel');

$channel = $businessAccount->getChannel();
$businessAccount->setChannel($channel);
```

## Geocoder

If you want to use the geocoder service with a Google business account, you need to set it on the provider and then,
everything is done automatically:

``` php
use Ivory\GoogleMap\Services\BusinessAccount;
use Ivory\GoogleMap\Services\Geocoding\Geocoder;
use Ivory\GoogleMap\Services\Geocoding\GeocoderProvider;
use Geocoder\HttpAdapter\CurlHttpAdapter;


$provider = new GeocoderProvider(new CurlHttpAdapter())

$provider->setBusinessAccount(new BusinessAccount('client_id', 'secret'));
$businessAccount = $provider->getBusinessAccount();

$geocoder = new Geocoder();
$geocoder->registerProviders(array($provider));

$response = $geocoder->geocode('1600 Amphitheatre Parkway, Mountain View, CA');
```

If you want to go back the normal behavior (anonymous), you need to reset the business account to `null`:

``` php
$geocoder->setBusinessAccount(null);
```

## Directions

If you want to use the directions service with a Google business account, you need to set it on the service and then,
everything is done automatically:

``` php
use Ivory\GoogleMap\Services\BusinessAccount;

$directions->setBusinessAccount(new BusinessAccount('client_id', 'secret'));
$businessAccount = $directions->getBusinessAccount();

$response = $directions->route('Lille', 'Paris')
```

If you want to go back the normal behavior (anonymous), you need to reset the business account to `null`:

``` php
$directions->setBusinessAccount(null);
```

## Distance Matrix

If you want to use the distance matrix service with a Google business account, you need to set it on the service and
then, everything is done automatically:

``` php
use Ivory\GoogleMap\Services\BusinessAccount;

$distanceMatrix->setBusinessAccount(new BusinessAccount('client_id', 'secret'));
$businessAccount = $distanceMatrix->getBusinessAccount();

$response = $distanceMatrix->process(array('Vancouver BC'), array('San Francisco'));
```

If you want to go back the normal behavior (anonymous), you need to reset the business account to `null`:

``` php
$distanceMatrix->setBusinessAccount(null);
```
