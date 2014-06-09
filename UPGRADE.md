# UPGRADE

### 1.3 to 1.4

 * The `Ivory\GoogleMap\Helper\Utils\JsonBuilder` have been extracted to a dedicated library for reusability purpose.
 * The `Ivory\GoogleMap\Helper\MapHelper::renderJsContainerExtra` has been introduced in order to render method's calls
   after the JS container.
 * The `Ivory\GoogleMap\Helper\MapHelper::renderJsContainerMap` has been updated to only render the map and so, the
   method's calls have been moved to the `Ivory\GoogleMap\Helper\MapHelper::renderJsContainerExtra`.
 * The `Ivory\GoogleMap\Helper\MapHelper::renderJsContainerBoundsExtends` method has been removed/merged into the
   `Ivory\GoogleMap\Helper\MapHelper::renderJsContainerExtra`.
 * The method's calls present in the `Ivory\GoogleMap\Helper\MapHelper::renderAfter` has been moved to the
   `Ivory\GoogleMap\Helper\MapHelper::renderJsContainerExtra`.

### 1.2.0 to 1.3.0

 * The `buzz` property/getter/setter of the `AbstractService` has been removed in favor of the http adapter which
   allows to use buzz, curl, guzzle, stream, ...
 * The `AbstractService` constructor has been updated in order to replace the buzz argument by the http adapter one
   which is now first and mandatory.

### 1.1.0 to 1.2.0

 * The `apiHelper` property/getter/setter of the `MapHelper` has been removed and the constuctor has been updated
   accordingly.
 * The `MapHelper::getLibraries` method has been moved to the `CoreExtensionHelper` class.

### 1.0.0 to 1.1.0

 * The `markers` property of the `Map` have been removed in favor of the `markerCluster` property.
 * The `MapHelper` constructor have been updated to now takes a `MarkerClusterHelperInterface` as 14th arguments
   instead of the `MarkerHelper`.
 * The `markerHelper` property/getter/setter of the `MapHelper` has been removed in favor of the `markerClusterHelper`
   ones.
 * The `MapHelper::renderJsContainerMarkers` method has been removed in favor of the
   `renderJsContainerMarkerCluster` one.
 * The `MapHelper::registerMarkerInfoWindowEvent` method have been moved to the `DefaultMarkerClusterHelper` class and
   has been renamed to `registerInfoWindowEvent`.

### 0.9.1 to 1.0.0

 * The  `Distance`, `Duration`, `TravelMode` & `UnitSystem` which lived in the `Ivory\GoogleMap\Services\Directions`
   namespace have been moved in the `Ivory\GoogleMap\Services\Base` one in order to be shared across services.
 * The `MapHelper` constructor now takes an `ApiHelper` as first argument (all the other parameters have been moved
   forward).

### 0.9.0 to 0.9.1

 * All helpers classes have been refactored in order to generate a JS container by map.
 * The `TemplatingException` has been renamed to `HelperException` to be consistent with the namespace.
