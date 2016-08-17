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

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Control\ControlManager;
use Ivory\GoogleMap\Event\EventManager;
use Ivory\GoogleMap\Layer\LayerManager;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\OverlayManager;
use Ivory\GoogleMap\Utility\VariableAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Map
     */
    private $map;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->map = new Map();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(VariableAwareInterface::class, $this->map);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('map', $this->map->getVariable());
        $this->assertSame('map_canvas', $this->map->getHtmlId());
        $this->assertFalse($this->map->isAutoZoom());
        $this->assertInstanceOf(Coordinate::class, $this->map->getCenter());
        $this->assertInstanceOf(Bound::class, $this->map->getBound());
        $this->assertInstanceOf(ControlManager::class, $this->map->getControlManager());
        $this->assertInstanceOf(EventManager::class, $this->map->getEventManager());
        $this->assertInstanceOf(OverlayManager::class, $this->map->getOverlayManager());
        $this->assertInstanceOf(LayerManager::class, $this->map->getLayerManager());
        $this->assertFalse($this->map->hasLibraries());
        $this->assertEmpty($this->map->getLibraries());
        $this->assertFalse($this->map->hasMapOptions());
        $this->assertEmpty($this->map->getMapOptions());
        $this->assertFalse($this->map->hasStylesheetOptions());
        $this->assertEmpty($this->map->getStylesheetOptions());
        $this->assertFalse($this->map->hasHtmlAttributes());
        $this->assertEmpty($this->map->getHtmlAttributes());
    }

    public function testHtmlId()
    {
        $this->map->setHtmlId($htmlId = 'html_id');

        $this->assertSame($htmlId, $this->map->getHtmlId());
    }

    public function testAutoZoom()
    {
        $this->map->setAutoZoom(true);

        $this->assertTrue($this->map->isAutoZoom());
    }

    public function testCenter()
    {
        $this->map->setCenter($center = $this->createCoordinateMock());

        $this->assertSame($center, $this->map->getCenter());
    }

    public function testBound()
    {
        $this->map->setBound($bound = $this->createBoundMock());

        $this->assertSame($bound, $this->map->getBound());
    }

    public function testControlManager()
    {
        $this->map->setControlManager($controlManager = $this->createControlManagerMock());

        $this->assertSame($controlManager, $this->map->getControlManager());
    }

    public function testEventManager()
    {
        $this->map->setEventManager($eventManager = $this->createEventManagerMock());

        $this->assertSame($eventManager, $this->map->getEventManager());
    }

    public function testLayerManager()
    {
        $layerManager = $this->createLayerManagerMock();
        $layerManager
            ->expects($this->once())
            ->method('getMap')
            ->will($this->returnValue(null));

        $layerManager
            ->expects($this->once())
            ->method('setMap')
            ->with($this->identicalTo($this->map));

        $this->map->setLayerManager($layerManager);

        $this->assertSame($layerManager, $this->map->getLayerManager());
    }

    public function testOverlayManager()
    {
        $overlayManager = $this->createOverlayManagerMock();
        $overlayManager
            ->expects($this->once())
            ->method('getMap')
            ->will($this->returnValue(null));

        $overlayManager
            ->expects($this->once())
            ->method('setMap')
            ->with($this->identicalTo($this->map));

        $this->map->setOverlayManager($overlayManager);

        $this->assertSame($overlayManager, $this->map->getOverlayManager());
    }

    public function testSetLibraries()
    {
        $this->map->setLibraries($libraries = [$library = 'geometry']);
        $this->map->setLibraries($libraries);

        $this->assertTrue($this->map->hasLibraries());
        $this->assertTrue($this->map->hasLibrary($library));
        $this->assertSame($libraries, $this->map->getLibraries());
    }

    public function testAddLibraries()
    {
        $this->map->setLibraries($firstLibraries = ['geometry']);
        $this->map->addLibraries($secondLibraries = ['places']);

        $this->assertTrue($this->map->hasLibraries());
        $this->assertSame(array_merge($firstLibraries, $secondLibraries), $this->map->getLibraries());
    }

    public function testAddLibrary()
    {
        $this->map->addLibrary($library = 'geometry');

        $this->assertTrue($this->map->hasLibraries());
        $this->assertTrue($this->map->hasLibrary($library));
        $this->assertSame([$library], $this->map->getLibraries());
    }

    public function testRemoveLibrary()
    {
        $this->map->addLibrary($library = 'geometry');
        $this->map->removeLibrary($library);

        $this->assertFalse($this->map->hasLibraries());
        $this->assertFalse($this->map->hasLibrary($library));
        $this->assertEmpty($this->map->getLibraries());
    }

    public function testSetMapOptions()
    {
        $this->map->setMapOptions($mapOptions = [$mapOption = 'clickableIcons' => $value = false]);
        $this->map->setMapOptions($mapOptions);

        $this->assertTrue($this->map->hasMapOptions());
        $this->assertTrue($this->map->hasMapOption($mapOption));
        $this->assertSame($mapOptions, $this->map->getMapOptions());
        $this->assertSame($value, $this->map->getMapOption($mapOption));
    }

    public function testAddMapOptions()
    {
        $this->map->setMapOptions($firstMapOptions = ['clickableIcons' => false]);
        $this->map->addMapOptions($secondMapOptions = ['disableDefaultUI' => true]);

        $this->assertTrue($this->map->hasMapOptions());
        $this->assertSame(
            array_merge($firstMapOptions, $secondMapOptions),
            $this->map->getMapOptions()
        );
    }

    public function testAddMapOption()
    {
        $this->map->setMapOption($mapOption = 'clickableIcons', $value = false);

        $this->assertTrue($this->map->hasMapOptions());
        $this->assertTrue($this->map->hasMapOption($mapOption));
        $this->assertSame([$mapOption => $value], $this->map->getMapOptions());
        $this->assertSame($value, $this->map->getMapOption($mapOption));
    }

    public function testRemoveMapOption()
    {
        $this->map->setMapOption($mapOption = 'clickableIcons', false);
        $this->map->removeMapOption($mapOption);

        $this->assertFalse($this->map->hasMapOptions());
        $this->assertFalse($this->map->hasMapOption($mapOption));
        $this->assertEmpty($this->map->getMapOptions());
        $this->assertNull($this->map->getMapOption($mapOption));
    }

    public function testSetStylesheetOptions()
    {
        $this->map->setStylesheetOptions($stylesheetOptions = [$stylesheetOption = 'border' => $value = '1px']);
        $this->map->setStylesheetOptions($stylesheetOptions);

        $this->assertTrue($this->map->hasStylesheetOptions());
        $this->assertTrue($this->map->hasStylesheetOption($stylesheetOption));
        $this->assertSame($stylesheetOptions, $this->map->getStylesheetOptions());

        $this->assertSame($value, $this->map->getStylesheetOption($stylesheetOption));
    }

    public function testAddStylesheetOptions()
    {
        $this->map->setStylesheetOptions($firstStylesheetOptions = ['border' => '1px']);
        $this->map->addStylesheetOptions($secondStylesheetOptions = ['margin' => '10px']);

        $this->assertTrue($this->map->hasStylesheetOptions());
        $this->assertSame(
            array_merge($firstStylesheetOptions, $secondStylesheetOptions),
            $this->map->getStylesheetOptions()
        );
    }

    public function testAddStylesheetOption()
    {
        $this->map->setStylesheetOption($stylesheetOption = 'border', $value = '1px');

        $this->assertTrue($this->map->hasStylesheetOptions());
        $this->assertTrue($this->map->hasStylesheetOption($stylesheetOption));
        $this->assertSame([$stylesheetOption => $value], $this->map->getStylesheetOptions());
        $this->assertSame($value, $this->map->getStylesheetOption($stylesheetOption));
    }

    public function testRemoveStylesheetOption()
    {
        $this->map->setStylesheetOption($stylesheetOption = 'border', '1px');
        $this->map->removeStylesheetOption($stylesheetOption);

        $this->assertFalse($this->map->hasStylesheetOptions());
        $this->assertFalse($this->map->hasStylesheetOption($stylesheetOption));
        $this->assertEmpty($this->map->getStylesheetOptions());
        $this->assertNull($this->map->getStylesheetOption($stylesheetOption));
    }

    public function testSetHtmlAttributes()
    {
        $this->map->setHtmlAttributes($htmlAttributes = [$htmlAttribute = 'class' => $value = 'my-class']);
        $this->map->setHtmlAttributes($htmlAttributes);

        $this->assertTrue($this->map->hasHtmlAttributes());
        $this->assertTrue($this->map->hasHtmlAttribute($htmlAttribute));
        $this->assertSame($htmlAttributes, $this->map->getHtmlAttributes());

        $this->assertSame($value, $this->map->getHtmlAttribute($htmlAttribute));
    }

    public function testAddHtmlAttributes()
    {
        $this->map->setHtmlAttributes($firstHtmlAttributes = ['class' => 'my-class']);
        $this->map->addHtmlAttributes($secondHtmlAttributes = ['data-order' => '1']);

        $this->assertTrue($this->map->hasHtmlAttributes());
        $this->assertSame(
            array_merge($firstHtmlAttributes, $secondHtmlAttributes),
            $this->map->getHtmlAttributes()
        );
    }

    public function testAddHtmlAttribute()
    {
        $this->map->setHtmlAttribute($htmlAttribute = 'class', $value = 'my-class');

        $this->assertTrue($this->map->hasHtmlAttributes());
        $this->assertTrue($this->map->hasHtmlAttribute($htmlAttribute));
        $this->assertSame([$htmlAttribute => $value], $this->map->getHtmlAttributes());
        $this->assertSame($value, $this->map->getHtmlAttribute($htmlAttribute));
    }

    public function testRemoveHtmlAttribute()
    {
        $this->map->setHtmlAttribute($htmlAttribute = 'class', 'my-class');
        $this->map->removeHtmlAttribute($htmlAttribute);

        $this->assertFalse($this->map->hasHtmlAttributes());
        $this->assertFalse($this->map->hasHtmlAttribute($htmlAttribute));
        $this->assertEmpty($this->map->getHtmlAttributes());
        $this->assertNull($this->map->getHtmlAttribute($htmlAttribute));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        return $this->createMock(Coordinate::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Bound
     */
    private function createBoundMock()
    {
        return $this->createMock(Bound::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ControlManager
     */
    private function createControlManagerMock()
    {
        return $this->createMock(ControlManager::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|EventManager
     */
    private function createEventManagerMock()
    {
        return $this->createMock(EventManager::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|LayerManager
     */
    private function createLayerManagerMock()
    {
        return $this->createMock(LayerManager::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|OverlayManager
     */
    private function createOverlayManagerMock()
    {
        return $this->createMock(OverlayManager::class);
    }
}
