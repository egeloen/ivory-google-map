# Info box

Info box displays content in a floating window above the map. Basically, it is the same as an
[info window](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/info_window.md) but through a
different implementation. The Ivory Google Map library allows you to easily use this implementation by simply replacing
the info window helper & registering a new [extension helper](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/helper/extension.md).

So, on the map side, nothing change, you can still use an `InfoWindow`:

``` php
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\InfoWindow;

$map = new Map();

$infoWindow = new InfoWindow();
$infoWindow->setPosition(1.1, 2.1);

$map->addInfoWindow($infoWindow);
```

Now, to render the info window as info box, you need to replace the info window helper by the info box helper &
register the info box helper extension:

``` php
use Ivory\GoogleMap\Helper\Extension\InfoBoxExtensionHelper;
use Ivory\GoogleMap\Helper\MapHelper;
use Ivory\GoogleMap\Helper\Overlays\InfoBoxHelper;

// Configure your map...

$mapHelper = new MapHelper();
$mapHelper->setInfoWindowHelper(new InfoBoxHelper());
$mapHelper->setExtensionHelper('info_box', new InfoBoxExtensionHelper());

$output = $mapHelper->render($map);
```

The map output will wrap InfoBox objects instead of the InfoWindow ones.
