# CHANGELOG

### 2.0.2 (2017-05-27)

 * 96adf7b - Minor static map improvements + Fix tests
 * 28b02ec - [Doc] Fix maker shape example
 * f0ddba2 - [Doc] Fix typo in distance matrix
 * fe542d4 - Fix wrong class name in readme
 * 6dab543 - [Tests] Fix Httplug deprecations
 * b308d7c - Small fix - right method name setHtmlId
 
### 2.0.1 (2017-03-20)

 * c05334e - [Service] Fix direction waypoint order deserialization
 * 9366e83 - [README] Add a section for new comers
 * db5248a - [Service] Add an Httplug error plugin
 * e47c292 - [Travis] Fix the build

### 2.0.0 (2017-02-17)

 * b31cc49 - Bump Symfony to 2.7 + Add AppVeyor support
 * d2507c2 - [Doc] Fix typo
 * c627918 - [Doc] Update setHtmlId to setHtmlContainerId
 * 5ac8483 - [Composer] Remove phpunit selenium fork
 * fcf0a52 - [Helper] Add static map support
 * de7e430 - [Overlay] Add Symbol support
 * f79bcb4 - [Service] Add Place support
 * c462d08 - [Docker] Add HHVM container
 * 898d2cf - [Doc] Improve info window
 * 20e7c35 - [Docker] Rely directly on the selenium image
 * f9189b3 - [Git] Fix gitattributes
 * 24f2091 - Add docker support
 * dd50f06 - [Doc] Improve map auto zoom
 * 231e915 - [MarkerClusterer] Fix default image path
 * 1f604d0 - [Composer] Upgrade friendsofphp/php-cs-fixer to 2.x
 * fe31d0e - [Travis] Fix the functional tests
 * 6f07212 - [Travis] Upgrade selenium + chrome driver
 * 3c53919 - [Travis] Add PHP 7.1 to the matrix
 * 55cc0fe - [Gitignore] Reorganize by section
 * b205ba5 - [Scrutinizer] Add configuration file
 * d6e0f9e - Add .gitattributes file
 * d8b2c1d - Add CONTRIBUTING file
 * cf54dd4 - [License] Happy new year
 * e3036d1 - Spelling of event
 * d7d8bd0 - [README] Add section about doc versions
 * a1a7087 - Fix syntax error + transient tests
 * 7373d65 - Fix encoded polyline rendering
 * 0097535 - [README] Fix some links
 * c122162 - Fix link for 'Autocomplete'
 * 5d87649 - Fix some errors in code example
 * c99d9b5 - spelling mistake
 * a9ce1b1 - [Helper] Fix custom control rendering
 * 3ae8e09 - [Collector] Fix info window collector strategy
 * aa78bcd - [Formatter] Fix escaping
 * 5e87cc8 - [Doc] Fix typo
 * 4f99553 - [Service] Refactor parser
 * 98364d5 - [Service] Add suffix to all services
 * bcefffd - [Service] Introduce time
 * edcebbb - [Geocoder] Drop 'willdurand/geocoder' dependency
 * 688c262 - [Service] Add some adjustments
 * 8dd9863 - [Direction] Refactor namespace
 * 2295f47 - [Service] Add elevation support
 * 1faea83 - [Directions] Move transit classes in an sub namespace
 * 136ebc4 - [Service] Add API key tests
 * 126977b - [Services] Reorganize classes
 * 763674c - [MapEvents] Fix event name typo
 * 9a18502 - [Map] Add fullscreen control support
 * 51d0461 - [Map] Add custom control support
 * 52d41b4 - [Composer] Remove http cache plugin fork
 * b10cd2f - [Map] Add layer auto-zoom support
 * 979319d - [Layer] Fix geo json layer
 * cb5310f - [Map] Add heatmap layer support
 * 7ba65a2 - [Map] Add html container attributes support
 * 61c180c - [Travis] Only build the master branch & PRs
 * 481ca4e - [Doc] Add base service objects doc
 * 540f540 - [Composer] Refine lowest deps
 * 2990211 - [Tests] Fix typo
 * d802998 - [Tests] Add extension point for creating helpers
 * 062630b - [Doc] Add missing info in installation
 * 22e7296 - [Formatter] Remove default indentation
 * 687d059 - [Composer] Update suggest
 * 8fd40e0 - [Composer] Make egeloen/json-builder & symfony/event-dispatcher mandatory
 * b266f56 - [Map] Add GeoJson support
 * 2ae2a83 - [Geocoder] Add missing features
 * f038466 - [DistanceMatrix] Add missing properties to element
 * 06770ef - [Autocomplete] Add events support
 * 80c2a43 - [Map] Remove bidirectionality with manager when not needed
 * 979ffff - [Doc] Fix some missing docs + typos
 * 3c93a63 - [DistanceMatrix] Add missing request properties
 * 1cdae99 - [Directions] Add transit support
 * 9151950 - [Directions] Add departure/arrival time response support
 * f64b323 - [Directions] Add duration in traffic support
 * f774ff0 - [Directions] Add available travel modes support
 * 984a911 - [Directions] Add missing request properties
 * 9fe3744 - [Doc] Add geocoded waypoints in directions response
 * 7bce058 - [Directions] Add geocoded waypoints support
 * f0e9b2e - [Directions] Add fare support
 * 4277460 - [Service] Mutualize avoid highways and tolls
 * e9b1e1b - [Doc] Fix typo in filename
 * dd9129b - [Doc] Fix typo in directory
 * abee4d2 - [Service] Add TimeZone API support
 * 736ef9c - [Geocoder] Fix PHPDoc
 * 6b0c3ad - [DistanceMatrix] Add departure/arrival time support
 * 2231b69 - [Geocoder] Add place id
 * ca036f4 - [DistanceMatrix] Fix avoid tolls/highways
 * fdfa34d - [Doc] Fix typo
 * 376c954 - Add API key support
 * 1281697 - Move language from map/autocomplete to the renderer
 * c39c5f3 - [2.0] Refactor core
 
### 1.4.1 (2014-10-30)

 * 882cb65 - [Services] Fix origins/destinations switch for distance matrix construction
 * 197fcf1 - [Services] Handle http errors (4XX/5XX)
 * 188dc68 - [Gitignore] Remove Composer installer and phar
 * 5606a85 - Migrate to PSR-4
 * ddcf4ae - [Composer] Refine deps
 * e107ab4 - [Travis] Add hhvm-nightly + Allow hhvm/hhvm-nightly to fail
 * e152093 - Updated to use widop/http-adapter version 1.1+
 * afc822c - Added PHP 5.6 and HHVM to travis.yml
 * dbc3965 - [Travis][Composer] Remove --dev
 * 6203fee - [Composer] Upgrade to PSR-4
 * fba0016 - [Autoload] Remove dist file

### 1.4.0 (2014-06-17)

 * c622643 - [Helper][Map] Introduce renderJsContainerExtra
 * c5a19df - [Services][Directions] Fix waypoint stopover
 * b5173e9 - [Helper][Extension] Fix InfoBox loading with async map
 * b10a1a2 - Add coveralls support
 * a1608ae - [Services] Check if the http adapter returns a valid response
 * ca767aa - [Places][Autocomplete] Fix exception + tests
 * 654744c - [Helper] Rely on egeloen/json-builder
 * 533a5b0 - [Places] Fix helper rendering bug + Add component restrictions support
 * ece9738 - Update new year

### 1.3.0 (2013-12-12)

 * a308662 - [MapHelper] Fix default info window open support
 * b6a4372 - Service request language can now have 2 or 5 characteres
 * 074cd0a - Increase time between each directions tests
 * 234ad66 - [Travis] Only build the master branch
 * 9234b44 - [Service] Add business account support
 * 0520430 - [Service] Replace kriswallsmith/buzz by widop/http-adapter

### 1.2.0 (2013-10-09)

 * 94a73a1 - [Helper] Remove FORCE_JSON_ENCODE for js marker cluster + rely on json builder
 * 3fd9afb - [Asset] Enforce javascript variable unicity
 * edcea0a - [Services] Add xml support
 * 0305bbc - [Helper] Add InfoBox support
 * 3089dce - [Helper] Add extension support
 * 472461d - [Helper][Utils] Make JsonBuilder::setValues more readable

### 1.1.0 (2013-08-22)

 * bdc9014 - [Helper] Add json builder utility class
 * ca6060c - [Doc] Add a section about geocoder provider registration
 * 7c485c3 - [Overlays] Add marker cluster support
 * 2578a5d - [Helper] Fix map language with google loader

### 1.0.0 (2013-06-07)

 * 0845763 - Add Distance Matrix support
 * d0f2282 - [DirectionsRequest] Add transit travel mode support
 * 2444de8 - [Map] Allow to specify additional libraries
 * ebe2210 - Add Places Autocomplete support
 * b5bcd66 - [Directions] Make route copyrights optional
 * 1aa0083 - [Travis] Use --prefer-source to avoid random build fail

### 0.9.1 (2013-04-10)

 * 13f108a - [Exception] Rename TemplatingException to HelperException
 * 4e340c3 - [Helper] Use Google Loader for loading Google Map API v3
 * ff6b973 - [Helper] Add JS container
 * 31d7346 - Fix annotation typo
 * 28ffe07 - PSR2 compatibility
 * db3d23f - Rename 'Ivory\GoogleMap\Templating\Helper' namespace to 'Ivory\GoogleMap\Helper'

### 0.9.0 (2013-03-23)
