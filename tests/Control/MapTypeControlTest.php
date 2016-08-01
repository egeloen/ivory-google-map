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

use Ivory\GoogleMap\Control\ControlPosition;
use Ivory\GoogleMap\Control\MapTypeControl;
use Ivory\GoogleMap\Control\MapTypeControlStyle;
use Ivory\GoogleMap\MapTypeId;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MapTypeControl
     */
    private $mapTypeControl;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapTypeControl = new MapTypeControl();
    }

    public function testDefaultState()
    {
        $this->assertTrue($this->mapTypeControl->hasIds());
        $this->assertSame([MapTypeId::ROADMAP, MapTypeId::SATELLITE], $this->mapTypeControl->getIds());
        $this->assertSame(ControlPosition::TOP_RIGHT, $this->mapTypeControl->getPosition());
        $this->assertSame(MapTypeControlStyle::DEFAULT_, $this->mapTypeControl->getStyle());
    }

    public function testInitialState()
    {
        $this->mapTypeControl = new MapTypeControl(
            [],
            $position = ControlPosition::LEFT_TOP,
            $style = MapTypeControlStyle::HORIZONTAL_BAR
        );

        $this->assertFalse($this->mapTypeControl->hasIds());
        $this->assertEmpty($this->mapTypeControl->getIds());
        $this->assertSame($position, $this->mapTypeControl->getPosition());
        $this->assertSame($style, $this->mapTypeControl->getStyle());
    }

    public function testSetIds()
    {
        $this->mapTypeControl->setIds($ids = [$id = MapTypeId::HYBRID]);
        $this->mapTypeControl->setIds($ids);

        $this->assertTrue($this->mapTypeControl->hasIds());
        $this->assertTrue($this->mapTypeControl->hasId($id));
        $this->assertSame($ids, $this->mapTypeControl->getIds());
    }

    public function testAddIds()
    {
        $this->mapTypeControl->setIds($firstIds = [MapTypeId::HYBRID]);
        $this->mapTypeControl->addIds($secondIds = [MapTypeId::SATELLITE]);

        $this->assertTrue($this->mapTypeControl->hasIds());
        $this->assertSame(array_merge($firstIds, $secondIds), $this->mapTypeControl->getIds());
    }

    public function testAddId()
    {
        $this->mapTypeControl->addId($id = MapTypeId::HYBRID);

        $this->assertTrue($this->mapTypeControl->hasIds());
        $this->assertTrue($this->mapTypeControl->hasId($id));
    }

    public function testRemoveId()
    {
        $this->mapTypeControl->addId($id = MapTypeId::HYBRID);
        $this->mapTypeControl->removeId($id);

        $this->assertFalse($this->mapTypeControl->hasId($id));
    }

    public function testPosition()
    {
        $this->mapTypeControl->setPosition($position = ControlPosition::BOTTOM_CENTER);

        $this->assertSame($position, $this->mapTypeControl->getPosition());
    }

    public function testStyle()
    {
        $this->mapTypeControl->setStyle($style = MapTypeControlStyle::DROPDOWN_MENU);

        $this->assertSame($style, $this->mapTypeControl->getStyle());
    }
}
