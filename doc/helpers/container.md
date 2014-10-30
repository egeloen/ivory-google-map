# JS Container

When you call `$mapHelper->renderJavascripts($map)`, the library will generate for you all needed JS code for
displaying your map. Obviously, all the code is organized in order to reuse created objects in the client side
(your JS scripts).

As explain in the doc, a map has a variable which is used to render the code. For example, you have a map with
`my_map` as variable, then the output will be:

```
my_map = new new google.maps.Map(/* ... */);
```

There is many objects which have a variable (coordinates, markers, etc). All these objects are rendered like a map
(except for the instanciation part :)). So, you can use every objects though his variable.

Additionally, a container is builded for each map in order to more easily reuse all the related objects of a map
instead of directly relying on each variable. For a map named `my_map`, the output will be:

``` json
{
    "base": {
        "coordinates": [],
        "bounds": [],
        "points": [],
        "sizes": []
    },
    "map": null,
    "overlays": {
        "circles": [],
        "encoded_polylines": [],
        "ground_overlays": [],
        "polygons": [],
        "polylines": [],
        "rectangles": [],
        "info_windows": [],
        "info_boxes": [],
        "icons": [],
        "marker_shapes": [],
        "markers": [],
        "marker_cluster": null
    },
    "layers": {
        "kml_layers": []
    },
    "events": {
        "dom_events": [],
        "dom_events_once": [],
        "events": [],
        "events_once": []
    },
    "functions": {
        "info_windows": {
            "close": function () {}
        },
        "to_array": function (o) {
            var a=[];for(var k in o){a.push(o[k]);}return a;
        }
    }
}
```

Each objects is aliased by his variable in the container. If you have a circle named "my_circle", then you can access
it like that:

```
var my_circle = my_map_container.circles.my_circle;
```

If you want to iterate all markers on you map, you can easily archive it:

```
for (marker in my_map_container.markers) {
    var my_marker = my_map_container.markers[marker];

    // Do what you want with your marker...
}
```
