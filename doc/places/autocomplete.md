# Autocomplete

The Places Autocomplete feature attaches to a text field on your web page, and monitors that field for character
entries. As text is entered, Autocomplete returns Place predictions to the application in the form of a drop-down pick
list. You can use the Places Autocomplete feature to help users find a specific location, or assist them with filling
out address fields in online forms.

## Create your autocomplete

``` php
use Ivory\GoogleMap\Places\Autocomplete;

$autocomplete = new Autocomplete();
```

## Configure your autocomplete

### Configure the variable

``` php
$autocomplete->setVariable('place_autocomplete');
```

### Configure the input id

``` php
$autocomplete->setInputId('place_input');
```

### Configure the input attributes

``` php
$autocomplete->setInputAttribute('class', 'my-class');
```

### Configure the value

``` php
$autocomplete->setValue('foo');
```

### Configure the types

``` php
use Ivory\GoogleMap\Places\AutocompleteType;

$autocomplete->addType(AutocompleteType::ESTABLISHMENT);
```

### Configure the component restrictions

``` php
use Ivory\GoogleMap\Places\AutocompleteComponentRestriction;

$autocomplete->setComponentRestriction(AutocompleteComponentRestriction::COUNTRY, 'fr');
```

### Configure the bound

``` php
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;

$autocomplete->setBound(new Bound(new Coordinate(-2.1, -3.9), new Coordinate(2.6, 1.4)));
```

### Configure the language

``` php
$autocomplete->setLanguage('en');
```

## Render your autocomplete

Now, you have builded and configured your map, you can render it. The map rendering documentation is available
[here](/doc/helpers/rendering.md).

Example:

``` php
use Ivory\GoogleMap\Helpers\Factories\HelperFactory;
use Ivory\GoogleMap\Places\Autocomplete;

$autocomplete = new Autocomplete();

$helperFactory = new HelperFactory();

$autocompleteHelper = $helperFactory->createPlacesAutocompleteHelper();
$apiHelper = $helperFactory->createApiHelper();

echo $autocompleteHelper->render($autocomplete);
echo $apiHelper->render(array($autocomplete));
```
