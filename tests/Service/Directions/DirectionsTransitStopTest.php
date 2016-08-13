<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Directions;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Directions\DirectionsTransitStop;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsTransitStopTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DirectionsTransitStop
     */
    private $transitStop;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->transitStop = new DirectionsTransitStop();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->transitStop->hasName());
        $this->assertNull($this->transitStop->getName());
        $this->assertFalse($this->transitStop->hasLocation());
        $this->assertNull($this->transitStop->getLocation());
    }

    public function testName()
    {
        $this->transitStop->setName($name = 'name');

        $this->assertTrue($this->transitStop->hasName());
        $this->assertSame($name, $this->transitStop->getName());
    }

    public function testLocation()
    {
        $this->transitStop->setLocation($location = $this->createCoordinateMock());

        $this->assertTrue($this->transitStop->hasLocation());
        $this->assertSame($location, $this->transitStop->getLocation());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        return $this->createMock(Coordinate::class);
    }
}
