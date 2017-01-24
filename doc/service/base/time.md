# Time

A time represents a specific moment. It contains a text, a value and a timezone. 

## Value

The time value if a `DateTime` object configured with the above timezone:

``` php
$value = $time->getValue();
```

## Time zone

The timezone of the time: 

``` php
$timeZone = $time->getTimeZone();
```

## Text

The time, formatted in the requested language:

``` php
$text = $time->getText();
```
