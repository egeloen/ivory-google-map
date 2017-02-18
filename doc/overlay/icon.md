# Icon

Markers may define an icon to show in place of the default icon. Defining an icon involves setting a number of 
properties that define the visual behavior of the marker.

## Build

First of all, if you want to render an icon, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Overlay\Icon;

$icon = new Icon();
```

The icon constructor does not require anything but It accepts parameters such as the url
(default https://maps.gstatic.com/mapfiles/markers/marker.png), anchor (default null), origin (default null),
scaled size (default null) and size (default null):

``` php
use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Overlay\Icon;

$icon = new Icon(
    Icon::DEFAULT_URL,
    new Point(20, 34),
    new Point(0, 0),
    new Size(20, 34),
    new Size(40, 68)
);
```

## Configure variable

A variable is automatically generated when creating an icon but if you want to update it, you can use:

``` php
$icon->setVariable('icon');
```

## Configure url

If you want to update thr url, you can use:

``` php
$icon->setUrl('https://maps.gstatic.com/mapfiles/markers/marker.png');
```

## Configure anchor

If you want to update the anchor, you can use:

``` php
use Ivory\GoogleMap\Base\Point;

$icon->setAnchor(new Point(20, 34));
```

## Configure origin

If you want to update the origin, you can use:

``` php
use Ivory\GoogleMap\Base\Point;

$icon->setOrigin(new Point(0, 0));
```

## Configure size

If you want to update the size, you can use:

``` php
use Ivory\GoogleMap\Base\Size;

$icon->setSize(new Size(20, 34));
```

## Configure scaled size

If you want to update the scaled size, you can use:

``` php
use Ivory\GoogleMap\Base\Size;

$icon->setScaledSize(new Size(20, 34));
```
