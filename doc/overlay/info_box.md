# InfoBox

The library natively supports [InfoBox](https://github.com/kangaroo5383/google-maps-utility-library-v3/tree/master/infobox) 
(a info window-like implementation). In order to render an info box instead of an info window, you just need to 
specify it on the info window:
 
``` php
use Ivory\GoogleMap\Overlay\InfoWindow;
use Ivory\GoogleMap\Overlay\InfoWindowType;

$infoWindow = new InfoWindow('content');
$infoWindow->setType(InfoWindowType::INFO_BOX);
```

Then, add it to your map and you're done!
