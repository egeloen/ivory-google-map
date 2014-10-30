# README

[![Build Status](https://secure.travis-ci.org/egeloen/ivory-google-map.png?branch=master)](http://travis-ci.org/egeloen/ivory-google-map)
[![Coverage Status](https://coveralls.io/repos/egeloen/ivory-google-map/badge.png?branch=master)](https://coveralls.io/r/egeloen/ivory-google-map?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/egeloen/ivory-google-map/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/egeloen/ivory-google-map/?branch=master)
[![Dependency Status](http://www.versioneye.com/php/egeloen:google-map/badge.svg)](http://www.versioneye.com/php/egeloen:google-map)

[![Latest Stable Version](https://poser.pugx.org/egeloen/google-map/v/stable.svg)](https://packagist.org/packages/egeloen/google-map)
[![Latest Unstable Version](https://poser.pugx.org/egeloen/google-map/v/unstable.svg)](https://packagist.org/packages/egeloen/google-map)
[![Total Downloads](https://poser.pugx.org/egeloen/google-map/downloads.svg)](https://packagist.org/packages/egeloen/google-map)
[![License](https://poser.pugx.org/egeloen/google-map/license.svg)](https://packagist.org/packages/egeloen/google-map)

The Ivory Google Map project provides a Google Map integration for your PHP 5.3+ Project. It allows you to manage map,
controls, overlays, layers, events and services through the Google Map API v3.

## Documentation

  - [Installation](/doc/installation.md)
  - [Usage](/doc/usage.md)
    - [Map](/doc/map.md)
    - [Overlays](/doc/overlays/index.md)
      - [Marker](/doc/overlays/marker.md)
      - [Info window](/doc/overlays/info_window.md)
      - [Polyline](/doc/overlays/polyline.md)
      - [Encoded Polyline](/doc/overlays/encoded_polyline.md)
      - [Polygon](/doc/overlays/polygon.md)
      - [Rectangle](/doc/overlays/rectangle.md)
      - [Circle](/doc/overlays/circle.md)
      - [Ground overlay](/doc/overlays/ground_overlay.md)
      - [Marker cluster](/doc/overlays/marker_cluster.md)
    - [Controls](/doc/controls/index.md)
      - [Map type](/doc/controls/map_type.md)
      - [Overview](/doc/controls/overview.md)
      - [Pan](/doc/controls/pan.md)
      - [Rotate](/doc/controls/rotate.md)
      - [Scale](/doc/controls/scale.md)
      - [Street view](/doc/controls/street_view.md)
      - [Zoom](/doc/controls/zoom.md)
    - [Layers](/doc/layers/index.md)
      - [Kml layer](/doc/layers/kml_layer.md)
    - [Events](/doc/events/index.md)
      - [Event](/doc/events/event.md)
      - [Dom event](/doc/events/dom_event.md)
  - [Places](/doc/places/index.md)
    - [Autocomplete](/doc/places/autocomplete.md)
  - [Services](/doc/services/index.md)
    - [Geocoding API](/doc/services/geocoding/geocoder.md)
    - [Directions API](/doc/services/directions/directions.md)
    - [Distance Matrix API](/doc/services/distance_matrix/distance_matrix.md)
    - [Business Account](/doc/services/business_account.md)

## Testing

The library is fully unit tested by [PHPUnit](http://www.phpunit.de/) with a code coverage close to **100%**. To
execute the test suite, check the travis [configuration](/.travis.yml).

## Contribution

We love contributors! Ivory is an open source project. If you'd like to contribute, feel free to propose a PR!

## License

The Ivory Google Map is under the MIT license. For the full copyright and license information, please read the
[LICENSE](/LICENSE) file that was distributed with this source code.
