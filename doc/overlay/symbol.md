# Symbol

A symbol is a vector-based image that can be displayed on a marker or a polyline.

## Build

First of all, if you want to render a symbol, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Overlay\Symbol;
use Ivory\GoogleMap\Overlay\SymbolPath;

$symbol = new Symbol(SymbolPath::CIRCLE);
```

The symbol constructor requires a path as first argument. It also accepts additional parameters such as anchor (default 
null), label origin (default null) and options (default empty):

``` php
use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Overlay\Symbol;
use Ivory\GoogleMap\Overlay\SymbolPath;

$symbol = new Symbol(
    SymbolPath::CIRCLE,
    new Point(20, 34),
    new Point(0, 0),
    ['scale' => 10]
);
```

## Configure variable

A variable is automatically generated when creating a symbol but if you want to update it, you can use:

``` php
$symbol->setVariable('symbol');
```

## Configure anchor

If you want to update the anchor, you can use:

``` php
use Ivory\GoogleMap\Base\Point;

$symbol->setAnchor(new Point(12, 32));
```

## Configure label origin

If you want to update the label origin, you can use:

``` php
use Ivory\GoogleMap\Base\Point;

$symbol->setLabelOrigin(new Point(12, 32));
```

## Configure options

The symbol options allows you to configure additional symbol aspects. See the list of available options in the 
official [documentation](https://developers.google.com/maps/documentation/javascript/reference#Symbol). 
Then, to configure them, you can use:

``` php
$symbol->setOption('scale', 10);
```
