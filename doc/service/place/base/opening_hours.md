# Opening Hours

## Open now

The open now is a boolean value indicating if the place is open at the current time.

``` php
$openNow = $openingHours->isOpenNow();
```

## Weekday text

The weekday text is an array of seven strings representing the formatted opening hours for each day of the week.

``` php
$weekdayTexts = $openingHours->getWeekdayTexts();
```

## Periods

The periods is an array of opening periods covering seven days.

``` php
$periods = $openingHours->getPeriods();
```

## Period

The period represents the open/close period of a single day.

``` php
foreach ($openingHours->getPeriods() as $period) {
    $open = $period->getOpen();
    $close = $period->getClose();
}
```

### Open/Close Period

The open/close period wraps a day and a time.

``` php
$day = $open->getDay();
$time = $open->getTime();
```

The day is represented by the `DayOfWeek` constants and the time is a string representing the time 
(eg. "0800" for 08:00 AM).
