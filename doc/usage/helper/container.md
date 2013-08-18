# JS Container

When you call `$mapHelper->renderJavascripts($map)`, the library will generate for you all needed JS code for
displaying your map. Obviously, it is not the anarchy, all the sheet is organized in order to reuse created objects in
the client side (your JS scripts).

As explain in the doc, a map has a javascript variable which is used to render the code. For example, you have a
map with `my_map` as javascript variable, then the output will be:

```
my_map = new new google.maps.Map(/* ... */);
```

There is many objects which have a javascript variable (coordinates, markers, etc). All these objects are rendered like
a map (except for the instanciation part :)). So, you can use every objects though his javascript variable.

Additionally, a container is builded for each map in order to more easily reuse all the related objects of a map
instead of directly relying on each javascript variable.  For a map named `my_map`, the output will be:

```
my_map_container = {
    // Base
    "coordinates": {},
    "bounds": {},
    "points: {},
    "sizes": {},

    // Map
    map: null,

    // Overlays
    "circles": {},
    "encoded_polylines": {},
    "ground_overlays": {},
    "polygons": {},
    "polylines": {},
    "rectangles": {},
    "info_windows": {},
    "marker_images": {},
    "marker_shapes": {},
    "markers": {},
    "marker_cluster": null,

    // Layers
    "kml_layers": {},

    // Event Manager
    "event_manager": {
        "dom_events": {},
        "dom_events_once": {},
        "events": {},
        "events_once": {}
    },

    // Internal
    "closable_info_windows": {}
    "functions": {
        "to_array": function { /* ... */ }
    }
}
```

Each objects is aliased by his javascript variable in the container. If you have a circle named "my_circle", then you
can access it like that:

```
var my_circle = my_map_container.circles.my_circle;
```

If you want to iterate all markers on you map, you can easily archieve it:

```
for (marker in my_map_container.markers) {
    var my_marker = my_map_container.markers[marker];

    // Do what you want with your marker...
}
```
