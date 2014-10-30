<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\DistanceMatrix;

use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixElementStatus;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseElement;

/**
 * Directions response row test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixResponseElementTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseElement */
    private $distanceMatrixResponseElement;

    /** @var string */
    private $status;

    /** @var \Ivory\GoogleMap\Services\Base\Distance|\PHPUnit_Framework_MockObject_MockObject */
    private $distance;

    /** @var \Ivory\GoogleMap\Services\Base\Duration|\PHPUnit_Framework_MockObject_MockObject */
    private $duration;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->distanceMatrixResponseElement = new DistanceMatrixResponseElement(
            $this->status = DistanceMatrixElementStatus::ZERO_RESULTS,
            $this->distance = $this->createDistanceMock(),
            $this->duration = $this->createDurationMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->status);
        unset($this->distance);
        unset($this->duration);
        unset($this->distanceMatrixResponseElement);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->status, $this->distanceMatrixResponseElement->getStatus());

        $this->assertTrue($this->distanceMatrixResponseElement->hasDistance());
        $this->assertSame($this->distance, $this->distanceMatrixResponseElement->getDistance());

        $this->assertTrue($this->distanceMatrixResponseElement->hasDuration());
        $this->assertSame($this->duration, $this->distanceMatrixResponseElement->getDuration());
    }

    public function testSetStatus()
    {
        $this->distanceMatrixResponseElement->setStatus($status = DistanceMatrixElementStatus::OK);

        $this->assertSame($status, $this->distanceMatrixResponseElement->getStatus());
    }

    public function testSetDistance()
    {
        $this->distanceMatrixResponseElement->setDistance($distance = $this->createDistanceMock());

        $this->assertTrue($this->distanceMatrixResponseElement->hasDistance());
        $this->assertSame($distance, $this->distanceMatrixResponseElement->getDistance());
    }

    public function testResetDistance()
    {
        $this->distanceMatrixResponseElement->setDistance(null);

        $this->assertFalse($this->distanceMatrixResponseElement->hasDistance());
        $this->assertNull($this->distanceMatrixResponseElement->getDistance());
    }

    public function testSetDuration()
    {
        $this->distanceMatrixResponseElement->setDuration($duration = $this->createDurationMock());

        $this->assertTrue($this->distanceMatrixResponseElement->hasDuration());
        $this->assertSame($duration, $this->distanceMatrixResponseElement->getDuration());
    }

    public function testResetDuration()
    {
        $this->distanceMatrixResponseElement->setDuration(null);

        $this->assertFalse($this->distanceMatrixResponseElement->hasDuration());
        $this->assertNull($this->distanceMatrixResponseElement->getDuration());
    }
}
