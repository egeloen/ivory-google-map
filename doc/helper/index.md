# Rendering (Helper)

Rendering maps or place autocompletes is very simple but need to be well understood. When you render something, it is 
always in two steps (except for static map rendering). In the first step, we render maps and place autocompletes 
javascript code. Each rendering is automatically wrapped into a unique named functions meaning maps and place 
autocompletes have not been instantiated at this state (only defined). Then, at the second step, we render the API 
javascript code which loads the Google API and automatically calls all map and place autocomplete functions previously 
defined (only when the required libraries have been loaded).
 
**The API rendering must always be done after all objects (maps and place autocompletes) have been rendered.** 

If you want to learn more about each rendering, you can read the following:

 - [Map Rendering](/doc/helper/map.md)
 - [Static Map Rendering](/doc/helper/static_map.md)
 - [Place Autocomplete Rendering](/doc/helper/place_autocomplete.md)
 - [API Rendering](/doc/helper/api.md)

## Render Map

Here, an example rendering a map:

``` php
use Ivory\GoogleMap\Helper\Builder\ApiHelperBuilder;
use Ivory\GoogleMap\Helper\Builder\MapHelperBuilder;
use Ivory\GoogleMap\Map;

$map = new Map();
 
$mapHelper = MapHelperBuilder::create()->build();
$apiHelper = ApiHelperBuilder::create()->build();

echo $mapHelper->render($map);
echo $apiHelper->render([$map]);
```

## Render Static Map

Here, an example rendering a static map:

``` php
use Ivory\GoogleMap\Helper\Builder\StaticMapHelperBuilder;
use Ivory\GoogleMap\Map;

$map = new Map();
 
$staticMapHelper = StaticMapHelperBuilder::create()->build();

echo '<img src="'.$staticMapHelper->render($map).'" />';
```

## Render Place Autocomplete

Here, an example rendering a place autocomplete:

``` php
use Ivory\GoogleMap\Helper\Builder\ApiHelperBuilder;
use Ivory\GoogleMap\Helper\Builder\PlaceAutocompleteHelperBuilder;
use Ivory\GoogleMap\Place\Autocomplete;

$autocomplete = new Autocomplete();

$autocompleteHelper = PlaceAutocompleteHelperBuilder::create()->build();
$apiHelper = ApiHelperBuilder::create()->build();

echo $autocompleteHelper->render($autocomplete);
echo $apiHelper->render([$autocomplete]);
```

## Render Multiple Objects

Here, an example rendering multiple maps and place autocompletes:

``` php
use Ivory\GoogleMap\Helper\Builder\ApiHelperBuilder;
use Ivory\GoogleMap\Helper\Builder\MapHelperBuilder;
use Ivory\GoogleMap\Helper\Builder\PlaceAutocompleteHelperBuilder;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Place\Autocomplete;

$autocomplete = new Autocomplete();
$mapHeader = new Map();
$mapFooter = new Map();

$autocompleteHelper = PlaceAutocompleteHelperBuilder::create()->build(); 
$mapHelper = MapHelperBuilder::create()->build();
$apiHelper = ApiHelperBuilder::create()->build();

echo $mapHelper->render($mapHeader);
echo $autocompleteHelper->render($autocomplete);
echo $mapHelper->render($mapFooter);
echo $apiHelper->render([$autocomplete, $mapHeader, $mapFooter]);
```
