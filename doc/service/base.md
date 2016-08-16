## Base Service Objects

The base service objects are shared classes which are reused across multiple services such as Directions, Distance 
Matrix, ...

## Distance

A distance represents a distance between two points. It contains a text and a value.

### Text

It contains a human-readable representation of the distance, displayed in units as used at the origin (or as overridden 
within the units parameter in the request).

``` php
$text = $distance->getText();
```

### Value

It indicates the distance in meters.

``` php
$value = $distance->getValue();
```

## Duration

A duration represents a time period. It contains a text and a value. 

### Text

It contains a human-readable representation of the duration.

``` php
$text = $duration->getText();
```

### Value

It indicates the duration in seconds.

``` php
$value = $duration->getValue();
```

## Fare

A fare represents a required tax. It contains a text, a value and a currency. 

### Text

The total fare amount, formatted in the requested language.

``` php
$text = $fare->getText();
```

### Value

The total fare amount, in the currency specified above.

``` php
$value = $fare->getValue();
```

### Currency

An [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) currency code indicating the currency that the amount is 
expressed in.

``` php
$currency = $fare->getCurrency();
```
