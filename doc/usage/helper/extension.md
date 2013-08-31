# Extension

An extension helper allows you to add/render additional libraries and/or append some javascript code just before/after
the generated one. To understand how it works, you will dig into a simple example.

First, you need to create your own extension:

``` php
namespace My\Own\Helper\Extension;

use Ivory\GoogleMap\Helper\Extension\ExtensionHelperInterface;
use Ivory\GoogleMap\Map;

class MyExtensionHelper implements ExtensionHelperInterface
{
    /**
     * {@inheritdoc}
     */
    public function renderLibraries(Map $map)
    {
        // Here, we can render additional libraries...
        return '<script type="text/javascript" src="//your/own/library.js"></script>'.PHP_EOL;
    }

    /**
     * {@inheritdoc}
     */
    public function renderBefore(Map $map)
    {
        // Here, we can render js code just before the generated one.
        return 'var before = \'before\''.PHP_EOL;
    }

    /**
     * {@inheritdoc}
     */
    public function renderAfter(Map $map)
    {
        // Here, we can render js code just after the generated one.
        return 'var after = \'after\''.PHP_EOL;
    }
}
```

Then, you need to register you extension on the map helper & simply render your map:

``` php
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Helper\MapHelper;
use My\Own\Helper\Extension\MyExtensionHelper;

$mapHelper = new MapHelper();
$mapHelper->setExtensionHelper('my_extension', new MyExtensionHelper());

$map = new Map();

$output = $mapHelper->renderJavascripts($map);
```

The output will be:

``` html
// Google map loading...
<script type="text/javascript" src="//your/own/library.js"></script>
<script type="text/javascript">
var before = 'before';
// Generated code...
var after = 'after';
</script>
```
