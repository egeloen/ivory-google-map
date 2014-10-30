# Event

## Build your event

``` php
use Ivory\GoogleMap\Events\Event;

$event = new Event();
```

## Configure your event

### Configure the variable

``` php
$event->setVariable('event');
```

### Configure the instance

``` php
$event->setInstance($instance);
```

### Configure the event name

``` php
$event->setEventName($eventName);
```

### Configure the handle

``` php
$event->setHandle($handle);
```

## Add your event on the map

``` php
$map->getEvents()->addEvent($event);
// or
$map->getEvents()->addEventOnce($event);
```
