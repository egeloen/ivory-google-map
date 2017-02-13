# Place Autocomplete Query Request

An autocomplete query request allows you to find query predictions based on user input.

## Build

First of all, let's build a place autocomplete query request:

``` php
use Ivory\GoogleMap\Service\Place\Autocomplete\Request\PlaceAutocompleteQueryRequest;

$request = new PlaceAutocompleteQueryRequest('Pizza near Par');
```

The place autocomplete query request constructor requires the user input as first argument.

## Configure input

If you want to update the user input, you can use:

``` php
$request->setInput('Pizza near Par');
```

## Configure offset

The offset is the position, in the input term, of the last character that the service uses to match predictions:

``` php
$request->setOffset(3);
```

## Configure location

The location is the point around which you wish to retrieve place information:

``` php
use Ivory\GoogleMap\Base\Coordinate;

$request->setLocation(new Coordinate(48.865475, 2.321118));
```

## Configure radius

The distance (in meters) within which to return place results:

``` php
$request->setRadius(200);
```

## Configure language

The language code, indicating in which language the results should be returned, if possible:
 
``` php
$request->setLanguage('fr');
```
