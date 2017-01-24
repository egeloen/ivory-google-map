# Place Autocomplete Response

When you have requested your place autocomplete, the returned object is a `PlaceAutocompleteResponse`. It wraps a 
place autocomplete status and predictions.

## Status

The available status are defined by the `PlaceAutocompleteStatus` constants.

``` php
$status = $response->getStatus();
```

## Predictions

A request can return many predictions. The place autocomplete response wraps an array of `PlaceAutocompletePrediction`.

``` php
$predictions  = $response->getPredictions();
```

## Prediction

A prediction is a place matching your request criteria. Each prediction wraps a place id, a description, types, terms 
and matches.

``` php
foreach ($reponse->getPredictions() as $prediction) {
    // ...
}
```

### Place id

The place id is a unique identifier that can be used with other Google APIs.

``` php
$placeId = $prediction->getPlaceId();
```

### Description

The description is a human-readable name for the place.

``` php
$description = $prediction->getDescription();
```

### Types

The result types is an array indicates the type of the place. This array contains a set of one or more tags
identifying the type of feature returned in the result. For example, a geocode of "Chicago" returns "locality" which
indicates that "Chicago" is a city, and also returns "political" which indicates it is a political entity.

``` php
$types = $prediction->getTypes();
```

### Terms

The terms is an array of terms identifying each section of the returned description (a section of the description is 
generally terminated with a comma). Each entry in the array has a value field, containing the text of the term, and an 
offset field, defining the start position of this term in the description, measured in Unicode characters.

``` php
foreach ($result->getTerms() as $term) {
    $value = $term->getValue();
    $offset = $term->getOffset();
}
```

### Matches

The matches is an array with offset value and length. These describe the location of the entered term in the 
prediction result text, so that the term can be highlighted if desired.

``` php
foreach ($result->getMatches() as $match) {
    $length = $match->getLength();
    $offset = $match->getOffset();
}
```
