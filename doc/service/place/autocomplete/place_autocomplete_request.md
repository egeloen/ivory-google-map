# Place Autocomplete Request

Depending on what you want to process, you need to choose the appropriate request. The library allows you to process 
an autocomplete or a query request.

## Autocomplete request

An autocomplete request allows you to find place predictions based on user input:

``` php
use Ivory\GoogleMap\Service\Place\Autocomplete\Request\PlaceAutocompleteRequest;

$request = new PlaceAutocompleteRequest('Sydney');
$response = $autocomplete->process($request);
```

If you want to learn more about it, you can read its 
[documentation](/doc/service/place/autocomplete/place_autocomplete_default_request.md).

## Autocomplete Query request

An autocomplete query request allows you to find query predictions based on user input:

``` php
use Ivory\GoogleMap\Service\Place\Autocomplete\Request\PlaceAutocompleteQueryRequest;

$request = new PlaceAutocompleteQueryRequest('Pizza near Par');
$response = $autocomplete->process($request);
```

If you want to learn more about it, you can read its 
[documentation](/doc/service/place/autocomplete/place_autocomplete_query_request.md).
