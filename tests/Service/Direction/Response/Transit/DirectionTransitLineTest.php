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

use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitAgency;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitLine;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitVehicle;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionTransitLineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DirectionTransitLine
     */
    private $transitLine;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->transitLine = new DirectionTransitLine();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->transitLine->hasName());
        $this->assertNull($this->transitLine->getName());
        $this->assertFalse($this->transitLine->hasShortName());
        $this->assertNull($this->transitLine->getShortName());
        $this->assertFalse($this->transitLine->hasColor());
        $this->assertNull($this->transitLine->getColor());
        $this->assertFalse($this->transitLine->hasUrl());
        $this->assertNull($this->transitLine->getUrl());
        $this->assertFalse($this->transitLine->hasIcon());
        $this->assertNull($this->transitLine->getIcon());
        $this->assertFalse($this->transitLine->hasTextColor());
        $this->assertNull($this->transitLine->getTextColor());
        $this->assertFalse($this->transitLine->hasVehicle());
        $this->assertNull($this->transitLine->getVehicle());
        $this->assertFalse($this->transitLine->hasAgencies());
        $this->assertEmpty($this->transitLine->getAgencies());
    }

    public function testName()
    {
        $this->transitLine->setName($name = 'name');

        $this->assertTrue($this->transitLine->hasName());
        $this->assertSame($name, $this->transitLine->getName());
    }

    public function testShortName()
    {
        $this->transitLine->setShortName($shortName = 'short_name');

        $this->assertTrue($this->transitLine->hasShortName());
        $this->assertSame($shortName, $this->transitLine->getShortName());
    }

    public function testColor()
    {
        $this->transitLine->setColor($color = 'color');

        $this->assertTrue($this->transitLine->hasColor());
        $this->assertSame($color, $this->transitLine->getColor());
    }

    public function testUrl()
    {
        $this->transitLine->setUrl($url = 'url');

        $this->assertTrue($this->transitLine->hasUrl());
        $this->assertSame($url, $this->transitLine->getUrl());
    }

    public function testIcon()
    {
        $this->transitLine->setIcon($icon = 'icon');

        $this->assertTrue($this->transitLine->hasIcon());
        $this->assertSame($icon, $this->transitLine->getIcon());
    }

    public function testTextColor()
    {
        $this->transitLine->setTextColor($textColor = 'text_color');

        $this->assertTrue($this->transitLine->hasTextColor());
        $this->assertSame($textColor, $this->transitLine->getTextColor());
    }

    public function testVehicle()
    {
        $this->transitLine->setVehicle($vehicle = $this->createTransitVehicleMock());

        $this->assertTrue($this->transitLine->hasVehicle());
        $this->assertSame($vehicle, $this->transitLine->getVehicle());
    }

    public function testSetAgencies()
    {
        $this->transitLine->setAgencies($agencies = [$agency = $this->createTransitAgencyMock()]);
        $this->transitLine->setAgencies($agencies);

        $this->assertTrue($this->transitLine->hasAgencies());
        $this->assertTrue($this->transitLine->hasAgency($agency));
        $this->assertSame($agencies, $this->transitLine->getAgencies());
    }

    public function testAddAgencies()
    {
        $this->transitLine->setAgencies($firstAgencies = [$this->createTransitAgencyMock()]);
        $this->transitLine->addAgencies($secondAgencies = [$this->createTransitAgencyMock()]);

        $this->assertTrue($this->transitLine->hasAgencies());
        $this->assertSame(array_merge($firstAgencies, $secondAgencies), $this->transitLine->getAgencies());
    }

    public function testAddAgency()
    {
        $this->transitLine->addAgency($agency = $this->createTransitAgencyMock());

        $this->assertTrue($this->transitLine->hasAgencies());
        $this->assertTrue($this->transitLine->hasAgency($agency));
        $this->assertSame([$agency], $this->transitLine->getAgencies());
    }

    public function testRemoveAgency()
    {
        $this->transitLine->addAgency($agency = $this->createTransitAgencyMock());
        $this->transitLine->removeAgency($agency);

        $this->assertFalse($this->transitLine->hasAgencies());
        $this->assertFalse($this->transitLine->hasAgency($agency));
        $this->assertEmpty($this->transitLine->getAgencies());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DirectionTransitAgency
     */
    private function createTransitAgencyMock()
    {
        return $this->createMock(DirectionTransitAgency::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DirectionTransitVehicle
     */
    private function createTransitVehicleMock()
    {
        return $this->createMock(DirectionTransitVehicle::class);
    }
}
