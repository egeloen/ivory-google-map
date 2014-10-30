# Rendering

The rendering process is probably the more complex part of the library and so maybe the more complex one to
understand... Don't be afraid, rendering a map is very simple but how it is archive internally can be difficult to
understand for beginners.

## Overview

Rendering a map is done in two steps. First, you render the map and then, you render the goole map api loading which
will trigger asynchronously the rendering of the previously rendered map. Everything is done asynchronously in order to
be able to trigger the api loading at the very end of the page and the map/api rendering are decoupled in order to
make the api helper awares of the multiple elements which have been rendered. Basically, you can render multiple maps
on the same page or a map with a places autocomplete. So, decoupling them makes the api helper able to trigger the
rendering of all the elements rendered.

In all helpers, the main concept is everything is done around an event dispatcher. Basically, when you render something,
an event dedicated to this specific rendering is dispatched and then, the subscribers appends/wraps the code which is
finally returned. Internally, each subscriber uses renderers which are responsible to render a specific feature (for
example render a coordinate instantiation), aggregators which are responsible to aggregate objects before rendering
them (for example aggregate all coordinates over the map graph object) and a formatter in order to make the code
readable in debug mode and do other internal stuff.

On top of this concept, to give you helpers with all core subscribers registered, multiple factory implementations are
available.

Here an example of two maps and one places autocomplete rendered on the same page:

``` php
use Ivory\GoogleMap\Helpers\Factories\HelperFactory;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Places\Autocomplete;

$autocomplete = new Autocomplete();
$map1 = new Map();
$map2 = new Map();

$helperFactory = new HelperFactory();

$autocompleteHelper = $helperFactory->createPlacesAutocompleteHelper();
$mapHelper = $helperFactory->createMapHelper();
$apiHelper = $helperFactory->createApiHelper();

echo $autocompleteHelper->render($autocomplete);
echo $mapHelper->render($map1);
echo $mapHelper->render($map2);
echo $apiHelper->render(array($autocomplete, $map1, $map2));
```

## Helper factory

As explain, an helper factory allows you to create fully configured helpers which are mandatory to render a map. There
are multiple implementations which implement `Ivory\GoogleMap\Helpers\Factories\HelperFactoryInterface`:

 - PHP helper factory: A plain PHP implementation which does not require any dependency.
 - Symfony2 helper factory: An implementation using the Symfony dependency injection component.

An important concept is the fact there is only one instance of each object except for the event dispatcher.

### PHP factory

``` php
use Ivory\GoogleMap\Helpers\Factories\HelperFactory;

$helperFactory = new HelperFactory();
```

By default, the helper factory is configured for a prod environment but you can enable the debug with:

``` php
use Ivory\GoogleMap\Helpers\Factories\HelperFactory;

$helperFactory = new HelperFactory(true);
// or
$helperFactory->setDebug(true);
```

### Symfony2 factory

``` php
use Ivory\GoogleMap\Helpers\Factories\Symfony2HelperFactory;

$helperFactory = new Symfony2HelperFactory();
```

By default, the helper factory is configured for a prod environment but without caching. To enable it:

``` php
use Ivory\GoogleMap\Helpers\Factories\Symfony2HelperFactory;

$helperFactory = new Symfony2HelperFactory(false, 4, __DIR__.'/cache');
// or
$helperFactory->setCachePath(__DIR__.'/cache');
```

## Map helper

The map helper is available through the helper factory:

``` php
$mapHelper = $helperFactory->createMapHelper();
```

The main method of the map helper is the `render` which renders all html code included html, js and css but you can
render each of them individually:

``` php
echo $mapHelper->render($map);
// or
echo $mapHelper->renderHtml($map);
echo $mapHelper->renderJavascript($map);
echo $mapHelper->renderStylesheet($map);
```

Additionally, the rendered map objects are stored in a container as explained [here](/doc/helpers/container.md).

## Places autocomplete helper

The places autocomplete helper is available through the helper factory:

``` php
$autocompleteHelper = $helperFactory->createPlacesAutocompleteHelper();
```

The main method of the places autocomplete helper is the `render` which renders all html code included html and js but
you can render each of them individually:

``` php
echo $autocompleteHelper->render($map);
// or
echo $autocompleteHelper->renderHtml($map);
echo $autocompleteHelper->renderJavascript($map);
```

## Api helper

The api helper is available through the helper factory:

``` php
$apiHelper = $helperFactory->createApiHelper();
```

To render the api loading, you can use:

``` php
echo $apiHelper->render(array($map, autocompleteHelper));
```
