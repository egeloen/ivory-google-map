<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Elevation\Response;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResult;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ElevationResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ElevationResult
     */
    private $result;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->result = new ElevationResult();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->result->hasLocation());
        $this->assertNull($this->result->getLocation());
        $this->assertFalse($this->result->hasElevation());
        $this->assertNull($this->result->getElevation());
        $this->assertFalse($this->result->hasResolution());
        $this->assertNull($this->result->getResolution());
    }

    public function testLocation()
    {
        $this->result->setLocation($location = $this->createCoordinateMock());

        $this->assertTrue($this->result->hasLocation());
        $this->assertSame($location, $this->result->getLocation());
    }

    public function testResetLocation()
    {
        $this->result->setLocation($this->createCoordinateMock());
        $this->result->setLocation(null);

        $this->assertFalse($this->result->hasLocation());
        $this->assertNull($this->result->getLocation());
    }

    public function testElevation()
    {
        $this->result->setElevation($elevation = 1.234);

        $this->assertTrue($this->result->hasElevation());
        $this->assertSame($elevation, $this->result->getElevation());
    }

    public function testResetElevation()
    {
        $this->result->setElevation(1.234);
        $this->result->setElevation(null);

        $this->assertFalse($this->result->hasElevation());
        $this->assertNull($this->result->getElevation());
    }

    public function testResolution()
    {
        $this->result->setResolution($resolution = 1.234);

        $this->assertTrue($this->result->hasResolution());
        $this->assertSame($resolution, $this->result->getResolution());
    }

    public function testResetResolution()
    {
        $this->result->setResolution(1.234);
        $this->result->setResolution(null);

        $this->assertFalse($this->result->hasResolution());
        $this->assertNull($this->result->getResolution());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        return $this->createMock(Coordinate::class);
    }
}
