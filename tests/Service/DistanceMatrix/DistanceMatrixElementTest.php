<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\DistanceMatrix;

use Ivory\GoogleMap\Service\Base\Distance;
use Ivory\GoogleMap\Service\Base\Duration;
use Ivory\GoogleMap\Service\DistanceMatrix\DistanceMatrixElement;
use Ivory\GoogleMap\Service\DistanceMatrix\DistanceMatrixElementStatus;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixElementTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DistanceMatrixElement
     */
    private $element;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->element = new DistanceMatrixElement();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->element->hasStatus());
        $this->assertNull($this->element->getStatus());
        $this->assertFalse($this->element->hasDistance());
        $this->assertNull($this->element->getDistance());
        $this->assertFalse($this->element->hasDuration());
        $this->assertNull($this->element->getDuration());
    }

    public function testStatus()
    {
        $this->element->setStatus($status = DistanceMatrixElementStatus::ZERO_RESULTS);

        $this->assertTrue($this->element->hasStatus());
        $this->assertSame($status, $this->element->getStatus());
    }

    public function testResetStatus()
    {
        $this->element->setStatus(DistanceMatrixElementStatus::ZERO_RESULTS);
        $this->element->setStatus(null);

        $this->assertFalse($this->element->hasStatus());
        $this->assertNull($this->element->getStatus());
    }

    public function testDistance()
    {
        $this->element->setDistance($distance = $this->createDistanceMock());

        $this->assertTrue($this->element->hasDistance());
        $this->assertSame($distance, $this->element->getDistance());
    }

    public function testResetDistance()
    {
        $this->element->setDistance($this->createDistanceMock());
        $this->element->setDistance(null);

        $this->assertFalse($this->element->hasDistance());
        $this->assertNull($this->element->getDistance());
    }

    public function testDuration()
    {
        $this->element->setDuration($duration = $this->createDurationMock());

        $this->assertTrue($this->element->hasDuration());
        $this->assertSame($duration, $this->element->getDuration());
    }

    public function testResetDuration()
    {
        $this->element->setDuration($this->createDurationMock());
        $this->element->setDuration(null);

        $this->assertFalse($this->element->hasDuration());
        $this->assertNull($this->element->getDuration());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Distance
     */
    private function createDistanceMock()
    {
        return $this->createMock(Distance::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Duration
     */
    private function createDurationMock()
    {
        return $this->createMock(Duration::class);
    }
}
