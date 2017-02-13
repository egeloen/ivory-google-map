# Distance

A distance represents a distance between two points. It contains a text and a value.

## Text

It contains a human-readable representation of the distance, displayed in units as used at the origin (or as overridden 
within the units parameter in the request).

``` php
$text = $distance->getText();
```

## Value

It indicates the distance in meters.

``` php
$value = $distance->getValue();
```
