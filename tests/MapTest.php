<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap;

use Ivory\GoogleMap\Map;

/**
 * Map test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Map */
    private $map;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->map = new Map();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->map);
    }

    public function testInheritance()
    {
        $this->assertVariableAssetInstance($this->map);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('map_', $this->map->getVariable());
        $this->assertSame($this->map->getVariable(), $this->map->getHtmlContainerId());

        $this->assertCoordinateInstance($this->map->getCenter());
        $this->assertSame($this->map->getCenter()->getLatitude(), 0);
        $this->assertSame($this->map->getCenter()->getLongitude(), 0);

        $this->assertBoundInstance($this->map->getBound());

        $this->assertControlsInstance($this->map->getControls());
        $this->assertEventsInstance($this->map->getEvents());
        $this->assertLayersInstance($this->map->getLayers());
        $this->assertOverlaysInstance($this->map->getOverlays());

        $this->assertNoMapOptions();
        $this->assertNoStylesheetOptions();
        $this->assertSame('en', $this->map->getLanguage());
        $this->assertNoLibraries();
    }

    public function testSetHtmlContainerId()
    {
        $this->map->setHtmlContainerId($htmlContainerId = 'foo');

        $this->assertSame($htmlContainerId, $this->map->getHtmlContainerId());
    }

    public function testSetCenter()
    {
        $this->map->setCenter($center = $this->createCoordinateMock());

        $this->assertCenter($center);
    }

    public function testSetBound()
    {
        $this->map->setBound($bound = $this->createBoundMock());

        $this->assertBound($bound);
    }

    public function testSetControls()
    {
        $this->map->setControls($controls = $this->createControlsMock());

        $this->assertSame($controls, $this->map->getControls());
    }

    public function testSetEvents()
    {
        $this->map->setEvents($events = $this->createEventsMock());

        $this->assertSame($events, $this->map->getEvents());
    }

    public function testSetLayers()
    {
        $this->map->setLayers($layers = $this->createLayersMock());

        $this->assertSame($layers, $this->map->getLayers());
    }

    public function testSetOverlays()
    {
        $this->map->setOverlays($overlays = $this->createOverlaysMock());

        $this->assertSame($overlays, $this->map->getOverlays());
    }

    public function testSetMapOptions()
    {
        $this->map->setMapOptions($mapOptions = array('foo' => 'bar'));

        $this->assertMapOptions($mapOptions);
    }

    public function testAddMapOptions()
    {
        $this->map->setMapOptions($mapOptions = array('foo' => 'bar'));
        $this->map->addMapOptions($newMapOptions = array('baz' => 'bat'));

        $this->assertMapOptions(array_merge($mapOptions, $newMapOptions));
    }

    public function testRemoveMapOptions()
    {
        $this->map->setMapOptions($mapOptions = array('foo' => 'bar'));
        $this->map->removeMapOptions(array_keys($mapOptions));

        $this->assertNoMapOptions();
    }

    public function testResetMapOptions()
    {
        $this->map->setMapOptions(array('foo' => 'bar'));
        $this->map->resetMapOptions();

        $this->assertNoMapOptions();
    }

    public function testSetMapOption()
    {
        $this->map->setMapOption($name = 'foo', $value = 'bar');

        $this->assertMapOption($name, $value);
    }

    public function testRemoveMapOption()
    {
        $this->map->setMapOption($name = 'foo', 'bar');
        $this->map->removeMapOption($name);

        $this->assertNoMapOption($name);
    }

    public function testSetStylesheetOptions()
    {
        $this->map->setStylesheetOptions($stylesheetOptions = array('foo' => 'bar'));

        $this->assertStylesheetOptions($stylesheetOptions);
    }

    public function testAddStylesheetOptions()
    {
        $this->map->setStylesheetOptions($stylesheetOptions = array('foo' => 'bar'));
        $this->map->addStylesheetOptions($newStylesheetOptions = array('baz' => 'bat'));

        $this->assertStylesheetOptions(
            array_merge($stylesheetOptions, $newStylesheetOptions)
        );
    }

    public function testRemoveStylesheetOptions()
    {
        $this->map->setStylesheetOptions($stylesheetOptions = array('foo' => 'bar'));
        $this->map->removeStylesheetOptions(array_keys($stylesheetOptions));

        $this->assertNoStylesheetOptions();
    }

    public function testResetStylesheetOptions()
    {
        $this->map->setStylesheetOptions(array('foo' => 'bar'));
        $this->map->resetStylesheetOptions();

        $this->assertNoStylesheetOptions();
    }

    public function testSetStylesheetOption()
    {
        $this->map->setStylesheetOption($name = 'foo', $value = 'bar');

        $this->assertStylesheetOption($name, $value);
    }

    public function testRemoveStylesheetOption()
    {
        $this->map->setStylesheetOption($name = 'foo', 'bar');
        $this->map->removeStylesheetOption($name);

        $this->assertNoStylesheetOption($name);
    }

    public function testSetLanguage()
    {
        $this->map->setLanguage($language = 'fr');

        $this->assertSame($language, $this->map->getLanguage());
    }

    public function testSetLibraries()
    {
        $this->map->setLibraries($libraries = array('foo'));

        $this->assertLibraries($libraries);
    }

    public function testAddLibraries()
    {
        $this->map->setLibraries($libraries = array('foo'));
        $this->map->addLibraries($newLibraries = array('bar'));

        $this->assertLibraries(array_merge($libraries, $newLibraries));
    }

    public function testRemoveLibraries()
    {
        $this->map->setLibraries($libraries = array('foo'));
        $this->map->removeLibraries($libraries);

        $this->assertNoLibraries();
    }

    public function testResetLibraries()
    {
        $this->map->setLibraries(array('foo'));
        $this->map->resetLibraries();

        $this->assertNoLibraries();
    }

    public function testAddLibrary()
    {
        $this->map->addLibrary($library = 'foo');

        $this->assertLibrary($library);
    }

    public function testRemoveLibrary()
    {
        $this->map->addLibrary($library = 'foo');
        $this->map->removeLibrary($library);

        $this->assertNoLibrary($library);
    }

    /**
     * Asserts there is a center.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $center The center.
     */
    private function assertCenter($center)
    {
        $this->assertCoordinateInstance($center);

        $this->assertSame($center, $this->map->getCenter());
    }

    /**
     * Asserts there is a bound.
     *
     * @param \Ivory\GoogleMap\Base\Bound $bound The bound.
     */
    private function assertBound($bound)
    {
        $this->assertBoundInstance($bound);
        $this->assertSame($bound, $this->map->getBound());
    }

    /**
     * Asserts there are map options.
     *
     * @param array $mapOptions The map options.
     */
    private function assertMapOptions($mapOptions)
    {
        $this->assertInternalType('array', $mapOptions);

        $this->assertTrue($this->map->hasMapOptions());
        $this->assertSame($mapOptions, $this->map->getMapOptions());

        foreach ($mapOptions as $name => $value) {
            $this->assertMapOption($name, $value);
        }
    }

    /**
     * Asserts there is a map option.
     *
     * @param string $name  The map option name.
     * @param mixed  $value The map option value.
     */
    private function assertMapOption($name, $value)
    {
        $this->assertTrue($this->map->hasMapOption($name));
        $this->assertSame($value, $this->map->getMapOption($name));
    }

    /**
     * Asserts there are stylesheet options.
     *
     * @param array $stylesheetOptions The stylesheet options.
     */
    private function assertStylesheetOptions($stylesheetOptions)
    {
        $this->assertInternalType('array', $stylesheetOptions);

        $this->assertTrue($this->map->hasStylesheetOptions());
        $this->assertSame($stylesheetOptions, $this->map->getStylesheetOptions());

        foreach ($stylesheetOptions as $name => $value) {
            $this->assertStylesheetOption($name, $value);
        }
    }

    /**
     * Asserts there is a stylesheet option.
     *
     * @param string $name  The stylesheet option name.
     * @param mixed  $value The stylesheet option value.
     */
    private function assertStylesheetOption($name, $value)
    {
        $this->assertTrue($this->map->hasStylesheetOption($name));
        $this->assertSame($value, $this->map->getStylesheetOption($name));
    }

    /**
     * Asserts there are libraries.
     *
     * @param array $libraries The libraries.
     */
    private function assertLibraries($libraries)
    {
        $this->assertInternalType('array', $libraries);

        $this->assertTrue($this->map->hasLibraries());
        $this->assertSame($libraries, $this->map->getLibraries());

        foreach ($libraries as $library) {
            $this->assertLibrary($library);
        }
    }

    /**
     * Asserts there is a library.
     *
     * @param string $library The library.
     */
    private function assertLibrary($library)
    {
        $this->assertTrue($this->map->hasLibrary($library));
    }

    /**
     * Asserts there are no map options.
     */
    private function assertNoMapOptions()
    {
        $this->assertFalse($this->map->hasMapOptions());
        $this->assertEmpty($this->map->getMapOptions());
    }

    /**
     * Asserts there is no map option.
     *
     * @param string $name The map option name.
     */
    private function assertNoMapOption($name)
    {
        $this->assertFalse($this->map->hasMapOption($name));
        $this->assertNull($this->map->getMapOption($name));
    }

    /**
     * Asserts there are no stylesheet options.
     */
    private function assertNoStylesheetOptions()
    {
        $this->assertFalse($this->map->hasStylesheetOptions());
        $this->assertEmpty($this->map->getStylesheetOptions());
    }

    /**
     * Asserts there is no stylesheet option.
     *
     * @param string $name The stylesheet option name.
     */
    private function assertNoStylesheetOption($name)
    {
        $this->assertFalse($this->map->hasStylesheetOption($name));
        $this->assertNull($this->map->getStylesheetOption($name));
    }

    /**
     * Asserts there are no libraries.
     */
    private function assertNoLibraries()
    {
        $this->assertFalse($this->map->hasLibraries());
        $this->assertEmpty($this->map->getLibraries());
    }

    /**
     * Asserts there is no library.
     *
     * @param string $library The library.
     */
    private function assertNoLibrary($library)
    {
        $this->assertFalse($this->map->hasLibrary($library));
    }
}
