# Place Add Request

A place add request contains all the information about a place to send it to Google Maps database.


## Build

First of all, if you want to send a place, you will need to build a place add request. So let's go:

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Place\Base\PlaceType;
use Ivory\GoogleMap\Service\Place\Add\Request\PlaceAddRequest;

$response = $place->process(new PlaceAddRequest(
    new Coordinate(-33.8669710, 151.1958750),
    'Google Shoes!',
    PlaceType::SHOE_STORE
);
```

The place add request constructor requires the location of the place, a name and a type of place.

## Configure location

You can change the location of the place added in constructor sending the coordinates using the Coordinate class.

``` php
$request->setLocation(new Coordinate(-33.8669710, 151.1958750)));
```

## Configure name

Change the name sending in constructor. This field have a limitation to 255 characters by a Google Maps restriction.

``` php
$request->setLocation('Google Shoes!');
```

## Configure type

To change the type sending in constructor you can use the PlaceType class constants.

``` php
$request->setType(PlaceType::SHOE_STORE);
```

## Configure accuracy

The accuracy of the location in metres

``` php
$request->setAccuracy(50);
```

## Configure address

The full address of the place it's recommended if you want to pass the moderation process for inclusion in the Google
Maps database.

``` php
$request->setAddress('48 Pirrama Road, Pyrmont, NSW 2009, Australia');
```

## Configure language

If you want to configure the language:

``` php
$request->setLanguage('fr');
```

## Configure phone number

Like address it's recommended to pass the moderation process

``` php
$request->setPhoneNumber('(02) 9374 4000');
```

## Configure website

Like address and phone number it's recommended to pass the moderation process

``` php
$request->setWebsite('http://www.google.com.au/');
```

##Google Maps docs
This library contains all behaviours to add a place, but if you need extra information can check official documentation
to [Add a place](https://developers.google.com/places/web-service/add-place) in the Google Maps API site
