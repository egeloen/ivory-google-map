# Marker image (Equivalent to marker icon & marker shape)

Markers may define an icon to show in place of the default icon or a shadow to shown in place of the default shadow.
Defining an icon or a shadow involves setting a number of properties that define the visual behavior of the marker.

## Build your marker image

``` php
use Ivory\GoogleMap\Overlays\MarkerImage;

$markerImage = new MarkerImage();

// Configure your marker image options
$markerImage->setPrefixJavascriptVariable('marker_image_');
$markerImage->setUrl('http://maps.gstatic.com/mapfiles/markers/marker.png');
$markerImage->setAnchor(20, 34);
$markerImage->setOrigin(0, 0);
$markerImage->setSize(20, 34, "px", "px");
$markerImage->setScaledSize(20, 34, "px", "px");
```

## Add your marker image to a marker

Now you have configurated your marker image, you need to add it like an icon or a shadow to your marker.

### Adds the marker image to a marker as icon

``` php
use Ivory\GoogleMap\Overlays\MarkerImage;

$markerImage = new MarkerImage();

// Add your marker image to the marker like an icon
$marker->setIcon($markerImage);
```

### Add your marker image to the marker as shadow

``` php
use Ivory\GoogleMap\Overlays\MarkerImage;

$markerImage = new MarkerImage();

// Add your marker image to the marker like a shadow
$marker->setShadow($markerImage);
```
