# Events

JavaScript within the browser is event driven, meaning that JavaScript responds to interactions by generating events,
and expects a program to listen to interesting events. The event model for the Google Maps API V3 is similar to that
used in V2 of the API, though much has changed under the hood. There are two types of events:

 - User events (such as "click" mouse events) are propagated from the DOM to the Google Maps API. These events are
   separate and distinct from standard DOM events.
 - MVC state change notifications reflect changes in Maps API objects and are named using a property_changed convention.

## Build your event

``` php
use Ivory\GoogleMap\Events\Event;

$event = new Event();

// Configure your event
$event->setInstance($instance);
$event->setEventName($eventName);
$event->setHandle($handle);

// It can only be used with a DOM event
// By default, the capture flag is false
$event->setCapture(true);
```

### Instance

The ``$instance`` variable describes the javascript variable which registers the event. Each Ivory google map objects
which can register an event have a method called ``getJavascriptVariable`` which identifies this variable.

For example, in the case of an info window, it can be:

``` php
$instance = $infoWindow->getJavascriptVariable();
```

### Event name

Each object has his own event name which are described in the google map documentation.

### Handle

The ``$handle`` is the javascript function which is executed when the event is triggered.

For example, it can be:

``` php
$handle = 'function(){alert("The event has been triggered");}'
```

## Add your event to the map

The map wraps an event manager which allows you to add events. Like describes in the introduction, two differents type
of event can be used.

### DOM event

``` php
// Add a DOM event
$map->getEventManager()->addDomEvent($event);

// Add a DOM event which will be triggered only one time
$map->getEventManager()->addDomEventOnce($event);
```

### MVC event

``` php
// Add an event
$map->getEventManager()->addEvent($event);

// Add an event which will be triggered only one time
$map->getEventManager()->addEventOnce($event);
```
