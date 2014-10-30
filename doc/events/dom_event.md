# Dom event

## Build your dom event

``` php
use Ivory\GoogleMap\Events\DomEvent;

$domEvent = new DomEvent();
```

## Configure your dom event

### Configure the variable

``` php
$domEvent->setVariable('event');
```

### Configure the instance

``` php
$domEvent->setInstance($instance);
```

### Configure the event name

``` php
$domEvent->setEventName($domEventName);
```

### Configure the handle

``` php
$domEvent->setHandle($handle);
```

### Configure the capture state

``` php
$domEvent->setCapture(true);
```

## Add your dom event on the map

``` php
$map->getEvents()->addDomEvent($domEvent);
// or
$map->getEvents()->addDomEventOnce($domEvent);
```
