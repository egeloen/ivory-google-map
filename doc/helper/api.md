# API Rendering

The API rendering only allows you to render the Google API loader and trigger the previously defined maps or place 
autocompletes. So, **the API rendering must always be done after all objects (maps and place autocompletes) have been 
rendered.** This rendering is basically what starts and triggers the rendering of all objects. 

## Build

First of all, if you want to render the API, you will need to build an API helper. So, let's go:

``` php
use Ivory\GoogleMap\Helper\Builder\ApiHelperBuilder;
 
$apiHelperBuilder = ApiHelperBuilder::create();
$apiHelper = $apiHelperBuilder->build();
```

The api helper is built via a builder. The builder allows you to configure the helper json builder, formatter, api key, 
language and subscribers. The json builder allows to build advanced JSON, the formatter allows to format the generated 
code, the api key allows to bypass Google rate limits, the language allows to localize the API (default en) and the 
subscribers allow you to attach additional code to the API.

## Configure language

If you want to update the API language (default en), you can use:

``` php
$apiHelperBuilder->setLanguage('fr');
```

## Configure API key

If you have an API key, you can use:

``` php
$apiHelperBuilder->setKey('api-key');
```

## Configure subscribers

If you want to hook into the API rendering process, you can use: 

``` php
$apiHelperBuilder->addSubscriber(/* ... */);
```

## Configure debug

If you want to more easily debug the generated code, you can use:

``` php
$apiHelperBuilder->getFormatter()->setDebug(true);
$apiHelperBuilder->getFormatter()->setIndentationStep(4);
```

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
