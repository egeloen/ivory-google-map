# Events

JavaScript within the browser is event driven, meaning that JavaScript responds to interactions by generating events,
and expects a program to listen to interesting events. The event model for the Google Maps API V3 is similar to that
used in V2 of the API, though much has changed under the hood.

The events bag is accessible via:

``` php
$events = $map->getEvents();
```

  1. [Event](/doc/events/event.md)
  2. [Dom event](/doc/events/dom_event.md)
