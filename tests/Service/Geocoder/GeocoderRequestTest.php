<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Geocoder;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Geocoder\GeocoderRequest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GeocoderRequest
     */
    private $request;

    /**
     * @var string
     */
    private $address;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new GeocoderRequest($this->address = 'Lille');
    }

    public function testDefaultState()
    {
        $this->assertSame($this->address, $this->request->getAddress());
        $this->assertFalse($this->request->hasBound());
        $this->assertNull($this->request->getBound());
        $this->assertFalse($this->request->hasRegion());
        $this->assertNull($this->request->getRegion());
        $this->assertFalse($this->request->hasLanguage());
        $this->assertNull($this->request->getLanguage());
    }

    /**
     * @param Coordinate|string $address
     *
     * @dataProvider addressProvider
     */
    public function testAddress($address)
    {
        $this->request->setAddress($address);

        $this->assertSame($address, $this->request->getAddress());
    }

    public function testBound()
    {
        $this->request->setBound($bound = $this->createBoundMock());

        $this->assertTrue($this->request->hasBound());
        $this->assertSame($bound, $this->request->getBound());
    }

    public function testResetBound()
    {
        $this->request->setBound($this->createBoundMock());
        $this->request->setBound(null);

        $this->assertFalse($this->request->hasBound());
        $this->assertNull($this->request->getBound());
    }

    public function testRegion()
    {
        $this->request->setRegion($region = 'fr');

        $this->assertTrue($this->request->hasRegion());
        $this->assertSame($region, $this->request->getRegion());
    }

    public function testResetRegion()
    {
        $this->request->setRegion('fr');
        $this->request->setRegion(null);

        $this->assertFalse($this->request->hasRegion());
        $this->assertNull($this->request->getRegion());
    }

    public function testLanguage()
    {
        $this->request->setLanguage($language = 'pl');

        $this->assertTrue($this->request->hasLanguage());
        $this->assertSame($language, $this->request->getLanguage());
    }

    public function testResetLanguage()
    {
        $this->request->setLanguage('pl');
        $this->request->setLanguage(null);

        $this->assertFalse($this->request->hasLanguage());
        $this->assertNull($this->request->getLanguage());
    }

    public function testQuery()
    {
        $this->assertSame(['address' => $this->address], $this->request->buildQuery());
    }

    public function testQueryWithCoordinate()
    {
        $address = $this->createCoordinateMock();
        $address
            ->expects($this->once())
            ->method('getLatitude')
            ->will($this->returnValue($latitude = 1.2));

        $address
            ->expects($this->once())
            ->method('getLongitude')
            ->will($this->returnValue($longitude = 2.3));

        $this->request->setAddress($address);

        $this->assertSame(['latlng' => $latitude.','.$longitude], $this->request->buildQuery());
    }

    public function testQueryWithBound()
    {
        $bound = $this->createBoundMock();
        $bound
            ->expects($this->once())
            ->method('getSouthWest')
            ->will($this->returnValue($southWest = $this->createCoordinateMock()));

        $southWest
            ->expects($this->once())
            ->method('getLatitude')
            ->will($this->returnValue($southWestLatitude = 1.2));

        $southWest
            ->expects($this->once())
            ->method('getLongitude')
            ->will($this->returnValue($southWestLongitude = 2.3));

        $bound
            ->expects($this->once())
            ->method('getNorthEast')
            ->will($this->returnValue($northEast = $this->createCoordinateMock()));

        $northEast
            ->expects($this->once())
            ->method('getLatitude')
            ->will($this->returnValue($northEastLatitude = 3.4));

        $northEast
            ->expects($this->once())
            ->method('getLongitude')
            ->will($this->returnValue($northEastLongitude = 4.5));

        $this->request->setBound($bound);

        $this->assertSame([
            'address' => $this->address,
            'bound'   => $southWestLatitude.','.$southWestLongitude.'|'.$northEastLatitude.','.$northEastLongitude,
        ], $this->request->buildQuery());
    }

    public function testQueryWithRegion()
    {
        $this->request->setRegion($region = 'fr');

        $this->assertSame([
            'address' => $this->address,
            'region'  => 'fr',
        ], $this->request->buildQuery());
    }

    public function testQueryWithLanguage()
    {
        $this->request->setLanguage($language = 'fr');

        $this->assertSame([
            'address'  => $this->address,
            'language' => 'fr',
        ], $this->request->buildQuery());
    }

    /**
     * @return mixed[][]
     */
    public function addressProvider()
    {
        return [
            ['Lille'],
            [$this->createCoordinateMock()],
        ];
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        return $this->createMock(Coordinate::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Bound
     */
    private function createBoundMock()
    {
        return $this->createMock(Bound::class);
    }
}
