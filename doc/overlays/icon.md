# Icon

Markers may define an icon to show in place of the default icon or a shadow to shown in place of the default shadow.
Defining an icon or a shadow involves setting a number of properties that define the visual behavior of the marker.

## Build your icon

``` php
use Ivory\GoogleMap\Overlays\Icon;

$icon = new Icon('url');
```

## Configure your icon

### Configure the variable

``` php
$icon->setVariable('icon');
```

### Configure the url

``` php
$icon->setUrl('url');
```

### Configure the anchor

``` php
use Ivory\GoogleMap\Base\Point;

$icon->setAnchor(new Point(20, 34));
```

### Configure the origin

``` php
use Ivory\GoogleMap\Base\Point;

$icon->setOrigin(new Point(0, 0));
```

### Configure the size

``` php
use Ivory\GoogleMap\Base\Size;

$icon->setSize(new Size(20, 34, 'px', 'px'));
```

### Configure the scaled size

``` php
use Ivory\GoogleMap\Base\Size;

$icon->setScaledSize(new Size(20, 34, 'px', 'px'));
```
