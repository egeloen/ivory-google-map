<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Places;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Places\AutocompleteComponentRestriction;
use Ivory\GoogleMap\Places\AutocompleteType;
use Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Autocomplete renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteRenderer */
    private $autocompleteRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->autocompleteRenderer = new AutocompleteRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->autocompleteRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->autocompleteRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender(
        $expected,
        array $types = array(),
        Bound $bound = null,
        array $componentRestrictions = array()
    ) {
        $this->assertSame(
            $expected,
            $this->autocompleteRenderer->render($this->createAutocompleteMock($types, $bound, $componentRestrictions))
        );
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        return array(
            array('new google.maps.places.Autocomplete(document.getElementById(\'input_id\'),{})'),
            array(
                'new google.maps.places.Autocomplete(document.getElementById(\'input_id\'),{"types":["(regions)"]})',
                array(AutocompleteType::REGIONS),
            ),
            array(
                'new google.maps.places.Autocomplete(document.getElementById(\'input_id\'),{"bounds":bound})',
                array(),
                $this->createBoundMock(),
            ),
            array(
                'new google.maps.places.Autocomplete(document.getElementById(\'input_id\'),{"componentRestrictions":["country"]})',
                array(),
                null,
                array(AutocompleteComponentRestriction::COUNTRY),
            ),
            array(
                'new google.maps.places.Autocomplete(document.getElementById(\'input_id\'),{"types":["(regions)"],"bounds":bound,"componentRestrictions":["country"]})',
                array(AutocompleteType::REGIONS),
                $this->createBoundMock(),
                array(AutocompleteComponentRestriction::COUNTRY),
            ),
        );
    }

    /**
     * Creates an autocomplete mock.
     *
     * @param array                            $types                 The types.
     * @param \Ivory\GoogleMap\Base\Bound|null $bound                 The bound.
     * @param array                            $componentRestrictions The component restrictions.
     *
     * @return \Ivory\GoogleMap\Places\Autocomplete|\PHPUnit_Framework_MockObject_MockObject The autocomplete mock.
     */
    protected function createAutocompleteMock(
        array $types = array(),
        Bound $bound = null,
        array $componentRestrictions = array()
    ) {
        $autocomplete = parent::createAutocompleteMock();
        $autocomplete
            ->expects($this->any())
            ->method('getInputId')
            ->will($this->returnValue('input_id'));

        $autocomplete
            ->expects($this->any())
            ->method('hasTypes')
            ->will($this->returnValue(!empty($types)));

        $autocomplete
            ->expects($this->any())
            ->method('getTypes')
            ->will($this->returnValue($types));

        $autocomplete
            ->expects($this->any())
            ->method('hasBound')
            ->will($this->returnValue($bound !== null));

        $autocomplete
            ->expects($this->any())
            ->method('getBound')
            ->will($this->returnValue($bound));

        $autocomplete
            ->expects($this->any())
            ->method('hasComponentRestrictions')
            ->will($this->returnValue(!empty($componentRestrictions)));

        $autocomplete
            ->expects($this->any())
            ->method('getComponentRestrictions')
            ->will($this->returnValue($componentRestrictions));

        return $autocomplete;
    }

    /**
     * {@inheritdoc}
     */
    protected function createBoundMock()
    {
        $bound = parent::createBoundMock();
        $bound
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('bound'));

        return $bound;
    }
}
