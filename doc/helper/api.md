# API Rendering

The API rendering only allows you to render the Google API loader and trigger the previously defined maps or place 
autocompletes. So, **the API rendering must always be done after all objects (maps and place autocompletes) have been 
rendered.** This rendering is basically what starts and triggers the rendering of all objects. 

## Build

First of all, if you want to render the API, you will need to build an API helper. So, let's go:

``` php
use Ivory\GoogleMap\Helper\Builder\ApiHelperBuilder;
 
$apiHelper = ApiHelperBuilder::create()->build();
```

The api helper is built via a builder. The builder allows you to configure the helper json builder, formatter and 
subscribers. The json builder allows to build advanced JSON, the formatter allows to format the generated code and the 
subscribers allow you to attach additional code to the API.

``` php
use Ivory\GoogleMap\Helper\Builder\ApiHelperBuilder;
 
$apiHelperBuilder = ApiHelperBuilder::create();

$apiHelperBuilder->getFormatter()->setDebug(true);
$apiHelperBuilder->getFormatter()->setIndentationStep(4);
$apiHelperBuilder->getFormatter()->setDefaultIndentation(0);

$apiHelperBuilder->addSubscriber(/* ... */);

$apiHelper = $apiHelperBuilder->build();
```

Here, I configure the formatter in debug mode (meaning that the code will be nicely formatted) with an indentation of 
four spaces and a default/initial indentation of zero. I additionally attach a custom subscriber which will allow to 
hook into the code generation.

## Render

For rendering the API, you need javascript code. To render it, you can use:

```
echo $apiHelper->render([$object1, $object2]);
```

Here, `$object1` and `$object2` can refer to maps or place autocompletes. The, this method renders an html javascript 
block with all code needed for loading the API.

``` html
<script type="text/javascript">
    // Code needed for loading the API
</script>
```
