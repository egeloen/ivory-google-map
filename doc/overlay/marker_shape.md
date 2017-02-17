# Marker Shape

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

## Build

First of all, if you want to render a marker shape, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Overlay\MarkerShape;
use Ivory\GoogleMap\Overlay\MarkerShapeType;

$markerShape = new MarkerShape(MarkerShapeType::CIRCLE, [1.1, 2.0, 1.4]);
```

## Configure variable

A variable is automatically generated when creating a marker shape but if you want to update it, you can use:

``` php
$markerShape->setVariable('marker_shape');
```

## Configure type

If you want to update the type, you can use:

``` php
$markerShape->setType('poly');
```

## Configure coordinates

If you want to update the coordinate, you can use:

``` php
$markerShape->setCoordinates([1.1, 2.0, 1.4]);
```
