# Marker shape

This object defines the marker shape to use in determination of a marker's clickable region.
The shape consists of two properties "type" and "coordinates" which define the general type of marker and coordinates
specific to that type of marker.

The format of this attribute depends on the value of the type and follows the w3 AREA coords specification found at
http://www.w3.org/TR/REC-html40/struct/objects.html#adef-coords. The coordinates attribute is an array of integers that
specify the pixel position of the shape relative to the top-left corner of the target image. The coordinates depend on
the value of type as follows:

 - circle: coordinates is [x1, y1, r] where x1, y2 are the coordinates of the center of the circle, and r is the radius
   of the circle.
 - poly: coordinates is [x1, y1, x2, y2 ... xn, yn] where each x, y pair contains the coordinates of one vertex of the
   polygon.
 - rect: coordinates is [x1, y1, x2, y2] where x1, y1 are the coordinates of the upper-left corner of the rectangle
   and x2, y2 are the coordinates of the lower-right coordinates of the rectangle.

## Build your marker shape

``` php
use Ivory\GoogleMap\Overlays\MarkerShape;

$markerShape = new MarkerShape();

// Configure your marker shape options
$markerShape->setPrefixJavascriptVariable('marker_shape_');
$markerShape->setType('poly');
$markerShape->setCoordinates(array(1, 1, 1, -1, -1, -1, -1, 1));

// If the marker shape type is "poly", you can add coordinate one by one
$markerShape->addPolyCoordinates(1, 1);
```

## Add your marker shape to the marker

Now you have configurated your marker shape, you need to add it to your marker.

``` php
use Ivory\GoogleMap\Overlays\MarkerShape;

$markerShape = new MarkerShape();

// Add your marker shape to the marker
$marker->setShape($markerShape);
```
