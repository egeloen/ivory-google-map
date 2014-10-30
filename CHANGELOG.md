# CHANGELOG

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
