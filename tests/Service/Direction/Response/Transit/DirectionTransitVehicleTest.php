<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Direction\Response\Transit;

use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitVehicle;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitVehicleType;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionTransitVehicleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DirectionTransitVehicle
     */
    private $transitVehicle;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->transitVehicle = new DirectionTransitVehicle();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->transitVehicle->hasName());
        $this->assertNull($this->transitVehicle->getName());
        $this->assertFalse($this->transitVehicle->hasIcon());
        $this->assertNull($this->transitVehicle->getIcon());
        $this->assertFalse($this->transitVehicle->hasType());
        $this->assertNull($this->transitVehicle->getType());
        $this->assertFalse($this->transitVehicle->hasLocalIcon());
        $this->assertNull($this->transitVehicle->getLocalIcon());
    }

    public function testName()
    {
        $this->transitVehicle->setName($name = 'name');

        $this->assertTrue($this->transitVehicle->hasName());
        $this->assertSame($name, $this->transitVehicle->getName());
    }

    public function testIcon()
    {
        $this->transitVehicle->setIcon($icon = 'icon');

        $this->assertTrue($this->transitVehicle->hasIcon());
        $this->assertSame($icon, $this->transitVehicle->getIcon());
    }

    public function testType()
    {
        $this->transitVehicle->setType($type = DirectionTransitVehicleType::BUS);

        $this->assertTrue($this->transitVehicle->hasType());
        $this->assertSame($type, $this->transitVehicle->getType());
    }

    public function testLocalIcon()
    {
        $this->transitVehicle->setLocalIcon($localIcon = 'local_icon');

        $this->assertTrue($this->transitVehicle->hasLocalIcon());
        $this->assertSame($localIcon, $this->transitVehicle->getLocalIcon());
    }
}
