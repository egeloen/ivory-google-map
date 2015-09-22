# Timezone API

The Timezone API uses [widop/http-adapter](http://github.com/widop/http-adapter) which is a PHP 5.3 library for
issuing http requests.

The [Google Maps Time Zone API](https://developers.google.com/maps/documentation/timezone/intro) provides time 
offset data for locations on the surface of the earth. Requesting the time zone information for a specific 
Latitude/Longitude pair will return the name of that time zone, the time offset from UTC, and the Daylight 
Savings offset.

## Request the timezone service

``` php
use Widop\HttpAdapter\GuzzleHttpAdapter;
use Ivory\GoogleMap\Services\Timezones\TimezoneRequest;
use Ivory\GoogleMap\Services\Timezones\TimezoneProvider;
use Ivory\GoogleMap\Services\BusinessAccount;

$timezoneProvider = new TimezoneProvider( new GuzzleHttpAdapter() );
$timezoneRequest = new TimezoneRequest( [ 'lat' => 39.6034810, 'lng' => -119.6822510 ] );
$response = $timezoneProvider->getTimezoneData( $timezoneRequest );
```

If you want to use it with a business account, you can read this
[documentation](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/services/business_account.md).

## Timezone response

When you have requested your timezone data, the returned object is an ``Ivory\GoogleMap\Services\Timezones\TimezoneResponse``. 
It contains the payload returned from Google, for example:

``` 
{
   "dstOffset" : 0,
   "rawOffset" : -28800,
   "status" : "OK",
   "timeZoneId" : "America/Los_Angeles",
   "timeZoneName" : "Pacific Standard Time"
}
```
