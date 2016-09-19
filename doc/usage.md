# Usage

## Configure map

The Map is the central point of the library. It allows you to manipulate all available options. If you render the 
default map, the library will generate a map of 300px by 300px, centered on the coordinate (0, 0), configured with 
a zoom of 3 & using the default controls.

 - [Build a map](/doc/map.md#build)
 - [Configure variable](/doc/map.md#configure-variable)
 - [Configure html id](/doc/map.md#configure-html-id)
 - [Configure center & zoom](/doc/map.md#configure-center-zoom)
 - [Configure libraries](/doc/map.md#configure-libraries)
 - [Configure language](/doc/map.md#configure-language)
 - [Configure options](/doc/map.md#configure-otpions)
 - [Configure stylesheets](/doc/map.md#configure-stylesheets)

## Configure controls

The maps on Google Maps contain UI elements for allowing user interaction through the map. These elements are known as
controls and you can include variations of these controls in your Google Maps API application. Alternatively, you
can do nothing and let the Google Maps API handle all control behavior.

 - [Map Type](/doc/control/map_type.md)
 - [Rotate](/doc/control/rotate.md)
 - [Scale](/doc/control/scale.md)
 - [Street View](/doc/control/street_view.md)
 - [Zoom](/doc/control/zoom.md)
 - [Fullscreen](/doc/control/fullscreen.md)
 - [Custom](/doc/control/custom.md)
 
## Configure layers

Layers are objects on the map that consist of one or more separate items, but are manipulated as a single unit. Layers 
generally reflect collections of objects that you add on top of the map to designate a common association. Layers may 
also alter the presentation layer of the map itself, slightly altering the base tiles in a fashion consistent with the 
layer.

 - [Geo Json Layer](/doc/layer/geo_json_layer.md)
 - [Heatmap Layer](/doc/layer/heatmap_layer.md)
 - [Kml Layer](/doc/layer/kml_layer.md)

## Configure overlays

Overlays are objects on the map that are tied to latitude/longitude coordinates, so they move when you drag or zoom
the map. Overlays reflect objects that you "add" to the map to designate points, lines, areas, or collections of
objects.

 - [Marker](/doc/overlay/marker.md)
 - [Info Window](/doc/overlay/info_window.md)
 - [Info Box](/doc/overlay/info_box.md)
 - [Polyline](/doc/overlay/polyline.md)
 - [Encoded Polyline](/doc/overlay/encoded_polyline.md)
 - [Polygon](/doc/overlay/polygon.md)
 - [Rectangle](/doc/overlay/rectangle.md)
 - [Circle](/doc/overlay/circle.md)
 - [Ground Overlay](/doc/overlay/ground_overlay.md)
 - [Marker Clusterer](/doc/overlay/marker_clusterer.md)

## Configure events

Javascript within the browser is event driven, meaning that Javascript responds to interactions by generating events, 
and expects a program to listen to interesting events.

 - [Build an event](/doc/event.md#build)
 - [Configure variable](/doc/event.md#configure-variable)
 - [Configure instance](/doc/event.md#configure-instance)
 - [Configure trigger](/doc/event.md#configure-trigger)
 - [Configure handle](/doc/event.md#configure-handle)
 - [Append to a map](/doc/event.md#append-to-a-map)

## Render map

Once you have configured your map, you can render it:

- [Rendering](/doc/helper/index.md)
