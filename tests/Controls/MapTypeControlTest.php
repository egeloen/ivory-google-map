<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Controls;

use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\MapTypeControl;
use Ivory\GoogleMap\Controls\MapTypeControlStyle;
use Ivory\GoogleMap\MapTypeId;

/**
 * Map type control test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Controls\MapTypeControl */
    private $mapTypeControl;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapTypeControl = new MapTypeControl();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->mapTypeControl);
    }

    public function testDefaultState()
    {
        $this->assertMapTypeIds(array(MapTypeId::ROADMAP, MapTypeId::SATELLITE));
        $this->assertSame(ControlPosition::TOP_RIGHT, $this->mapTypeControl->getControlPosition());
        $this->assertSame(MapTypeControlStyle::DEFAULT_, $this->mapTypeControl->getMapTypeControlStyle());
    }

    public function testInitialState()
    {
        $this->mapTypeControl = new MapTypeControl(
            $mapTypeIds = array(MapTypeId::TERRAIN, MapTypeId::HYBRID),
            $controlPosition = ControlPosition::LEFT_TOP,
            $mapTypeControlStyle = MapTypeControlStyle::HORIZONTAL_BAR
        );

        $this->assertMapTypeIds($mapTypeIds);
        $this->assertSame($controlPosition, $this->mapTypeControl->getControlPosition());
        $this->assertSame($mapTypeControlStyle, $this->mapTypeControl->getMapTypeControlStyle());
    }

    public function testSetMapTypeIds()
    {
        $this->mapTypeControl->setMapTypeIds($mapTypeIds = array(MapTypeId::TERRAIN, MapTypeId::HYBRID));

        $this->assertMapTypeIds($mapTypeIds);
    }

    public function testAddMapTypeIds()
    {
        $this->mapTypeControl->setMapTypeIds($mapTypeIds = array(MapTypeId::TERRAIN, MapTypeId::HYBRID));
        $this->mapTypeControl->addMapTypeIds($newMapTypeIds = array(MapTypeId::ROADMAP, MapTypeId::SATELLITE));

        $this->assertMapTypeIds(array_merge($mapTypeIds, $newMapTypeIds));
    }

    public function testRemoveMapTypeIds()
    {
        $this->mapTypeControl->setMapTypeIds($mapTypeIds = array(MapTypeId::TERRAIN, MapTypeId::HYBRID));
        $this->mapTypeControl->removeMapTypeIds($mapTypeIds);

        $this->assertNoMapTypeIds();
    }

    public function testResetMapTypeIds()
    {
        $this->mapTypeControl->resetMapTypeIds();

        $this->assertNoMapTypeIds();
    }

    public function testAddMapTypeId()
    {
        $this->mapTypeControl->addMapTypeId($mapTypeId = MapTypeId::HYBRID);

        $this->assertMapTypeId($mapTypeId);
    }

    public function testAddMapTypeIdUnicity()
    {
        $this->mapTypeControl->resetMapTypeIds();
        $this->mapTypeControl->addMapTypeId($mapTypeId = MapTypeId::HYBRID);
        $this->mapTypeControl->addMapTypeId($mapTypeId);

        $this->assertMapTypeIds(array($mapTypeId));
    }

    public function removeMapTypeId()
    {
        $this->mapTypeControl->addMapTypeId($mapTypeId = MapTypeId::HYBRID);
        $this->mapTypeControl->removeMapTypeId($mapTypeId);

        $this->assertNoMapTypeId($mapTypeId);
    }

    public function testSetControlPosition()
    {
        $this->mapTypeControl->setControlPosition($controlPosition = ControlPosition::LEFT_TOP);

        $this->assertSame($controlPosition, $this->mapTypeControl->getControlPosition());
    }

    public function testSetMapTypeControlStyle()
    {
        $this->mapTypeControl->setMapTypeControlStyle($mapTypeControlStyle = MapTypeControlStyle::HORIZONTAL_BAR);

        $this->assertSame($mapTypeControlStyle, $this->mapTypeControl->getMapTypeControlStyle());
    }

    /**
     * Asserts the map type ids.
     *
     * @param array $mapTypeIds The map types ids.
     */
    private function assertMapTypeIds($mapTypeIds)
    {
        $this->assertInternalType('array', $mapTypeIds);

        $this->assertTrue($this->mapTypeControl->hasMapTypeIds());
        $this->assertSame($mapTypeIds, $this->mapTypeControl->getMapTypeIds());

        foreach ($mapTypeIds as $mapTypeId) {
            $this->assertMapTypeId($mapTypeId);
        }
    }

    /**
     * Asserts a map type id.
     *
     * @param integer $mapTypeId The map type id.
     */
    private function assertMapTypeId($mapTypeId)
    {
        $this->assertTrue($this->mapTypeControl->hasMapTypeId($mapTypeId));
    }

    /**
     * Asserts no map type ids.
     */
    private function assertNoMapTypeIds()
    {
        $this->assertFalse($this->mapTypeControl->hasMapTypeIds());
        $this->assertEmpty($this->mapTypeControl->getMapTypeIds());
    }

    /**
     * Asserts no map type id.
     *
     * @param integer $mapTypeId The map type id.
     */
    private function assertNoMapTypeId($mapTypeId)
    {
        $this->assertFalse($this->mapTypeControl->hasMapTypeId($mapTypeId));
    }
}
