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
class MapTypeControlTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Controls\MapTypeControl */
    protected $mapTypeControl;

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
        $this->assertSame(array(MapTypeId::ROADMAP, MapTypeId::SATELLITE), $this->mapTypeControl->getMapTypeIds());
        $this->assertSame(ControlPosition::TOP_RIGHT, $this->mapTypeControl->getControlPosition());
        $this->assertSame(MapTypeControlStyle::DEFAULT_, $this->mapTypeControl->getMapTypeControlStyle());
    }

    public function testInitialState()
    {
        $mapTypeIds = array(MapTypeId::HYBRID);
        $controlPosition = ControlPosition::LEFT_TOP;
        $mapTypeControlStyle = MapTypeControlStyle::HORIZONTAL_BAR;

        $this->mapTypeControl = new MapTypeControl($mapTypeIds, $controlPosition, $mapTypeControlStyle);

        $this->assertSame($mapTypeIds, $this->mapTypeControl->getMapTypeIds());
        $this->assertSame($controlPosition, $this->mapTypeControl->getControlPosition());
        $this->assertSame($mapTypeControlStyle, $this->mapTypeControl->getMapTypeControlStyle());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\ControlException
     * @expectedExceptionMessage The map type id can only be : hybrid, roadmap, satellite, terrain.
     */
    public function testMapTypeIdWithInvalidValue()
    {
        $this->mapTypeControl->addMapTypeId('foo');
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\ControlException
     * @expectedExceptionMessage The control position can only be : bottom_center, bottom_left, bottom_right,
     * left_bottom, left_center, left_top, right_bottom, right_center, right_top, top_center, top_left, top_right.
     */
    public function testControlPositionWithInvalidValue()
    {
        $this->mapTypeControl->setControlPosition('foo');
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\ControlException
     * @expectedExceptionMessage The map type control style can only be : default, dropdown_menu, horizontal_bar.
     */
    public function testMapTypeControlStyleWithInvalidValue()
    {
        $this->mapTypeControl->setMapTypeControlStyle('foo');
    }
}
