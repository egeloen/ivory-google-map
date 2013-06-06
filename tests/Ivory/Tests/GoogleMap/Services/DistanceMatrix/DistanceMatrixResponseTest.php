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

use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponse;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixStatus;

/**
 * Directions response test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsResponseTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponse */
    protected $distanceMatrixResponse;

    /** @var string */
    protected $status;

    /** @var array */
    protected $origins;

    /** @var array */
    protected $destinations;

    /** @var array */
    protected $rows;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $row = $this->getMockBuilder('Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseRow')
            ->disableOriginalConstructor()
            ->getMock();

        $this->status = DistanceMatrixStatus::REQUEST_DENIED;
        $this->origins = array('foo');
        $this->destinations = array('bar');
        $this->rows = array($row);

        $this->distanceMatrixResponse = new DistanceMatrixResponse(
            $this->status,
            $this->origins,
            $this->destinations,
            $this->rows
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->status);
        unset($this->origins);
        unset($this->destinations);
        unset($this->rows);
        unset($this->distanceMatrixResponse);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->status, $this->distanceMatrixResponse->getStatus());
        $this->assertSame($this->origins, $this->distanceMatrixResponse->getOrigins());
        $this->assertSame($this->destinations, $this->distanceMatrixResponse->getDestinations());
        $this->assertSame($this->rows, $this->distanceMatrixResponse->getRows());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DistanceMatrixException
     * @expectedExceptionMessage The distance matrix response status can only be : INVALID_REQUEST,
     * MAX_DIMENSIONS_EXCEEDED, MAX_ELEMENTS_EXCEEDED, OK, OVER_QUERY_LIMIT, REQUEST_DENIED, UNKNOWN_ERROR.
     */
    public function testStatusWithInvalidValue()
    {
        $this->distanceMatrixResponse->setStatus('foo');
    }
}
