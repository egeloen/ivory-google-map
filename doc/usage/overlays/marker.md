# Marker

Markers identify locations on the map. By default, they use a standard icon.

## Build your marker

``` php
use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Marker;

$marker = new Marker();

// Configure your marker options
$marker->setPrefixJavascriptVariable('marker_');
$marker->setPosition(0, 0, true);
$marker->setAnimation(Animation::DROP);

$marker->setOption('clickable', false);
$marker->setOption('flat', true);
$marker->setOptions(array(
    'clickable' => false,
    'flat'      => true,
));
```

## Configure marker animation

For configurating the marker animation, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\Overlays\Animation`` is here. It allows you to access all constants which describe marker animation.
If you don't want to use this class, you can directly use the constant value.

``` php
use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Marker;

$marker = new Marker();

// Sets your marker animation
$marker->setAnimation(Animation::BOUNCE);
$marker->setAnimation('bounce');

$marker->setAnimation(Animation::DROP);
$marker->setAnimation('drop');
```

## Configure marker icon

By default, the marker uses a standard icon. If you want to change this icon, two ways are available. You can use an
icon url or a marker image. The first solution is appropriated if you build an icon which doesn't need any specific
configuration (anchor, origin, size or scaled size). If you want to build an advanced icon, you must use the marker
image.

### Configure marker icon URL

``` php
use Ivory\GoogleMap\Overlays\Marker;

$marker = new Marker();

// Sets the icon URL
$marker->setIcon('http://maps.gstatic.com/mapfiles/markers/marker.png');
```

### Configure marker image

The complete marker image configuration is available
[here](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/marker_image.md).

``` php
use Ivory\GoogleMap\Overlays\Marker;

$marker = new Marker();

// Sets the marker image
$marker->setIcon($markerImage);
```

## Configure marker shadow

Like marker icon, the marker uses a standard shadow but if you want to change this shadow, two ways are available. You
can use a shadow url or a marker image. The first solution is appropriated if you build a shadow which doesn't need any
specific configuration (anchor, origin, size or scaled size). If you want to build an advanced shadow, you must use the
marker image.

### Configure shadow URL

``` php
use Ivory\GoogleMap\Overlays\Marker;

$marker = new Marker();

// Sets the shadow URL
$marker->setShadow('http://maps.gstatic.com/mapfiles/markers/marker.png');
```

### Configure marker image

The complete marker image configuration is available
[here](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/marker_image.md).

``` php
use Ivory\GoogleMap\Overlays\Marker;

$marker = new Marker();

// Sets the marker image
$marker->setShadow($markerImage);
```

## Configure marker shape

The complete marker shape configuration is available
[here](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/marker_shape.md).

## Add your marker to the map

Now you have configurated your marker, you need to add it to the map.

``` php
use Ivory\GoogleMap\Overlays\Marker;

$marker = new Marker();

// Add your marker to the map
$map->addMarker($marker);
```
