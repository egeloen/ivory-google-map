<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Geocoder\Request;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Geocoder\Request\AbstractGeocoderRequest;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderAddressRequest;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderComponentType;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderAddressRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GeocoderAddressRequest
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
        $this->request = new GeocoderAddressRequest($this->address = 'Lille');
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractGeocoderRequest::class, $this->request);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->address, $this->request->getAddress());
        $this->assertFalse($this->request->hasComponents());
        $this->assertEmpty($this->request->getComponents());
        $this->assertFalse($this->request->hasBound());
        $this->assertNull($this->request->getBound());
        $this->assertFalse($this->request->hasRegion());
        $this->assertNull($this->request->getRegion());
    }

    public function testAddress()
    {
        $this->request->setAddress($address = 'address');

        $this->assertSame($address, $this->request->getAddress());
    }

    public function testSetComponents()
    {
        $components = [$type = GeocoderComponentType::COUNTRY => $value = 'fr'];

        $this->request->setComponents($components);
        $this->request->setComponents($components);

        $this->assertTrue($this->request->hasComponents());
        $this->assertTrue($this->request->hasComponent($type));
        $this->assertSame($components, $this->request->getComponents());
        $this->assertSame($value, $this->request->getComponent($type));
    }

    public function testAddComponent()
    {
        $this->request->setComponents($firstComponents = [GeocoderComponentType::COUNTRY => 'fr']);
        $this->request->addComponents($secondComponents = [GeocoderComponentType::COUNTRY => 'en']);

        $this->assertTrue($this->request->hasComponents());
        $this->assertSame(
            array_merge($firstComponents, $secondComponents),
            $this->request->getComponents()
        );
    }

    public function testSetComponent()
    {
        $this->request->setComponent($type = GeocoderComponentType::COUNTRY, $value = 'fr');

        $this->assertTrue($this->request->hasComponents());
        $this->assertTrue($this->request->hasComponent($type));
        $this->assertSame([$type => $value], $this->request->getComponents());
        $this->assertSame($value, $this->request->getComponent($type));
    }

    public function testRemoveComponent()
    {
        $this->request->setComponent($type = GeocoderComponentType::COUNTRY, 'fr');
        $this->request->removeComponent($type);

        $this->assertFalse($this->request->hasComponents());
        $this->assertFalse($this->request->hasComponent($type));
        $this->assertEmpty($this->request->getComponents());
        $this->assertNull($this->request->getComponent($type));
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

    public function testBuildQuery()
    {
        $this->assertSame(['address' => $this->address], $this->request->buildQuery());
    }

    public function testBuildQueryWithComponents()
    {
        $this->request->setComponents([
            GeocoderComponentType::COUNTRY     => 'fr',
            GeocoderComponentType::POSTAL_CODE => '59800',
        ]);

        $this->assertSame([
            'address'    => $this->address,
            'components' => 'country:fr|postal_code:59800',
        ], $this->request->buildQuery());
    }

    public function testBuildQueryWithBound()
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

    public function testBuildQueryWithRegion()
    {
        $this->request->setRegion($region = 'fr');

        $this->assertSame([
            'address' => $this->address,
            'region'  => 'fr',
        ], $this->request->buildQuery());
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
