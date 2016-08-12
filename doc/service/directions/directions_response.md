# Directions Response

When you have requested your direction, the returned object is a `DirectionsResponse`. It wraps a status & routes.

## Status

The available status are defined by the `DirectionsStatus` constants.

``` php
$status = $response->getStatus();
```

## Routes

A request can return many routes. The directions response wraps an array of `DirectionsRoute`.

``` php
$routes = $reponse->getRoutes();
```

## Route

A directions route wraps a bound, a copyrights, legs, an overview polyline (encoded), a summary, warnings & waypoint
order if you use it in your request.

``` php
foreach ($reponse->getRoutes() as $route) {
    // ...
}
```

### Bound

The bound defines the viewport bounding box of this route.

``` php
$bound = $route->getBound();
```

### Copyrights

The copyrights defines the text to be displayed for this route. You must handle and display this information yourself.

``` php
$copyrights = $route->getCopyrights();
```

### Legs

The directions legs defines an array which contains information about a leg of the route between two locations within
the given route. A separate leg will be present for each waypoint or destination specified. (A route with no waypoints
will contain exactly one leg within the legs array.) Each leg consists of a series of steps.

``` php
$legs = $route->getLegs();
```

### Overview Polyline

The overview polyline is an [encoded polyline](/doc/overlay/encoded_polyline.md) which represents the route.

``` php
$overviewPolyline = $route->getOverviewPolyline();
```

### Summary

The summary is a short textual description for the route, suitable for naming and disambiguating the route from
alternatives.

``` php
$summary = $route->getSummary();
```

### Warnings

It is an array of warnings to be displayed when showing these directions. You must handle and display these warnings
yourself.

``` php
$warnings = $route->getWarnings();
```

### Waypoint order

It contains an array indicating the order of any waypoints in the calculated route. This waypoints may be reordered if
the request optimizes waypoints.

``` php
$waypointOrders = $route->getWaypointOrders();
```

## Leg

A directions leg wraps a distance, a durations, a start location, an end location, a start address, an end address and
steps.

``` php
foreach ($route->getLegs() as $leg) {
    // ...
}
```

### Distance

It indicates the total distance covered by this leg. It represented by the `Distance`.

``` php
$duration = $leg->getDistance();
```

### Duration

It indicates the total duration of this leg. It is represented by the `Duration`.

``` php
$duration = $leg->getDuration();
```

### Start location

The start location is the coordinate of the start of this leg. It is represented by the `Coordinate`.

``` php
$startLocation = $leg->getStartLocation();
```

### End location

The end location is the coordinate of the end of this leg. It is represented by the `Coordinate`.

``` php
$endLocation = $leg->getEndLocation();
```

### Start Address

It contains the human-readable address (typically a street address) reflecting the start location.

``` php
$startAddress = $leg->getStartAddress();
```

### End Address

It contains the human-readable address (typically a street address) reflecting the end location.

``` php
$endAddress = $leg->getEndAddress();
```

### Steps

A leg contains an array of steps denoting information about each separate step of the leg of the journey.

``` php
$steps = $leg->getSteps();
```

## Step

A step is the most atomic unit of a direction's route, containing a single step describing a specific, single
instruction on the journey. E.g. "Turn left at W. 4th St." The step not only describes the instruction but also
contains distance and duration information relating to how this step relates to the following step. For example, a
step denoted as "Merge onto I-80 West" may contain a duration of "37 miles" and "40 minutes," indicating that the next
step is 37 miles/40 minutes from this step.

A step wraps a distance, a durations, a start location, an end location, instructions, an encoded polyline &
a travel mode.

``` php
foreach ($leg->getSteps() as $step) {
    // ...
}
```

### Distance

It contains the distance covered by this step until the next step. This field may be null if the distance is
unknown.

``` php
$distance = $step->getDistance();
```

### Duration

It contains the typical time required to perform the step, until the next step. This field may be null if the
duration is unknown.

``` php
$duration = $step->getDuration();
```

### Start Location

It contains the location of the starting point of this step. It is represented by the `Coordinate`.

``` php
$startLocation = $step->getStartLocation();
```

### End Location

It contains the location of the ending point of this step. It is represented by the Coordinate`.

``` php
$endLocation = $step->getEndLocation();
```

### Instructions

It contains formatted instructions for this step, presented as an HTML text string.

``` php
$instructions = $step->getInstructions();
```

### Encoded polyline

It represents the step as an [encoded polyline](/doc/overlay/encoded_polyline.md).

``` php
$encodedPolyline = $step->getEncodedPolyline();
```

### Travel Mode

It contains the travel mode of this step. it is represented by the `TravelMode` constants.

``` php
$travelMode = $step->getTravelMode();
```
