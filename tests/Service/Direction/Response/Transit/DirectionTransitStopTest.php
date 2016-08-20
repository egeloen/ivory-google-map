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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitStop;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionTransitStopTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DirectionTransitStop
     */
    private $transitStop;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->transitStop = new DirectionTransitStop();
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
