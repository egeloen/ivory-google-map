# Place Autocomplete Request

An autocomplete request allows you to find place predictions based on user input.

## Build

First of all, let's build a place autocomplete request:

``` php
use Ivory\GoogleMap\Service\Place\Autocomplete\Request\PlaceAutocompleteRequest;

$request = new PlaceAutocompleteRequest('Sydney');
```

The place autocomplete request constructor requires the user input as first argument.

## Configure input

If you want to update the user input, you can use:

``` php
$request->setInput('Sydney');
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

## Configure types

The types of place results to return:

``` php
$request->setTypes([AutocompleteType::GEOCODE]);
```

## Configure components

A grouping of places to which you would like to restrict your results:

``` php
use Ivory\GoogleMap\Place\AutocompleteComponentType;

$request->setComponents([
    AutocompleteComponentType::POSTAL_CODE => 59800,
    AutocompleteComponentType::COUNTRY   => 'fr',
]);
```

## Configure language

The language code, indicating in which language the results should be returned, if possible:
 
``` php
$request->setLanguage('fr');
```
