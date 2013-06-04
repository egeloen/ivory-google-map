<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Places;

use Ivory\GoogleMap\Helper\Places\AutocompleteHelper;
use Ivory\GoogleMap\Places\Autocomplete;
use Ivory\GoogleMap\Places\AutocompleteType;

/**
 * Autocomplete helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Places\AutocompleteHelper */
    protected $autocompleteHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->autocompleteHelper = new AutocompleteHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->autocompleteHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helper\ApiHelper', $this->autocompleteHelper->getApiHelper());

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Base\CoordinateHelper',
            $this->autocompleteHelper->getCoordinateHelper()
        );

        $this->assertInstanceOf('ivory\GoogleMap\Helper\Base\BoundHelper', $this->autocompleteHelper->getBoundHelper());
    }

    public function testInitialState()
    {
        $apiHelper = $this->getMock('Ivory\GoogleMap\Helper\ApiHelper');
        $coordinateHelper = $this->getMock('Ivory\GoogleMap\Helper\Base\CoordinateHelper');
        $boundHelper = $this->getMock('Ivory\GoogleMap\Helper\Base\BoundHelper');

        $this->autocompleteHelper = new AutocompleteHelper($apiHelper, $coordinateHelper, $boundHelper);

        $this->assertSame($apiHelper, $this->autocompleteHelper->getApiHelper());
        $this->assertSame($coordinateHelper, $this->autocompleteHelper->getCoordinateHelper());
        $this->assertSame($boundHelper, $this->autocompleteHelper->getBoundHelper());
    }

    public function testRenderHtmlContainerWithoutValue()
    {
        $autocomplete = new Autocomplete();

        $this->assertSame(
            '<input type="text" placeholder="off" id="place_input" />'.PHP_EOL,
            $this->autocompleteHelper->renderHtmlContainer($autocomplete)
        );
    }

    public function testRenderHtmlContainerWithValue()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->setValue('foo');

        $this->assertSame(
            '<input type="text" placeholder="off" id="place_input" value="foo" />'.PHP_EOL,
            $this->autocompleteHelper->renderHtmlContainer($autocomplete)
        );
    }

    public function testRenderHtmlContainerWithoutCustomInputAttributes()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->setInputAttribute('class', 'foo');

        $this->assertSame(
            '<input type="text" placeholder="off" class="foo" id="place_input" />'.PHP_EOL,
            $this->autocompleteHelper->renderHtmlContainer($autocomplete)
        );
    }

    public function testRenderAutocomplete()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->setJavascriptVariable('autocomplete');

        $expected = <<<EOF
autocomplete = new google.maps.places.Autocomplete(document.getElementById('place_input', {}));

EOF;

        $this->assertSame($expected, $this->autocompleteHelper->renderAutocomplete($autocomplete));
    }

    public function testRenderAutocompleteWithTypes()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->setJavascriptVariable('autocomplete');
        $autocomplete->setTypes(array(AutocompleteType::ESTABLISHMENT, AutocompleteType::CITIES));

        $expected = <<<EOF
autocomplete = new google.maps.places.Autocomplete(document.getElementById('place_input', {"types":["establishment","(cities)"]}));

EOF;

        $this->assertSame($expected, $this->autocompleteHelper->renderAutocomplete($autocomplete));
    }

    public function testRenderAutocompleteWithBound()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->setJavascriptVariable('autocomplete');

        $autocomplete->setBound(1, 2, 3, 4);
        $autocomplete->getBound()->setJavascriptVariable('bound');

        $expected = <<<EOF
autocomplete = new google.maps.places.Autocomplete(document.getElementById('place_input', {"bounds": bound}));

EOF;

        $this->assertSame($expected, $this->autocompleteHelper->renderAutocomplete($autocomplete));
    }

    public function testRenderAutocompleteWithTypesAndBound()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->setJavascriptVariable('autocomplete');

        $autocomplete->setTypes(array(AutocompleteType::ESTABLISHMENT, AutocompleteType::CITIES));

        $autocomplete->setBound(1, 2, 3, 4);
        $autocomplete->getBound()->setJavascriptVariable('bound');

        $expected = <<<EOF
autocomplete = new google.maps.places.Autocomplete(document.getElementById('place_input', {"types":["establishment","(cities)"], "bounds": bound}));

EOF;

        $this->assertSame($expected, $this->autocompleteHelper->renderAutocomplete($autocomplete));
    }

    public function testRenderJavascriptsWithOneAutocomplete()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->setJavascriptVariable('autocomplete');

        $expected = <<<EOF
<script type="text/javascript">
function load_ivory_google_map_api () { google.load("maps", "3", {"language":"en","other_params":"libraries=places&sensor=false"}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_ivory_google_map_api"></script>
<script type="text/javascript">
autocomplete = new google.maps.places.Autocomplete(document.getElementById('place_input', {}));
</script>

EOF;

        $this->assertSame($expected, $this->autocompleteHelper->renderJavascripts($autocomplete));
    }

    public function testRenderJavascriptsWithMultipleAutocompletes()
    {
        $autocomplete1 = new Autocomplete();
        $autocomplete1->setJavascriptVariable('autocomplete1');

        $autocomplete2 = new Autocomplete();
        $autocomplete2->setJavascriptVariable('autocomplete2');

        $expected1 = <<<EOF
<script type="text/javascript">
function load_ivory_google_map_api () { google.load("maps", "3", {"language":"en","other_params":"libraries=places&sensor=false"}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_ivory_google_map_api"></script>
<script type="text/javascript">
autocomplete1 = new google.maps.places.Autocomplete(document.getElementById('place_input', {}));
</script>

EOF;

        $expected2 = <<<EOF
<script type="text/javascript">
autocomplete2 = new google.maps.places.Autocomplete(document.getElementById('place_input', {}));
</script>

EOF;

        $this->assertSame($expected1, $this->autocompleteHelper->renderJavascripts($autocomplete1));
        $this->assertSame($expected2, $this->autocompleteHelper->renderJavascripts($autocomplete2));
    }

    public function testRenderJavascriptsWithBound()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->setJavascriptVariable('autocomplete');

        $autocomplete->setBound(1, 2, 3, 4, true, false);
        $autocomplete->getBound()->setJavascriptVariable('bound');
        $autocomplete->getBound()->getSouthWest()->setJavascriptVariable('bound_south_west');
        $autocomplete->getBound()->getNorthEast()->setJavascriptVariable('bound_north_east');

        $expected = <<<EOF
<script type="text/javascript">
function load_ivory_google_map_api () { google.load("maps", "3", {"language":"en","other_params":"libraries=places&sensor=false"}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_ivory_google_map_api"></script>
<script type="text/javascript">
bound_south_west = new google.maps.LatLng(1, 2, true);
bound_north_east = new google.maps.LatLng(3, 4, false);
bound = new google.maps.LatLngBounds(bound_south_west, bound_north_east);
autocomplete = new google.maps.places.Autocomplete(document.getElementById('place_input', {"bounds": bound}));
</script>

EOF;

        $this->assertSame($expected, $this->autocompleteHelper->renderJavascripts($autocomplete));
    }

    public function testRenderJavascriptsWithAsync()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->setJavascriptVariable('autocomplete');
        $autocomplete->setAsync(true);

        $expected = <<<EOF
<script type="text/javascript">
function load_ivory_google_place () {
autocomplete = new google.maps.places.Autocomplete(document.getElementById('place_input', {}));
}
</script>
<script type="text/javascript">
function load_ivory_google_map_api () { google.load("maps", "3", {"language":"en","other_params":"libraries=places&sensor=false", "callback": load_ivory_google_place}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_ivory_google_map_api"></script>

EOF;

        $this->assertSame($expected, $this->autocompleteHelper->renderJavascripts($autocomplete));
    }

    /**
     * @expectedException Ivory\GoogleMap\Exception\HelperException
     * @expectedExceptionMessage The place autocomplete bound must have coordinates.
     */
    public function testRenderJavascriptsWithInvalidBound()
    {
        $autocomplete = new Autocomplete();

        $autocomplete->setBound(1, 2, 3, 4);
        $autocomplete->getBound()->setSouthWest(null);
        $autocomplete->getBound()->setNorthEast(null);

        $this->autocompleteHelper->renderJavascripts($autocomplete);
    }
}
