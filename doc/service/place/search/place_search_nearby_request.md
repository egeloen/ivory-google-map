# Place Search Nearby Request
 
A Nearby Search lets you search for places within a specified area. You can refine your search request by supplying 
keywords or specifying the type of place you are searching for.

## Build

First of all, let's build a place search nearby request:

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Place\Search\Request\NearbyPlaceSearchRequest;
use Ivory\GoogleMap\Service\Place\Search\Request\PlaceSearchRankBy;

$request = new NearbyPlaceSearchRequest(
    new Coordinate(-33.8670522, 151.1957362),
    PlaceSearchRankBy::PROMINENCE,
    1000
);
```

The place search nearby request constructor requires a location as first argument, the rank by as second argument and 
a radius as third argument.

## Configure location

The location around which to retrieve place information.

``` php
use Ivory\GoogleMap\Base\Coordinate;

$request->setLocation(new Coordinate(-33.8670522, 151.1957362));
```

## Configure rank by

If you want to update the rank by, you can use:

``` php
use Ivory\GoogleMap\Service\Place\Search\Request\PlaceSearchRankBy;

$request->setRankBy(PlaceSearchRankBy::PROMINENCE);
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
