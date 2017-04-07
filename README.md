# README

[![Travis Build Status](https://travis-ci.org/egeloen/ivory-google-map.svg?branch=master)](http://travis-ci.org/egeloen/ivory-google-map)
[![AppVeyor Build status](https://ci.appveyor.com/api/projects/status/x981x6n27d0wpf0t/branch/master?svg=true)](https://ci.appveyor.com/project/egeloen/ivory-google-map/branch/master)
[![Code Coverage](https://scrutinizer-ci.com/g/egeloen/ivory-google-map/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/egeloen/ivory-google-map/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/egeloen/ivory-google-map/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/egeloen/ivory-google-map/?branch=master)
[![Dependency Status](http://www.versioneye.com/php/egeloen:google-map/badge.svg)](http://www.versioneye.com/php/egeloen:google-map)

[![Latest Stable Version](https://poser.pugx.org/egeloen/google-map/v/stable.svg)](https://packagist.org/packages/egeloen/google-map)
[![Latest Unstable Version](https://poser.pugx.org/egeloen/google-map/v/unstable.svg)](https://packagist.org/packages/egeloen/google-map)
[![Total Downloads](https://poser.pugx.org/egeloen/google-map/downloads.svg)](https://packagist.org/packages/egeloen/google-map)
[![License](https://poser.pugx.org/egeloen/google-map/license.svg)](https://packagist.org/packages/egeloen/google-map)

## Overview

The Ivory Google Map project provides a Google Map integration for your PHP 5.6+ project. It allows you to manage map,
controls, overlays, events & services through the Google Map API v3.

``` php
use Ivory\GoogleMap\Helper\Builder\ApiHelperBuilder;
use Ivory\GoogleMap\Helper\Builder\MapHelperBuilder;
use Ivory\GoogleMap\Map;

$map = new Map();

$mapHelper = MapHelperBuilder::create()->build();
$apiHelper = ApiHelperBuilder::create()
    ->setKey('API_KEY')
    ->build();

echo $mapHelper->render($map);
echo $apiHelper->render([$map]);
```

## Documentation

**You're currently browsing the 2.x documentation, if you're using the 1.x, read 
[this documentation](https://github.com/egeloen/ivory-google-map/tree/1.4.1) instead.**

   - [Installation](/doc/installation.md)
   - [Usage](/doc/usage.md)
      - [Map](/doc/map.md)
      - [Controls](/doc/control/index.md)
         - [Map type](/doc/control/map_type.md)
         - [Rotate](/doc/control/rotate.md)
         - [Scale](/doc/control/scale.md)
         - [Street view](/doc/control/street_view.md)
         - [Zoom](/doc/control/zoom.md)
         - [Fullscreen](/doc/control/fullscreen.md)
         - [Custom](/doc/control/custom.md)
      - [Events](/doc/event.md)
      - [Layers](/doc/layer/index.md)
         - [Geo Json Layer](/doc/layer/geo_json_layer.md)
         - [Heatmap Layer](/doc/layer/heatmap_layer.md)
         - [Kml Layer](/doc/layer/kml_layer.md)
      - [Overlays](/doc/overlay/index.md)
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
      - [Places](/doc/place/index.md)
         - [Autocomplete](/doc/place/autocomplete.md)
      - [Rendering](/doc/helper/index.md)
         - [Map Rendering](/doc/helper/map.md)
         - [Static Map Rendering](/doc/helper/static_map.md)
         - [Places Autocomplete Rendering](/doc/helper/place_autocomplete.md)
         - [API Rendering](/doc/helper/api.md)
      - [Services](/doc/service/index.md)
         - [Direction](/doc/service/direction/direction.md)
         - [Distance Matrix](/doc/service/distance_matrix/distance_matrix.md)
         - [Elevation](/doc/service/elevation/elevation.md)
         - [Geocoder](/doc/service/geocoder/geocoder.md)
         - [Place](/doc/service/place/index.md)
            - [Autocomplete](/doc/service/place/autocomplete/place_autocomplete.md)
            - [Detail](/doc/service/place/detail/place_detail.md)
            - [Photo](/doc/service/place/photo/place_photo.md)
            - [Search](/doc/service/place/search/place_search.md)
         - [TimeZone](/doc/service/timezone/place_timezone.md)

## Testing

The library is fully unit tested by [PHPUnit](http://www.phpunit.de/) with a code coverage close to **100%**. To
execute the test suite, check the travis [configuration](/.travis.yml).

## Contribute

We love contributors! Ivory is an open source project. If you'd like to contribute, feel free to propose a PR! You
can follow the [CONTRIBUTING](/CONTRIBUTING.md) file which will explain you how to set up the project.

## License

The Ivory Google Map is under the MIT license. For the full copyright and license information, please read the
[LICENSE](/LICENSE) file that was distributed with this source code.
