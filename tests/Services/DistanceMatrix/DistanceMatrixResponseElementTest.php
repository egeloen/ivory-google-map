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
class DirectionsResponseElementTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponse */
    protected $distanceMatrixResponseElement;

    /** @var string */
    protected $status;

    /** @var \Ivory\GoogleMap\Services\Base\Distance */
    protected $distance;

    /** @var \Ivory\GoogleMap\Services\Base\Duration */
    protected $duration;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->status = DistanceMatrixElementStatus::ZERO_RESULTS;

        $this->distance = $this->getMockBuilder('Ivory\GoogleMap\Services\Base\Distance')
            ->disableOriginalConstructor()
            ->getMock();

        $this->duration = $this->getMockBuilder('Ivory\GoogleMap\Services\Base\Duration')
            ->disableOriginalConstructor()
            ->getMock();

        $this->distanceMatrixResponseElement = new DistanceMatrixResponseElement(
            $this->status,
            $this->distance,
            $this->duration
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
        $this->assertSame($this->distance, $this->distanceMatrixResponseElement->getDistance());
        $this->assertSame($this->duration, $this->distanceMatrixResponseElement->getDuration());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DistanceMatrixException
     * @expectedExceptionMessage The distance matrix response element status can only be : NOT_FOUND, OK, ZERO_RESULTS.
     */
    public function testStatusWithInvalidValue()
    {
        $this->distanceMatrixResponseElement->setStatus('foo');
    }
}
