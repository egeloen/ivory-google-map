# Place Search Text Request

The Google Places API Text Search Service is a web service that returns information about a set of places based on a 
string — for example "pizza in New York" or "shoe stores near Ottawa" or "123 Main Street". The service responds with a 
list of places matching the text string and any location bias that has been set.

## Build

First of all, let's build a place search text request:

``` php
use Ivory\GoogleMap\Service\Place\Search\Request\TextPlaceSearchRequest;

$request = new TextPlaceSearchRequest('Restaurants in Sydney');
```

## Configure query

The query is the text string on which to search, for example: "restaurant" or "123 Main Street". The Google Places 
service will return candidate matches based on this string and order the results based on their perceived relevance.
 
``` php
$request->setQuery('Restaurants in Sydney');
```
 
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
