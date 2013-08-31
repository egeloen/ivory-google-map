# Usage

Before starting, I recommend you to read the google map API v3 documentation which is available
[here](http://code.google.com/apis/maps/documentation/javascript/reference.html). It will give you a better understand
for the next parts.

## Build your map

First of all, if you want to render a map, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Map;

$map = new Map();
```

The Map is the central point of the library. It allows you to manipulate all available options. If you render the
default map, the library will generate a map of 300px by 300px, centered on the coordinate (0, 0), configured with a
zoom of 3 & using the default controls.

## Configure your map

Now, you have a map, you can configure it easily. The complete map configuration is available
[here](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/map.md).

### Configure overlays

Overlays are objects on the map that are tied to latitude/longitude coordinates, so they move when you drag or zoom
the map. Overlays reflect objects that you "add" to the map to designate points, lines, areas, or collections of
objects.

 1.  [Marker](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/marker.md)
 2.  [Info window](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/info_window.md)
 3.  [Info box](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/info_box.md)
 4.  [Polyline](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/polyline.md)
 5.  [Encoded Polyline](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/encoded_polyline.md)
 6.  [Polygon](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/polygon.md)
 7.  [Rectangle](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/rectangle.md)
 8.  [Circle](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/circle.md)
 9.  [Ground overlay](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/ground_overlay.md)
 10. [Marker cluster](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/marker_cluster.md)

### Configure controls

The maps on Google Maps contain UI elements for allowing user interaction through the map. These elements are known as
``controls`` and you can include variations of these controls in your Google Maps API application. Alternatively, you
can do nothing and let the Google Maps API handle all control behavior.

 1. [Map type control](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/controls/map_type.md)
 2. [Overview](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/controls/overview.md)
 3. [Pan](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/controls/pan.md)
 4. [Rotate](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/controls/rotate.md)
 5. [Scale](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/controls/scale.md)
 6. [Street view](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/controls/street_view.md)
 7. [Zoom](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/controls/zoom.md)

### Configure events

The complete events configuration is available
[here](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/events.md).

### Configure additional libraries

Sometimes, you want to use the map & other Google Map related libraries. The bundle provides many integrations but not
all of them. If you need a custom libraries, you can use the following API on your map:

```
$map->setLibraries(array('places', 'geometry'));
$libraries = $map->getLibraries();
$hasLibraries = $map->hasLibraries();
```

## Render your map

Now, you have builded & configured your map, you can render it. For this purpose, you will need the
`Ivory\GoogleMap\Helper\MapHelper` which allows to render the map html container & some javascript for being
able to render it.

```
use Ivory\GoogleMap\Helper\MapHelper;

$mapHelper = new MapHelper();
```

### Render the HTML container

```
echo $mapHelper->renderHtmlContainer($map);
```

This function renders an html div block with the HTML container ID, the width & the height configured:

``` html
<div id="map_canvas" style="width:300px;height:300px"></div>
```

### Render the javascript

```
echo $mapHelper->renderJavascripts($map);
```

This function renders an html javascript block with all code needed for displaying your map.

``` html
<script type="text/javascript">
    // Code needed for displaying your map
</script>
```

The generated code is organized to be reusable in the client side. If you want to learn more, you can read this
[documentation](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/helper/container.md).

Additionally, the library allows you to add/render your own javascript libraires and append some code just before or
after the generated code through extensions. If you want to learn more about that, you can read this
[documentation](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/helper/extension.md).

### Render the CSS (Optional)

Additionally, you can configure some CSS directly on the map.

```
echo $mapHelper->renderStylesheets($map);
```

This function renders an html style block with the CSS configured.

``` html
<style type="text/css">
    /* CSS configured */
</style>
```

If you want to render all of them, you can use:

```
echo $mapHelper->render($map);
```

``` html
<style type="text/css">
    /* CSS configured */
</style>
<div id="map_canvas" style="width:300px;height:300px"></div>
<script type="text/javascript">
    // Code needed for displaying your map
</script>
```

There is many other methods you can use if you only render specific "parts" of the map. I let you read the class :)
