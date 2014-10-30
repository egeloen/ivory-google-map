# UPGRADE

### 1.4 to 2.0

 * All protected properties and methods have been updated to private except for entry points. This is mostly motivated
   for enforcing the encapsulation and easing backward compatibility.
 * The Symfony2 event dispatcher component is a mandatory dependency.
 * The Wid'op HTTP adapter library has been replaced by the Ivory HTTP adapter which follows the PSR-7.
 * All exceptions related to variable types verification have been dropped.
 * Multiple function prototypes have been dropped.
 * All controls static methods returning a list of available controls have been dropped.

Assets:

 * The `Ivory\GoogleMap\Assets\AbstractJavascriptVariableAsset` has been renamed to
   `Ivory\GoogleMap\Assets\AbstractVariableAsset` and the property/getter/setter has been renamed accordingly.
   The `setPrefixJavascriptVariable` and `generateJavascriptVariable` methods have been dropped and the behavior is
   now archives in the constructor. Finally, the constructor now takes the variable prefix as first argument instead
   of the variable.
 * The `Ivory\GoogleMap\Assets\AbstractOptionsAsset` constructor now takes the variable prefix as first argument
   instead of the variable.

Base:

 * The `Ivory\GoogleMap\Base\Bound::$extends` property has been moved to the `Ivory\GoogleMap\Overlays\Overlays`.
 * The `Ivory\GoogleMap\Base\Coordinate` longitude and latitude constructor arguments are now mandatory.
 * The `Ivory\GoogleMap\Base\Coordinate::$noWrap` property have been removed and is now handled automatically.
 * The `Ivory\GoogleMap\Base\Point` x and y constructor arguments are now mandatory.
 * The `Ivory\GoogleMap\Base\Size` width and height constructor arguments are now mandatory.

Controls:

 * The `Ivory\GoogleMap\Controls\ScaleControl::$controlPoisition` property has been dropped.

Events:

 * The `Ivory\GoogleMap\Events\Event::$capture` property has been moved to `Ivory\GoogleMap\Events\DomEvent`.
 * The `Ivory\GoogleMap\Events\Event` instance, event name and handle constructor arguments are now mandatory.
 * The `Ivory\GoogleMap\Events\DomEvent` replaces `Ivory\GoogleMap\Events\Event` for dom events.
 * The `Ivory\GoogleMap\Events\EventManager` has been renamed to `Ivory\GoogleMap\Events\Events`.

Helpers:

 * The helpers namespace has been totatlly rewritten and so absolutely does not work the same way. Please to a look to
the new [documentation](/doc/helpers/rendering.md) in order to discover how it works.

Layers:

 * The `Ivory\GoogleMap\Layers\KMLLayer` has been renamed to `Ivory\GoogleMap\Layers\KmlLayer`.
 * The `Ivory\GoogleMap\Layers\KMLLayer` url constructor argument is now mandatory.

Map:

 * The `Ivory\GoogleMap\Map::$async` has been dropped.
 * The `Ivory\GoogleMap\Map::$autoZoom` has been moved to `Ivory\GoogleMap\Overlays\Overlays`.
 * The `Ivory\GoogleMap\Map::$*Control` has been moved to `Ivory\GoogleMap\Controls\Controls`.
 * The `Ivory\GoogleMap\Map::$kmlLayer` has been moved to `Ivory\GoogleMap\Layers\Layers`.
 * The html container id is now same as the variable.

Overlays:

 * The `Ivory\GoogleMap\Overlays\ExtendableInterface` must implement the `renderExtend` method.
 * The `Ivory\GoogleMap\Overlays\Circle` center and radius constructor arguments are now mandatory.
 * The `Ivory\GoogleMap\Overlays\Circle` value constructor argument is now mandatory.
 * The `Ivory\GoogleMap\Overlays\GroundOverlay` url and bound constructor arguments are now mandatory.
 * The `Ivory\GoogleMap\Overlays\InfoWindow` constructors only accepts the content and the position. Futhermore, the
   content constructor argument is now mandatory.
 * The `Ivory\GoogleMap\Overlays\Marker` constructors only accepts the the position which is now mandatory.
 * The `Ivory\GoogleMap\Overlays\MarkerImage` has been renamed to `Ivory\GoogleMap\Overlays\Icon`. Futhermore, it only
   accepts the url constructor argument which is now mandatory.
 * The `Ivory\GoogleMap\Overlays\MarkerShape` type and coordinates constructor arguments are now mandatory.
 * The `Ivory\GoogleMap\Overlays\Polygon` coordinates constructor argument is now mandatory.
 * The `Ivory\GoogleMap\Overlays\Polyline` coordinates constructor argument is now mandatory.
 * The `Ivory\GoogleMap\Overlays\Rectangle` bound constructor argument is now mandatory.

Places autocomplete:

 * The html container id is now same as the variable.

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
