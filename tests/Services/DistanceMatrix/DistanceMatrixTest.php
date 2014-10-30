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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixElementStatus;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixStatus;
use Ivory\GoogleMap\Services\Base\TravelMode;
use Ivory\GoogleMap\Services\Base\UnitSystem;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrix;
use Ivory\HttpAdapter\SocketHttpAdapter;

/**
 * Distance matrix test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrix */
    private $distanceMatrix;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->distanceMatrix = new DistanceMatrix(new SocketHttpAdapter());
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->distanceMatrix);
    }

    public function testInheritance()
    {
        $this->assertServiceInstance($this->distanceMatrix);
    }

    /**
     * @dataProvider requestProvider
     */
    public function testProcessWithJsonFormat(DistanceMatrixRequest $request)
    {
        $response = $this->distanceMatrix->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());

        $this->assertCount(1, $response->getOrigins());
        $this->assertCount(1, $response->getDestinations());
        $this->assertCount(1, $rows = $response->getRows());

        $this->assertArrayHasKey(0, $rows);
        $this->assertCount(1, $elements = $rows[0]->getElements());

        $this->assertArrayHasKey(0, $elements);
        $this->assertSame(DistanceMatrixElementStatus::OK, $elements[0]->getStatus());
    }

    /**
     * @dataProvider requestProvider
     */
    public function testProcessWithXmlFormat(DistanceMatrixRequest $request)
    {
        $this->distanceMatrix->setFormat(DistanceMatrix::FORMAT_XML);
        $response = $this->distanceMatrix->process($request);

        $this->assertCount(1, $response->getOrigins());
        $this->assertCount(1, $response->getDestinations());
        $this->assertCount(1, $rows = $response->getRows());

        $this->assertArrayHasKey(0, $rows);
        $this->assertCount(1, $elements = $rows[0]->getElements());

        $this->assertArrayHasKey(0, $elements);
        $this->assertSame(DistanceMatrixElementStatus::OK, $elements[0]->getStatus());
    }

    public function testProcessWithInvalidRequest()
    {
        $response = $this->distanceMatrix->process(new DistanceMatrixRequest(array(), array()));

        $this->assertSame(DistanceMatrixStatus::INVALID_REQUEST, $response->getStatus());
        $this->assertEmpty($response->getOrigins());
        $this->assertEmpty($response->getDestinations());
        $this->assertEmpty($response->getRows());
    }

    /**
     * @expectedException \Ivory\HttpAdapter\HttpAdapterException
     * @expectedExceptionMessage An error occurred when fetching the URL
     */
    public function testProcessWithQueryStringTooLong()
    {
        $this->distanceMatrix->process(new DistanceMatrixRequest(
            array('Vancouver BC'.str_repeat('a', 2000)),
            array('San Francisco')
        ));
    }

    /**
     * Gets the request provider.
     *
     * @return array The request provider.
     */
    public function requestProvider()
    {
        $stringRequest = new DistanceMatrixRequest(array('Vancouver BC'), array('San Francisco'));

        $coordinateRequest = new DistanceMatrixRequest(
            array(new Coordinate(49.262428, -123.113136)),
            array(new Coordinate(37.775328, -122.418938))
        );

        $fullRequest = new DistanceMatrixRequest(array('Vancouver BC'), array('San Francisco'));
        $fullRequest->setTravelMode(TravelMode::BICYCLING);
        $fullRequest->setUnitSystem(UnitSystem::METRIC);
        $fullRequest->setRegion('en');
        $fullRequest->setLanguage('fr');

        $avoidTollsRequest = new DistanceMatrixRequest(array('Vancouver BC'), array('San Francisco'));
        $avoidTollsRequest->setAvoidTolls(true);

        $avoidHighwaysRequest = new DistanceMatrixRequest(array('Vancouver BC'), array('San Francisco'));
        $avoidHighwaysRequest->setAvoidHighways(true);

        return array(
            array($stringRequest),
            array($coordinateRequest),
            array($fullRequest),
            array($avoidTollsRequest),
            array($avoidHighwaysRequest),
        );
    }
}
