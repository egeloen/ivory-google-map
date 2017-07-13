Frequently asked questions
==========================
This section contains solutions to most common problems of users. Based on issues section.

1. How to use draggable with callback function?
-------
```php
$marker = new Marker(new Coordinate());

$map = new Map();
$map->getOverlayManager()->addMarker($marker);

$map->getEventManager()->addEvent(new Event(
    $marker->getVariable(),
    'dragend',
    'function() {alert("Marker dragged!");}'
))
```

2. How to set map to be fullscreen by default or change it's size?
------------------------------------------------------------------
```php
$map->setStylesheetOption('width', '100%');
$map->setStylesheetOption('height', '100%');
```

3. Adding an API key
--------------------
To add an api key you must use method ```setKey($key)``` on ApiHelperBuilder after ```create()``` method but before ```build()``` method.

```php
$apiHelper = ApiHelperBuilder::create();
$apiHelper->setKey($key);
$apiHelper = $apiHelper->build();
```

4. Accesssing markers or any map-associated variables
-----------------------------------------------------
First of all, let's assume that you have set your map id to ```map```.
```php
$map = new Map();
$map->setVariable('map');
```

Then to access your variables or anything else (like markers) you simply call proper method from ```map_container``` variable. Listing all markers in console as example:
```js
<script type="text/javascript">
console.log(map_container.overlays.markers)
</script>
```
