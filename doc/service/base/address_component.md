# Address Component

An address component represents a part of an address.

## Long name

The long name is the full text description or name of the address component.

``` php
$longName = $addressComponent->getLongName();
```

## Short name

The short name is an abbreviated textual name for the address component, if available.

``` php
$shortName = $addressComponent->getShortName();
```

## Types

The types is an array indicating the type of the address component.

``` php
$types = $addressComponent->getTypes();
```
