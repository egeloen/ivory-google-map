<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Control;

use Ivory\GoogleMap\Control\ControlManager;
use Ivory\GoogleMap\Control\MapTypeControl;
use Ivory\GoogleMap\Control\RotateControl;
use Ivory\GoogleMap\Control\ScaleControl;
use Ivory\GoogleMap\Control\StreetViewControl;
use Ivory\GoogleMap\Control\ZoomControl;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ControlManager
     */
    private $controlManager;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->controlManager = new ControlManager();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->controlManager->hasMap());
        $this->assertNull($this->controlManager->getMap());
        $this->assertFalse($this->controlManager->hasMapTypeControl());
        $this->assertNull($this->controlManager->getMapTypeControl());
        $this->assertFalse($this->controlManager->hasRotateControl());
        $this->assertNull($this->controlManager->getRotateControl());
        $this->assertFalse($this->controlManager->hasScaleControl());
        $this->assertNull($this->controlManager->getScaleControl());
        $this->assertFalse($this->controlManager->hasStreetViewControl());
        $this->assertNull($this->controlManager->getStreetViewControl());
        $this->assertFalse($this->controlManager->hasZoomControl());
        $this->assertNull($this->controlManager->getZoomControl());
    }

    public function testMap()
    {
        $map = $this->createMapMock();
        $map
            ->expects($this->once())
            ->method('getControlManager')
            ->will($this->returnValue(null));

        $map
            ->expects($this->once())
            ->method('setControlManager')
            ->with($this->identicalTo($this->controlManager));

        $this->controlManager->setMap($map);

        $this->assertTrue($this->controlManager->hasMap());
        $this->assertSame($map, $this->controlManager->getMap());
    }

    public function testMapTypeControl()
    {
        $this->controlManager->setMapTypeControl($mapTypeControl = $this->createMapTypeControlMock());

        $this->assertTrue($this->controlManager->hasMapTypeControl());
        $this->assertSame($mapTypeControl, $this->controlManager->getMapTypeControl());
    }

    public function testResetMapTypeControl()
    {
        $this->controlManager->setMapTypeControl($this->createMapTypeControlMock());
        $this->controlManager->setMapTypeControl(null);

        $this->assertFalse($this->controlManager->hasMapTypeControl());
        $this->assertNull($this->controlManager->getMapTypeControl());
    }

    public function testRotateControl()
    {
        $this->controlManager->setRotateControl($rotateControl = $this->createRotateControlMock());

        $this->assertTrue($this->controlManager->hasRotateControl());
        $this->assertSame($rotateControl, $this->controlManager->getRotateControl());
    }

    public function testResetRotateControl()
    {
        $this->controlManager->setRotateControl($this->createRotateControlMock());
        $this->controlManager->setRotateControl(null);

        $this->assertFalse($this->controlManager->hasRotateControl());
        $this->assertNull($this->controlManager->getRotateControl());
    }

    public function testScaleControl()
    {
        $this->controlManager->setScaleControl($scaleControl = $this->createScaleControlMock());

        $this->assertTrue($this->controlManager->hasScaleControl());
        $this->assertSame($scaleControl, $this->controlManager->getScaleControl());
    }

    public function testResetScaleControl()
    {
        $this->controlManager->setScaleControl($this->createScaleControlMock());
        $this->controlManager->setScaleControl(null);

        $this->assertFalse($this->controlManager->hasScaleControl());
        $this->assertNull($this->controlManager->getScaleControl());
    }

    public function testStreetViewControl()
    {
        $this->controlManager->setStreetViewControl($streetViewControl = $this->createStreetViewControlMock());

        $this->assertTrue($this->controlManager->hasStreetViewControl());
        $this->assertSame($streetViewControl, $this->controlManager->getStreetViewControl());
    }

    public function testResetStreetViewControl()
    {
        $this->controlManager->setStreetViewControl($this->createStreetViewControlMock());
        $this->controlManager->setStreetViewControl(null);

        $this->assertFalse($this->controlManager->hasStreetViewControl());
        $this->assertNull($this->controlManager->getStreetViewControl());
    }

    public function testZoomControl()
    {
        $this->controlManager->setZoomControl($zoomControl = $this->createZoomControlMock());

        $this->assertTrue($this->controlManager->hasZoomControl());
        $this->assertSame($zoomControl, $this->controlManager->getZoomControl());
    }

    public function testResetZoomControl()
    {
        $this->controlManager->setZoomControl($this->createZoomControlMock());
        $this->controlManager->setZoomControl(null);

        $this->assertFalse($this->controlManager->hasZoomControl());
        $this->assertNull($this->controlManager->getZoomControl());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Map
     */
    private function createMapMock()
    {
        return $this->createMock(Map::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|MapTypeControl
     */
    private function createMapTypeControlMock()
    {
        return $this->createMock(MapTypeControl::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|RotateControl
     */
    private function createRotateControlMock()
    {
        return $this->createMock(RotateControl::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ScaleControl
     */
    private function createScaleControlMock()
    {
        return $this->createMock(ScaleControl::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|StreetViewControl
     */
    private function createStreetViewControlMock()
    {
        return $this->createMock(StreetViewControl::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ZoomControl
     */
    private function createZoomControlMock()
    {
        return $this->createMock(ZoomControl::class);
    }
}
