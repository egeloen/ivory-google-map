# Place
 
A place represents a physical place on the earth.

## Id

The id is a unique stable identifier denoting this place. This identifier may not be used to retrieve information 
about this place, but can be used to consolidate data about this place, and to verify the identity of a place across 
separate searches.

``` php
$id = $place->getId();
```

## Place id

The place is a textual identifier that uniquely identifies a place (it is similar to the id).

``` php
$placeId = $place->getPlaceId();
```

## Name

The name is the human-readable name for the returned result.

``` php
$name = $place->getName();
```

## Formatted address

The formatted address is a string containing the human-readable address of this place.

``` php
$formattedAddress = $place->getFormattedAddress();
```

## Formatted phone number

The formatted phone number is the place's phone number in its 
[local format](https://en.wikipedia.org/wiki/Local_conventions_for_writing_telephone_numbers).

``` php
$formattedPhoneNumber = $place->getFormattedPhoneNumber();
```

## International phone number

The international phone number is the place's phone number in international format. International format includes the 
country code, and is prefixed with the plus (+) sign.

``` php
$internationalPhoneNumber = $place->getInternationalPhoneNumber();
```

## Url

The url is the URL of the official Google page for this place. This will be the Google-owned page that contains the 
best available information about the place.

``` php
$url = $place->getUrl();
```

## Icon

The icon is the URL of a suggested icon which may be displayed to the user when indicating this result on a map.

``` php
$icon = $place->getIcon();
```

## Scope

The scope indicates the nature of the place. The available values are described by the `PlaceScope` constants.

``` php
$scope = $place->getScope();
```

## Price level

The price level of the place, on a scale of 0 to 4. The available values are described by the `PriceLevel` constants.
 
``` php
$priceLevel = $place->getPriceLevel();
```

## Rating

The rating is the place's rating, from 1.0 to 5.0, based on aggregated user reviews.

``` php
$rating = $place->getRating();
```

## Utc offset

The UTC offset is the number of minutes this place’s current timezone is offset from UTC.

``` php
$utcOffset = $place->getUtcOffset();
```

## Vicinity

The vicinity is a simplified address for the place, including the street name, street number, and locality, but not the 
province/state, postal code, or country.

``` php
$vicinity = $place->getVicinity();
```

## Website

The website is the authoritative website for this place, such as a business' homepage.

``` php
$website = $place->getWebsite();
```

## Geometry

The geometry is a set of technical geographic informations about the place.

``` php
$geometry = $place->getGeometry();
```

If you want to learn more about the geometry, you can read its [documentation](/doc/service/base/geometry.md).

## Opening hours

The opening hours informs you about when the place is opened.

``` php
$openingHours = $place->getOpeningHours();
```

If you want to learn more about the opening hours, you can read its 
[documentation](/doc/service/place/base/opening_hours.md).

## Address components

The address components is an array of separate address components used to compose a given address.

``` php
$addressComponents = $place->getAddressComponents();
```

You can also filter address components by type:

``` php
$addressComponents = $place->getAddressComponents('route');
```

If you want to learn more about the address component, you can read this 
[documentation](/doc/service/base/address_component.md).

## Photos

The photos is an array of photo objects, each containing a reference to an image.

``` php
$photos = $place->getPhotos();
```

If you want to learn more about a photo, you can read this [documentation](/doc/service/place/photo.md).

## Alternate place ids

The alternate place ids is an array of zero, one or more alternative place IDs for the place, with a scope related to 
each alternative ID.

``` php
$alternatePlaceIds = $place->getAlternatePlaceIds();
```

If you want to learn more about the alternate place id, you can read this 
[documentation](/doc/service/place/base/alternate_place_id.md).

## Reviews

It contains an array of up to five reviews.

``` php
$reviews = $place->getReviews();
```

If you want to learn more about a review, you can read this [documentation](/doc/service/place/base/review.md).

## Types

The types is an array of feature types describing the given result.

``` php
$types = $place->getTypes();
```

The available types are described by the `PlaceType` constants.

## Permanently close

The permanently close is a boolean flag indicating whether the place has permanently shut down.

``` php
$permenentlyClose = $place->isPermanentlyClose();
```
