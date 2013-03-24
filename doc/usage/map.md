# Map

## Build your map

``` php
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\MapTypeId;

$map = new Map();

$map->setPrefixJavascriptVariable('map_');
$map->setHtmlContainerId('map_canvas');

$map->setAsync(false);
$map->setAutoZoom(false);

$map->setCenter(0, 0, true);
$map->setMapOption('zoom', 3);

$map->setBound(-2.1, -3.9, 2.6, 1.4, true, true);

$map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
$map->setMapOption('mapTypeId', 'roadmap');

$map->setMapOption('disableDefaultUI', true);
$map->setMapOption('disableDoubleClickZoom', true);
$map->setMapOptions(array(
    'disableDefaultUI'       => true,
    'disableDoubleClickZoom' => true,
));

$map->setStylesheetOption('width', '300px');
$map->setStylesheetOption('height', '300px');
$map->setStylesheetOptions(array(
    'width'  => '300px',
    'height' => '300px',
));

$map->setLanguage('en');
```

## Configure map center & zoom

For configurating the map center & zoom, you have three possibilities:

 1. Standard center coordinate & zoom
 2. Fitting a bound
 3. Fitting a bound which extends overlays

### Standard center coordinate & zoom

To use the standard center coordinate & zoom, you need to disable the auto zoom flag & configure the center/zoom.

``` php
use Ivory\GoogleMap\Map;

$map = new Map();

// Disable the auto zoom flag
$map->setAutoZoom(false);

// Sets the center
$map->setCenter(0, 0, true);

// Sets the zoom
$map->setMapOption('zoom', 3);
```

### Fitting a bound

For fitting a bound, you need to enable the auto zoom flag & configure bound south west & nort east coordinates.
If you extend overlays with the bound, the map will fit the overlays coordinate instead of bound coordinates.

``` php
use Ivory\GoogleMap\Map;

$map = new Map();

// Enable the auto zoom flag
$map->setAutoZoom(true);

// Sets the bound coordinates
$map->setBound(-2.1, -3.9, 2.6, 1.4, true, true);
```

### Fitting a bound which extends overlays

For fitting a bound which extends overlays, you need to enable the auto zoom flag & add overlays to the bound.
In the [overlays documentation](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/index.md),
you learn how you can add overlays to the map. If the auto zoom flag is enabled and you add some overlays to the map,
the map bound will automatically extends your overlay. So, at the end, all your overlays will be visible on your sreen.

``` php
use Ivory\GoogleMap\Map,
    Ivory\GogoleMap\Overlays\Marker;

$map = new Map();

// Enable the auto zoom flag
$map->setAutoZoom(true);

// Add marker overlay to your map
$map->addMarker(new Marker());
```

## Configure map type

For configurating the map type, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\MapTypeId`` is here. It allows you to access all constants which describe map types. If you don't
want to use this class, you can directly use the constant value.

``` php
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\MapTypeId;

$map = new Map();

// Sets your map type
$map->setMapOption('mapTypeId', MapTypeId::HYBRID);
$map->setMapOption('mapTypeId', 'hybrid');

$map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
$map->setMapOption('mapTypeId', 'roadmap');

$map->setMapOption('mapTypeId', MapTypeId::SATELLITE);
$map->setMapOption('mapTypeId', 'satellite');

$map->setMapOption('mapTypeId', MapTypeId::TERRAIN);
$map->setMapOption('mapTypeId', 'terrain');
```

## Loading map asynchronously

For loading the map asynchronously, you need to set the async property to true. Enabling this feature the map will load
asynchronously, allowing you to load the map through AJAX. To do this, the javascript code is wrapped by a function
called ``load_ivory_google_map`` and the script responsible to load Google API adds the ``callback`` parameter with
this value.

``` php
use Ivory\GoogleMap\Map;

$map = new Map();
$map->setAsync(true);
```

The helper renders an html javascript block with all code needed for displaying your map wrapped in the
``load_ivory_google_map`` function.

``` html
<script type="text/javascript">
    function load_ivory_google_map() {
        // Code needed for displaying your map
    }
</script>
```

## Add overlays to your map

Overlays are objects on the map that are tied to latitude/longitude coordinates, so they move when you drag or zoom the map.
Overlays reflect objects that you "add" to the map to designate points, lines, areas, or collections of objects.

 1. [Marker](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/marker.md)
 2. [Info window](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/info_window.md)
 3. [Polyline](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/polyline.md)
 4. [EncodedPolyline](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/encoded_polyline.md)
 5. [Polygon](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/polygon.md)
 6. [Rectangle](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/rectangle.md)
 7. [Circle](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/circle.md)
 8. [Ground overlay](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/ground_overlay.md)

## Configure map control options

The maps on Google Maps contain UI elements for allowing user interaction through the map.
These elements are known as controls and you can include variations of these controls in your Google Maps API application.
Alternatively, you can do nothing and let the Google Maps API handle all control behavior.

 1. [Map type](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/controls/map_type.md)
 2. [Overview](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/controls/overview.md)
 3. [Pan](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/controls/pan.md)
 4. [Rotate](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/controls/rotate.md)
 5. [Scale](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/controls/scale.md)
 6. [Street view](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/controls/street_view.md)
 7. [Zoom](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/controls/zoom.md)
