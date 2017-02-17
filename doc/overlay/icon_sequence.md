# Icon Sequence

An icon sequence can only be used with a polyline and allow you to customize it with symbols.

## Build

First of all, if you want to render an icon sequence, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Overlay\IconSequence;
use Ivory\GoogleMap\Overlay\Symbol;
use Ivory\GoogleMap\Overlay\SymbolPath;

$iconSequence = new IconSequence([
    new Symbol(SymbolPath::FORWARD_OPEN_ARROW)
]);
```

The icon constructor requires an array of symbols as first arguments. It also accepts an additional parameter which is 
options (default empty):

``` php
use Ivory\GoogleMap\Overlay\IconSequence;
use Ivory\GoogleMap\Overlay\Symbol;
use Ivory\GoogleMap\Overlay\SymbolPath;

$iconSequence = new IconSequence(
    [new Symbol(SymbolPath::FORWARD_OPEN_ARROW)], 
    ['offset' => '100%']
);
```

## Configure variable

A variable is automatically generated when creating an icon sequence but if you want to update it, you can use:

``` php
$iconSequence->setVariable('icon_sequence');
```

## Configure symbols

If you want to update symbols, you can use:

``` php
use Ivory\GoogleMap\Overlay\Symbol;
use Ivory\GoogleMap\Overlay\SymbolPath;

$iconSequence->setSymbols([
    new Symbol(SymbolPath::FORWARD_OPEN_ARROW)
]);
```

If you want to learn more about symbol, you can read its [documentation](/doc/overlay/symbol.md).

## Configure options

The icon sequence options allows you to configure additional icon sequence aspects. See the list of available options 
in the official [documentation](https://developers.google.com/maps/documentation/javascript/reference#IconSequence). 
Then, to configure them, you can use:

``` php
$iconSequence->setOption('offset', '100%');
```
