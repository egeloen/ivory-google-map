# Geometry

A geometry is a set of technical geographic informations.

## Location

The location is a `Coordinate` representing the location of this geometry.

``` php
$location = $geometry->getLocation();
```

## Location type

The location type provides additional data about the specified location. The available values are defined by 
the `GeometryLocationType`. 

``` php
$locationType = $geometry->getLocationType();
```

## Viewport

The viewport is a `Bound` which provide the recommended viewport for the returned result.

``` php
$viewport = $geometry->getViewport();
```

## Bound

The bound is a `Bound` which provide the full viewport for the returned result.

``` php
$bound = $geometry->getBound();
```
