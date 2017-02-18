# Static Map Rendering

The static map rendering lets you embed a Google Maps image on your web page without requiring javascript or any 
dynamic page loading.

## Build

First of all, if you want to render a static map, you will need to build a static map helper. So, let's go:

``` php
use Ivory\GoogleMap\Helper\Builder\StaticMapHelperBuilder;
 
$staticMapHelperBuilder = StaticMapHelperBuilder::create(); 
$staticMapHelper = $staticMapHelperBuilder->build();
```

The map helper is built via a builder. The builder allows you to configure your api key and subscribers. The api key 
allows you to bypass Google rate limits and subscribers allow you to attach additional code to the map.

## Configure API key

If you have an API key, you can use:

``` php
$staticMapHelperBuilder->setKey('api-key');
```

## Configure secret

If you have a secret key, you can use:

``` php
$staticMapHelperBuilder->setSecret('secret');
```

## Configure client id / channel

If you have a client or channel, you can use:

``` php
$staticMapHelperBuilder->setClient('client-id');
$staticMapHelperBuilder->setChannel('channel');
```

## Configure subscribers

If you want to hook into the static map rendering process, you can use: 

``` php
$staticMapHelperBuilder->addSubscriber(/* ... */);
```

## Render

For rendering a static map, you can use:

```
echo '<img src="'.$mapHelper->render($map).'" />';
```

This method renders an url according to your map:

``` html
<img src="map_url" />
```
