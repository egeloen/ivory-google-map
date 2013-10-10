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
use Widop\HttpAdapter\CurlHttpAdapter;

/**
 * Distance matrix test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrix */
    protected $service;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->service = new DistanceMatrix(new CurlHttpAdapter());
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->service);
    }

    public function testProcessWithOriginAndDestinationStrings()
    {
        $response = $this->service->process(array('Vancouver BC'), array('San Francisco'));

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertCount(1, $response->getOrigins());
        $this->assertCount(1, $response->getDestinations());

        $rows = $response->getRows();
        $this->assertCount(1, $rows);

        $elements = $rows[0]->getElements();
        $this->assertCount(1, $elements);
        $this->assertSame(DistanceMatrixElementStatus::OK, $elements[0]->getStatus());
    }

    public function testProcessWithOriginAndDestinationCoordinates()
    {
        $vancouver = new Coordinate(49.262428, -123.113136);
        $sanFrancisco = new Coordinate(37.775328, -122.418938);

        $response = $this->service->process(array($vancouver), array($sanFrancisco));

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertCount(1, $response->getOrigins());
        $this->assertCount(1, $response->getDestinations());

        $rows = $response->getRows();
        $this->assertCount(1, $rows);

        $elements = $rows[0]->getElements();
        $this->assertCount(1, $elements);
        $this->assertSame(DistanceMatrixElementStatus::OK, $elements[0]->getStatus());
    }

    public function testProcessWithMinimalDistanceMatrixRequest()
    {
        $request = new DistanceMatrixRequest();
        $request->addOrigin('Vancouver BC');
        $request->addDestination('San Francisco');

        $response = $this->service->process($request);
        $this->assertCount(1, $response->getOrigins());
        $this->assertCount(1, $response->getDestinations());

        $rows = $response->getRows();
        $this->assertCount(1, $rows);

        $elements = $rows[0]->getElements();
        $this->assertCount(1, $elements);
        $this->assertSame(DistanceMatrixElementStatus::OK, $elements[0]->getStatus());
    }

    public function testProcessWithDistanceMatrixRequest()
    {
        $request = new DistanceMatrixRequest();
        $request->addOrigin('Vancouver BC');
        $request->addDestination('San Francisco');
        $request->setTravelMode(TravelMode::BICYCLING);
        $request->setUnitSystem(UnitSystem::METRIC);
        $request->setRegion('en');
        $request->setLanguage('fr');

        $response = $this->service->process($request);
        $this->assertCount(1, $response->getOrigins());
        $this->assertCount(1, $response->getDestinations());

        $rows = $response->getRows();
        $this->assertCount(1, $rows);

        $elements = $rows[0]->getElements();
        $this->assertCount(1, $elements);
        $this->assertSame(DistanceMatrixElementStatus::OK, $elements[0]->getStatus());
    }

    public function testProcessWithDistanceMatrixRequestAndAvoidTolls()
    {
        $request = new DistanceMatrixRequest();
        $request->addOrigin('Vancouver BC');
        $request->addDestination('San Francisco');
        $request->setAvoidTolls(true);

        $response = $this->service->process($request);
        $this->assertCount(1, $response->getOrigins());
        $this->assertCount(1, $response->getDestinations());

        $rows = $response->getRows();
        $this->assertCount(1, $rows);

        $elements = $rows[0]->getElements();
        $this->assertCount(1, $elements);
        $this->assertSame(DistanceMatrixElementStatus::OK, $elements[0]->getStatus());
    }

    public function testProcessWithDistanceMatrixRequestAndAvoidHighways()
    {
        $request = new DistanceMatrixRequest();
        $request->addOrigin('Vancouver BC');
        $request->addDestination('San Francisco');
        $request->setAvoidHighways(true);

        $response = $this->service->process($request);
        $this->assertCount(1, $response->getOrigins());
        $this->assertCount(1, $response->getDestinations());

        $rows = $response->getRows();
        $this->assertCount(1, $rows);

        $elements = $rows[0]->getElements();
        $this->assertCount(1, $elements);
        $this->assertSame(DistanceMatrixElementStatus::OK, $elements[0]->getStatus());
    }

    public function testProcessWithXmlFormat()
    {
        $this->service->setFormat('xml');
        $response = $this->service->process(array('Vancouver BC'), array('San Francisco'));

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertCount(1, $response->getOrigins());
        $this->assertCount(1, $response->getDestinations());

        $rows = $response->getRows();
        $this->assertCount(1, $rows);

        $elements = $rows[0]->getElements();
        $this->assertCount(1, $elements);
        $this->assertSame(DistanceMatrixElementStatus::OK, $elements[0]->getStatus());
    }

    public function testSignUrlWithoutBusinessAccount()
    {
        $method = new \ReflectionMethod($this->service, 'signUrl');
        $method->setAccessible(true);

        $url = 'http://maps.googleapis.com/maps/api/staticmap?center=%E4%B8%8A%E6%B5%B7+%E4%B8%AD%E5%9C%8B&size=640x640&zoom=10&sensor=false';

        $this->assertSame($url, $method->invoke($this->service, $url));
    }

    public function testSignUrlWithBusinessAccount()
    {
        $url = 'http://maps.googleapis.com/maps/api/staticmap?center=%E4%B8%8A%E6%B5%B7+%E4%B8%AD%E5%9C%8B&size=640x640&zoom=10&sensor=false';

        $businessAccount = $this->getMockBuilder('Ivory\GoogleMap\Services\BusinessAccount')
            ->disableOriginalConstructor()
            ->getMock();

        $businessAccount
            ->expects($this->once())
            ->method('signUrl')
            ->with($this->equalTo($url))
            ->will($this->returnValue('url'));

        $this->service->setBusinessAccount($businessAccount);

        $method = new \ReflectionMethod($this->service, 'signUrl');
        $method->setAccessible(true);

        $this->assertSame('url', $method->invoke($this->service, $url));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DistanceMatrixException
     * @expectedExceptionMessage The process arguments are invalid.
     * The available prototypes are:
     * - function route(array $origins, array $destinations)
     * - function route(Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest $request)
     */
    public function testProcessWithInvalidRequestParameters()
    {
        $this->service->process(true);
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DistanceMatrixException
     * @expectedExceptionMessage The directions request is not valid. It needs at least one origin and one destination.
     */
    public function testProcessWithInvalidRequest()
    {
        $this->service->process(new DistanceMatrixRequest());
    }
}
