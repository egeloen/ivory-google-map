# Geocoder Response

When you have requested your position, the returned object is an `GeocoderResponse`. It wraps a geocoder status and 
results.

## Status

The available status are defined by the `GeocoderStatus` constants.

``` php
$status = $response->getStatus();
```

## Results

A request can return many results. The geocoder response wraps an array of `GeocoderResult`.

``` php
$results = $response->getResults();
```

## Result

Each result wraps the place id, a human readable address, some address & geometry informations, a partial match flag & 
some result types.

``` php
foreach ($reponse->getResults() as $result) {
    // ...
}
```

### Place id

The place id is a unique identifier that can be used with other Google APIs.

``` php
$placeId = $result->getPlaceId();
```

### Human readable address

The method `getFormattedAddress` is a string containing the human-readable address of this location. Often this
address is equivalent to the "postal address," which sometimes differs from country to country. (Note that some
countries, such as the United Kingdom, do not allow distribution of true postal addresses due to licensing
restrictions).

``` php
$formattedAddress = $result->getFormattedAddress();
```

### Address informations

The method `getAddresses` returns an array containing the separate address components. Each address_component
typically contains:

 - types which is an array indicating the type of the address component.
 - long name which is the full text description or name of the address component as returned by the Geocoder.
 - short name which is an abbreviated textual name for the address component, if available. For example, an address
   component for the state of Alaska may have a long_name of "Alaska" and a short_name of "AK" using the 2-letter
   postal abbreviation.

``` php
foreach ($result->getAddresses() as $address) {
    $longName = $address->getLongName();
    $shortName = $address->getShortName();
    $types = $address->getTypes();
}
```

You can also filter the address components by type:

``` php
foreach ($result->getAddresses('route') as $address) {
    // ...
}

If you want to learn more about the address component, you can read this 
[documentation](/doc/service/base/address_component.md).

### Geometry informations

The method `getGeometry` returns a set of technical geographic informations about your geocoding.

``` php
$geometry = $result->getGeometry();
```

If you want to learn more about the gemetry, you can read this [documentation](/doc/service/base/geometry.md).

### Partial match flag

The partial match flag indicates that the geocoder did not return an exact match for the original request, though it
did match part of the requested address. You may wish to examine the original request for misspellings and/or an
incomplete address. Partial matches most often occur for street addresses that do not exist within the locality you
pass in the request.

``` php
$partialMatch = $result->isPartialMatch();
```

### Types

The result types is an array indicates the type of the returned result. This array contains a set of one or more tags
identifying the type of feature returned in the result. For example, a geocode of "Chicago" returns "locality" which
indicates that "Chicago" is a city, and also returns "political" which indicates it is a political entity.

``` php
$types = $result->getTypes();
```
