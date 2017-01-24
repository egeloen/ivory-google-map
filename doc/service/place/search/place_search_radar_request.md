# Place Search Radar Request

The Google Places API Radar Search Service allows you to search for up to 200 places at once, but with less detail 
than is typically returned from a Text Search or Nearby Search request. With Radar Search, you can create applications 
that help users identify specific areas of interest within a geographic area.

## Build

First of all, let's build a place search radar request:

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Place\Search\Request\RadarPlaceSearchRequest;

$request = new RadarPlaceSearchRequest(
    new Coordinate(-33.8670522, 151.1957362),
    1000
);
```

The place search radar request constructor requires a location as first argument and a radius as second argument.

## Configure location

The location around which to retrieve place information.

``` php
use Ivory\GoogleMap\Base\Coordinate;

$request->setLocation(new Coordinate(-33.8670522, 151.1957362));
```

## Configure radius

The radius defines the distance (in meters) within which to return place results.

``` php
$request->setRadius(1000);
```

## Configure min price

The min price restricts results to only those places upper the specified price.

``` php
use Ivory\GoogleMap\Service\Place\Base\PriceLevel;

$request->setMinPrice(PriceLevel::MODERATE);
```

The available prices are described by the `PriceLevel` constants.

## Configure max price

The min price restricts results to only those places under the specified price.

``` php
use Ivory\GoogleMap\Service\Place\Base\PriceLevel;

$request->setMaxPrice(PriceLevel::MODERATE);
```

The available prices are described by the `PriceLevel` constants.

## Configure open now

When enabled, the service returns only those places that are open for business at the time the query is sent.

``` php
$request->setOpenNow(true);
```

## Configure type

Th type restricts the results to places matching the specified type.

``` php
use Ivory\GoogleMap\Service\Place\Base\PlaceType;

$request->setType(PlaceType::BANK);
```

The available types are described by the `PlaceType` constants.

## Configure keyword

The keyword is a term to be matched against all content that Google has indexed for this place.

``` php
$request->setKeyword('Bank');
```

## Configure language

The language code, indicating in which language the results should be returned, if possible.

``` php
$request->setLanguage('fr');
```
