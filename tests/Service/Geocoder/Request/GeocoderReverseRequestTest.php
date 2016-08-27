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

use Ivory\GoogleMap\Service\Geocoder\GeocoderLocationType;
use Ivory\GoogleMap\Service\Geocoder\Request\AbstractGeocoderRequest;
use Ivory\GoogleMap\Service\Geocoder\Request\AbstractGeocoderReverseRequest;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderAddressType;
use Ivory\GoogleMap\Service\RequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderReverseRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractGeocoderReverseRequest|\PHPUnit_Framework_MockObject_MockObject
     */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = $this->createAbstractReverseRequestMock();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractGeocoderRequest::class, $this->request);
        $this->assertInstanceOf(RequestInterface::class, $this->request);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->request->hasResultTypes());
        $this->assertEmpty($this->request->getResultTypes());
        $this->assertFalse($this->request->hasLocationTypes());
        $this->assertEmpty($this->request->getLocationTypes());
    }

    public function testSetResultTypes()
    {
        $this->request->setResultTypes($resultTypes = [$resultType = GeocoderAddressType::AIRPORT]);
        $this->request->setResultTypes($resultTypes);

        $this->assertTrue($this->request->hasResultTypes());
        $this->assertTrue($this->request->hasResultType($resultType));
        $this->assertSame($resultTypes, $this->request->getResultTypes());
    }

    public function testAddResultTypes()
    {
        $this->request->setResultTypes($firstResultTypes = [GeocoderAddressType::AIRPORT]);
        $this->request->addResultTypes($secondResultTypes = [GeocoderAddressType::PARKING]);

        $this->assertTrue($this->request->hasResultTypes());
        $this->assertSame(
            array_merge($firstResultTypes, $secondResultTypes),
            $this->request->getResultTypes()
        );
    }

    public function testAddResultType()
    {
        $this->request->addResultType($resultType = GeocoderAddressType::AIRPORT);

        $this->assertTrue($this->request->hasResultTypes());
        $this->assertTrue($this->request->hasResultType($resultType));
        $this->assertSame([$resultType], $this->request->getResultTypes());
    }

    public function testRemoveResultType()
    {
        $this->request->addResultType($resultType = GeocoderAddressType::AIRPORT);
        $this->request->removeResultType($resultType);

        $this->assertFalse($this->request->hasResultTypes());
        $this->assertFalse($this->request->hasResultType($resultType));
        $this->assertEmpty($this->request->getResultTypes());
    }

    public function testSetLocationTypes()
    {
        $locationTypes = [$locationType = GeocoderLocationType::APPROXIMATE];

        $this->request->setLocationTypes($locationTypes);
        $this->request->setLocationTypes($locationTypes);

        $this->assertTrue($this->request->hasLocationTypes());
        $this->assertTrue($this->request->hasLocationType($locationType));
        $this->assertSame($locationTypes, $this->request->getLocationTypes());
    }

    public function testAddLocationTypes()
    {
        $this->request->setLocationTypes($firstLocationTypes = [GeocoderLocationType::APPROXIMATE]);
        $this->request->addLocationTypes($secondLocationTypes = [GeocoderLocationType::GEOMETRIC_CENTER]);

        $this->assertTrue($this->request->hasLocationTypes());
        $this->assertSame(
            array_merge($firstLocationTypes, $secondLocationTypes),
            $this->request->getLocationTypes()
        );
    }

    public function testAddLocationType()
    {
        $this->request->addLocationType($locationType = GeocoderLocationType::APPROXIMATE);

        $this->assertTrue($this->request->hasLocationTypes());
        $this->assertTrue($this->request->hasLocationType($locationType));
        $this->assertSame([$locationType], $this->request->getLocationTypes());
    }

    public function testRemoveLocationType()
    {
        $this->request->addLocationType($locationType = GeocoderLocationType::APPROXIMATE);
        $this->request->removeLocationType($locationType);

        $this->assertFalse($this->request->hasLocationTypes());
        $this->assertFalse($this->request->hasLocationType($locationType));
        $this->assertEmpty($this->request->getLocationTypes());
    }

    public function testBuildQuery()
    {
        $this->assertEmpty($this->request->buildQuery());
    }

    public function testBuildQueryWithResultType()
    {
        $this->request->setResultTypes($resultTypes = [GeocoderAddressType::AIRPORT, GeocoderAddressType::PARK]);

        $this->assertSame(['result_type' => implode('|', $resultTypes)], $this->request->buildQuery());
    }

    public function testBuildQueryWithLocationType()
    {
        $locationTypes = [GeocoderLocationType::APPROXIMATE, GeocoderLocationType::GEOMETRIC_CENTER];
        $this->request->setLocationTypes($locationTypes);

        $this->assertSame(['location_type' => implode('|', $locationTypes)], $this->request->buildQuery());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|AbstractGeocoderReverseRequest
     */
    private function createAbstractReverseRequestMock()
    {
        return $this->getMockForAbstractClass(AbstractGeocoderReverseRequest::class);
    }
}
