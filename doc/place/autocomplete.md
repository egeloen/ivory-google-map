# Autocomplete

The Places Autocomplete feature attaches to a text field on your web page, and monitors that field for character
entries. As text is entered, Autocomplete returns Place predictions to the application in the form of a drop-down pick
list. You can use the Places Autocomplete feature to help users find a specific location, or assist them with filling
out address fields in online forms.

## Build

``` php
use Ivory\GoogleMap\Place\Autocomplete;

$autocomplete = new Autocomplete();
```

## Configure variable

A variable is automatically generated when creating an autocomplete but if you want to update it, you can use:

``` php
$autocomplete->setVariable('place_autocomplete');
```

## Configure input id

If you want to update the default html id (places_autocomplete) used for the autocomplete input, you can use:

``` php
$autocomplete->setInputId('place_input');
```

## Configure events

Javascript within the browser is event driven, meaning that Javascript responds to interactions by generating events, 
and expects a program to listen to interesting events.

 - [Build an event](/doc/event.md#build)
 - [Configure variable](/doc/event.md#configure-variable)
 - [Configure instance](/doc/event.md#configure-instance)
 - [Configure trigger](/doc/event.md#configure-trigger)
 - [Configure handle](/doc/event.md#configure-handle)
 - [Append to a place autocomplete](/doc/event.md#append-to-a-place-autocomplete)

## Configure value

If you want to set default input value, you can use:

``` pphp
$autocomplete->setValue('foo');
```

## Configure types

If you want to restrict places types, you can use:

``` php
use Ivory\GoogleMap\Place\AutocompleteType;

$autocomplete->setTypes([AutocompleteType::ESTABLISHMENT]);
```

## Configure components

If you want to restrict the autocomplete to components, you can use:

``` php
use Ivory\GoogleMap\Place\AutocompleteComponentType;

$autocomplete->setComponents([AutocompleteComponentType::COUNTRY => 'fr']);
```

## Configure bound

If you want to restrict the search area, you can configure a bound: 

``` php
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;

$autocomplete->setBound(new Bound(
    new Coordinate(-2.1, -3.9), 
    new Coordinate(2.6, 1.4)
));
```

## Configure libraries

Sometimes, you want to use the autocomplete & other Google Map related libraries. The library provides many 
integrations but not all of them. If you need a custom library (for example `drawing`), you can use:

```
$autocomplete->addLibrary('drawing');
```

## Configure input attributes

If you want to configure autocomplete input attributes, you can use:

``` php
$autocomplete->setInputAttribute('class', 'my-class');
```

## Render autocomplete

Once you have configured your autocomplete, you can render it:

- [Rendering](/doc/helper/index.md)
