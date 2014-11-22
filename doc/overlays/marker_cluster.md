# Marker Cluster

Some applications are required to display a large number of locations or markers. Despite the v3 JavaScript API's
significant improvement to performance, naively plotting thousands of markers on a map can quickly lead to to a
degraded user experience. Too many markers on the map cause both visual overload and sluggish interaction with the map.
To overcome this poor performance, the information displayed on the map needs to be simplified, we need a marker
clustering solution.

## Build your marker cluster

``` php
use Ivory\GoogleMap\Overlays\MarkerCluster;

$markerCluster = new MarkerCluster();
```

## Configure your marker cluster

### Configure the markers

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlays\Marker;

$markerCluster->addMarker(new Marker(new Coordinate(1.1, 2.1)));
```

### Configure the type

``` php
use Ivory\GoogleMap\Overlays\MarkerClusterType;

// Default marker cluster (none)
$markerCluster->setType(MarkerClusterType::_DEFAULT);

// Google marker cluster (http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/docs/examples.html)
$markerCluster->setType(MarkerCluster::MARKER_CLUSTER);
```

### Configure the options

``` php
$markerCluster->setOption('maxZoom', 15);
```

## Set the marker cluster on the map

``` php
$map->getOverlays()->setMarkerCluster($markerCluster);
```
