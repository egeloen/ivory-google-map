# Marker Cluster

Some applications are required to display a large number of locations or markers. Despite the v3 JavaScript API's
significant improvement to performance, naively plotting thousands of markers on a map can quickly lead to to a
degraded user experience. Too many markers on the map cause both visual overload and sluggish interaction with the map.
To overcome this poor performance, the information displayed on the map needs to be simplified, we need a marker
clustering solution.

The library provides one which can be easily used & extended :)

In fact, when you use a marker in your map, internally, a marker cluster is used. A map always manages markers with a
marker cluster. Then, a marker cluster is a simple object which stores a type, markers & options:

``` php
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\MarkerCluster;

$map = new Map();

$markerCluster = $map->getMarkerCluster();
$map->setMarkerCluster($markerCluster);

$type = $markerCluster->getType();
$markers = $markerCluster->getMarkers();
$options = $markerCluster->getOptions();
```

## Default Marker Cluster

The default marker cluster is the marker cluster which does nothing... As a map has always a marker cluster, this
implementation allows to fallback on the default google map behavior. To enable it:

``` php
use Ivory\GoogleMap\Overlays\MarkerCluster;

$markerCluster->setType(MarkerCluster::_DEFAULT);
$markerCluster->setType('default');
```

## Javascript Marker Cluster

The javascript marker cluster provides a [MarkerCluster](http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/docs/examples.html)
integration. To enable it:

``` php
use Ivory\GoogleMap\Overlays\MarkerCluster;

$markerCluster->setType(MarkerCluster::MARKER_CLUSTER);
$markerCluster->setType('marker_cluster');
```

As this library can be configured, you can use options for that:

``` php
$markerCluster->setOption('gridSize', 50);
$markerCluster->setOption('maxZoom', 15);
```

## Create your own marker cluster

As explain in the introduction, the marker cluster can be easily extended, meaning your can manage yourself the
clustering. So, first step is create your own implementation:

``` php
namespace Acme\GoogleMap;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Helper\Overlays\MarkerCluster\AbstractMarkerClusterHelper;
use Ivory\GoogleMap\Overlays\MarkerCluster;

class MyFuckingMarkerClusterHelper extends AbstractMarkerClusterHelper
{
    /**
     * {@inheritdoc}
     */
    public function render(MarkerCluster $markerCluster, Map $map)
    {
        // Your implementation
    }

    /**
     * {@inheritdoc}
     */
    public function renderMarkers(MarkerCluster $markerCluster, Map $map)
    {
        // Your implementation
    }

    /**
     * {@inheritdoc}
     */
    public function renderLibraries(MarkerCluster $markerCluster, Map $map)
    {
        // Your implementation
    }
}
```

After, you must register your marker cluster helper:

``` php
use Acme\GoogleMap\MyFuckingMarkerClusterHelper;
use Ivory\GoogleMap\Helper\MapHelper;

$mapHelper = new MapHelper();
$markerClusterHelper = new MyFuckingMarkerClusterHelper();

$mapHelper->getMarkerClusterHelper()->addHelper('my_helper', $markerClusterHelper);
```

Then, just use it:

``` php
$map = new Map();
$map->getMarkerCluster()->setType('my_helper');
```
