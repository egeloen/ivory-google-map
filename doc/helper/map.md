# Map Rendering

The map rendering only allows you to render a map. The javascript map code will be wrapped into a unique named function.

## Build

First of all, if you want to render a map, you will need to build a map helper. So, let's go:

``` php
use Ivory\GoogleMap\Helper\Builder\MapHelperBuilder;
 
$mapHelperBuilder = MapHelperBuilder::create(); 
$mapHelper = $mapHelperBuilder->build();
```

The map helper is built via a builder. The builder allows you to configure the helper json builder, formatter and 
subscribers. The json builder allows to build advanced JSON, the formatter allows to format the generated code and the 
subscribers allow you to attach additional code to the map.

## Configure subscribers

If you want to hook into the map rendering process, you can use: 

``` php
$mapHelperBuilder->addSubscriber(/* ... */);
```

## Configure debug

If you want to more easily debug the generated code, you can use:

``` php
$mapHelperBuilder->getFormatter()->setDebug(true);
$mapHelperBuilder->getFormatter()->setIndentationStep(4);
```

## Render html container

For rendering a map, you need an html container. To render it, you can use:

```
echo $mapHelper->renderHtml($map);
```

This method renders an html div block with the html id, the width and the height configured:

``` html
<div id="map_canvas" style="width:300px;height:300px"></div>
```

## Render javascript

For rendering a map, you need javascript code. To render it, you can use:

```
echo $mapHelper->renderJavascript($map);
```

This method renders an html javascript block with all code needed for displaying your map.

``` html
<script type="text/javascript">
    // Code needed for displaying your map
</script>
```

### Use objects on client side

Being able to reuse objects on the client side is a must have. Hopefully, the library supports it natively. Basically, 
all objects implementing the `VariableAwareInterface` have a javascript variable. When rendering you code, the helper 
will attach the object to its variable. Given you have a marker which uses `my_marker` as variable, then the generated 
code is: 
  
``` js
my_marker = new google.maps.Marker({ /* ... */ });
```
 
Then, you can access the marker everywhere in your code by relying on `my_marker`:

``` js
var position = my_marker.getPosition();
```

The helper also organizes all objects under a container. That allows you to easily retrieve everything linked to a 
specific map. Given you have a map which uses `my_map` as variable. Then, the generated container is:

``` json
my_map_container = {
    "base": {
        "coordinates": [],
        "bounds": [],
        "points": [],
        "sizes": []
    },
    "map": null,
    "overlays": {
        "circles": [],
        "encoded_polylines": [],
        "ground_overlays": [],
        "polygons": [],
        "polylines": [],
        "rectangles": [],
        "info_windows": [],
        "markers": [],
        "marker_cluster": null,
    },
    "layers": {
        "kml_layers": []
    },
    "events": {
        "dom_events": [],
        "dom_events_once": [],
        "events": [],
        "events_once": []
    },
    "functions": {
        "info_windows_close": function { /* ... */},
        "to_array": function { /* ... */ }
    }
}
```

With the container, you can easily iterate over any collections int the map. For example, iterating over makers is as 
simple as:

```  js
for (var marker in my_map.overlays.markers) {
    // ...
}
```

## Render stylesheet

A map can have optional stylesheet. If you want to render it, you can use:

```
echo $mapHelper->renderStylesheet($map);
```

This methods renders an html style block with the CSS configured:

``` html
<style type="text/css">
    /* CSS configured */
</style>
```

## Render all

If you want to render everything (stylesheet + html container + javascript), you can use:

```
echo $mapHelper->render($map);
```

This methods renders all:

``` html
<style type="text/css">
    /* CSS configured */
</style>
<div id="map_canvas" style="width:300px;height:300px"></div>
<script type="text/javascript">
    // Code needed for displaying your map
</script>
```

## What Next?

Since the map rendering is the first step in the rendering process, you should be interested into rendering the 
[API](/doc/helper/api.doc).
