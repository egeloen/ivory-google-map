# Autocomplete

The Places Autocomplete feature attaches to a text field on your web page, and monitors that field for character
entries. As text is entered, Autocomplete returns Place predictions to the application in the form of a drop-down pick
list. You can use the Places Autocomplete feature to help users find a specific location, or assist them with filling
out address fields in online forms.

## Build your autocomplete

In order to use the Google Autocomplete feature, you need to build & configure it.

``` php
use Ivory\GoogleMap\Places\Autocomplete;
use Ivory\GoogleMap\Places\AutocompleteType;

$autocomplete = new Autocomplete();

$autocomplete->setPrefixJavascriptVariable('place_autocomplete_');
$autocomplete->setInputId('place_input');

$autocomplete->setInputAttributes(array('class' => 'my-class'));
$autocomplete->setInputAttribute('class', 'my-class');

$autocomplete->setValue('foo');

$autocomplete->setTypes(array(AutocompleteType::ESTABLISHMENT));
$autocomplete->setBound(-2.1, -3.9, 2.6, 1.4, true, true);

$autocomplete->setAsync(false);
$autocomplete->setLanguage('en');
```

## Render your autocomplete

Now, you have builded & configured your autocomplete, you can render it. For this purpose, you will need the
`Ivory\GoogleMap\Helper\Places\AutocompleteHelper` which allows to render the autocomplete html container & some
javascript for being able to render it.

``` php
use Ivory\GoogleMap\Helper\Places\AutocompleteHelper;

$autocompleteHelper = new AutocompleteHelper();
```

### Render the HTML container

```
echo $autocompleteHelper->renderHtmlContainer($autocomplete);
```

This function renders an html input with the ID, the value & the html attributes:

``` html
<input id="place_autocomplete" type="text" placeholder="off" value="foo" />
```

### Render the javascript

```
echo $autocompleteHelper->renderJavascripts($autocomplete);
```

This function renders an html javascript block with all code needed for displaying your autocomplete.

``` html
<script type="text/javascript">
    // Code needed for displaying your autocomplete
</script>
```
