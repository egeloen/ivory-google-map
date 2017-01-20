# Place Autocomplete Rendering

The place autocomplete rendering only allows you to render a place autocomplete. The javascript place autocomplete 
code will be wrapped into a unique named function.

## Build

First of all, if you want to render a place autocomplete, you will need to build a place autocomplete helper. So, let's 
go:

``` php
use Ivory\GoogleMap\Helper\Builder\PlaceAutocompleteHelperBuilder;

$placeAutocompleteHelperBuilder = PlaceAutocompleteHelperBuilder::create();
$placeAutocompleteHelper = $placeAutocompleteHelperBuilder->build();
```

The place autocomplete helper is built via a builder. The builder allows you to configure the helper json builder, 
formatter and subscribers. The json builder allows to build advanced JSON, the formatter allows to format the generated 
code and the subscribers allow you to attach additional code to the place autocomplete.

## Configure subscribers

If you want to hook into the map rendering process, you can use: 

``` php
$placeAutocompleteHelperBuilder->addSubscriber(/* ... */);
```

## Configure debug

If you want to more easily debug the generated code, you can use:

``` php
$placeAutocompleteHelperBuilder->getFormatter()->setDebug(true);
$placeAutocompleteHelperBuilder->getFormatter()->setIndentationStep(4);
```

## Render html input

```
echo $placeAutocompleteHelper->renderHtml($autocomplete);
```

This methods renders an html input with the input id, the value and input attributes configured:

``` html
<input id="place_autocomplete" type="text" autocomplete="off" value="foo" />
```

## Render javascript

```
echo $placeAutocompleteHelper->renderJavascript($autocomplete);
```

This methods renders an html javascript block with all code needed for displaying your autocomplete.

``` html
<script type="text/javascript">
    // Code needed for displaying your autocomplete
</script>
```

### Use objects on client side

Being able to reuse objects on the client side is a must have. Hopefully, the library supports it natively. Basically, 
all objects implementing the `VariableAwareInterface` have a javascript variable. When rendering you code, the helper 
will attach the object to its variable. Given you have a place autocomplete which uses `my_autocomplete` as variable, 
then the generated code is: 
  
``` js
my_autocomplete = new google.maps.places.Autocomplete({ /* ... */ });
```
 
Then, you can access the autocomplete everywhere in your code by relying on `my_autocomplete`:

``` js
var place = my_autocomplete.getPlace();
```

The helper also organizes all objects under a container. That allows you to easily retrieve everything linked to a 
specific place autocomplete. Given you have a place autocomplete which uses `my_autocomplete` as variable. Then, the 
generated container is:

``` json
my_autocomplete_container = {
    "base": {
        "coordinates": [],
        "bounds": []
    },
    "autocomplete": null
}
```

With the container, you can easily iterate over any collections int the map. For example, iterating over makers is as 
simple as:

```  js
for (var coordinate in my_autocomplete.base.coordinates) {
    // ...
}
```

## Render all

If you want to render everything (html input + javascript), you can use:

```
echo $placeAutocompleteHelper->render($autocomplete);
```

This methods renders all:

``` html
<input id="place_autocomplete" type="text" autocomplete="off" value="foo" />
<script type="text/javascript">
    // Code needed for displaying your autocomplete
</script>
```

## What Next?

Since the place autocomplete rendering is the first step in the rendering process, you should be interested into 
rendering the [API](/doc/helper/api.md).
