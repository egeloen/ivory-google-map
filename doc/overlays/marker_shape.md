# Marker shape

This object defines the marker shape to use in determination of a marker's clickable region. The shape consists of two
properties "type" and "coordinates" which define the general type of marker and coordinates specific to that type of
marker.

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
use Ivory\GoogleMap\Overlays\MarkerShapeType;

$markerShape = new MarkerShape(MarkerShapeType::CIRCLE, array(1, 2, 3));
```

## Configure your marker shape

### Configure the variable

``` php
$markerShape->setVariable('marker_shape');

### Configure the type

``` php
use Ivory\GoogleMap\Overlays\MarkerShapeType;

$markerShape->setType(MarkerShapeType::POLYGON);
```

### Configure the coordinates

``` php
$markerShape->setCoordinates(array(1, 1, 1, -1, -1, -1, -1, 1));
```

``` php
$markerShape->addPolyCoordinates(1, 1);
```
