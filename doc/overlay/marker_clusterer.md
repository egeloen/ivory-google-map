# Marker Clusterer

Some applications are required to display a large number of locations or markers. Despite the v3 JavaScript API's
significant improvement to performance, naively plotting thousands of markers on a map can quickly lead to to a
degraded user experience. Too many markers on the map cause both visual overload and sluggish interaction with the map.
To overcome this poor performance, the information displayed on the map needs to be simplified, we need a marker
clustering solution. The library supports the most popular solution: [MarkerClusterer](https://github.com/googlemaps/js-marker-clusterer).

``` php
use Ivory\GoogleMap\Overlay\MarkerClusterType;

$map->getOverlayManager()->getMarkerCluster()->setType(MarkerClusterType::MARKER_CLUSTERER);
```
