# Place Autocomplete Request

Depending on what you want to process, you need to choose the appropriate request. The library allows you to process 
a nearby request, a radar request or a text request.

## Nearby request

A Nearby Search lets you search for places within a specified area. You can refine your search request by supplying 
keywords or specifying the type of place you are searching for.

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

If you want to learn more about it, you can read its 
[documentation](/doc/service/place/search/place_search_nearby_request.md).

## Radar request

The Google Places API Radar Search Service allows you to search for up to 200 places at once, but with less detail 
than is typically returned from a Text Search or Nearby Search request. With Radar Search, you can create applications 
that help users identify specific areas of interest within a geographic area.

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Place\Search\Request\RadarPlaceSearchRequest;

$request = new RadarPlaceSearchRequest(
    new Coordinate(-33.8670522, 151.1957362),
    1000
);
```

If you want to learn more about it, you can read its 
[documentation](/doc/service/place/search/place_search_radar_request.md).

## Text request

The Google Places API Text Search Service is a web service that returns information about a set of places based on a 
string — for example "pizza in New York" or "shoe stores near Ottawa" or "123 Main Street". The service responds with a 
list of places matching the text string and any location bias that has been set.

``` php
use Ivory\GoogleMap\Service\Place\Search\Request\TextPlaceSearchRequest;

$request = new TextPlaceSearchRequest('Restaurants in Sydney');
```

If you want to learn more about it, you can read its 
[documentation](/doc/service/place/search/place_search_text_request.md).
