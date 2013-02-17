<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\Geocoding\Result;

use Ivory\GoogleMap\Services\Geocoding\Result\GeocoderResult;

/**
 * Geocoder result test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderResultTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\Geocoding\Result\GeocoderResult */
    protected $geocoderResult;

    /** @var array */
    protected $addressComponents;

    /** @var string */
    protected $formattedAddress;

    /** @var \Ivory\GoogleMap\Services\Geocoding\Result\GeocoderGeometry */
    protected $geometry;

    /** @var boolean */
    protected $partialMatch;

    /** @var array */
    protected $types;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $addressComponent = $this->getMockBuilder('Ivory\GoogleMap\Services\Geocoding\Result\GeocoderAddressComponent')
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressComponents = array($addressComponent);
        $this->formattedAddress = 'formattedAddress';

        $this->geometry = $this->getMockBuilder('Ivory\GoogleMap\Services\Geocoding\Result\GeocoderGeometry')
            ->disableOriginalConstructor()
            ->getMock();

        $this->partialMatch = true;
        $this->types = array('foo', 'bar');

        $this->geocoderResult = new GeocoderResult(
            $this->addressComponents,
            $this->formattedAddress,
            $this->geometry,
            $this->types,
            $this->partialMatch
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->geocoderResult);
        unset($this->addressComponents);
        unset($this->geometry);
        unset($this->types);
        unset($this->partialMatch);
    }

    public function testInitialState()
    {
        $this->assertSame($this->addressComponents, $this->geocoderResult->getAddressComponents());
        $this->assertSame($this->formattedAddress, $this->geocoderResult->getFormattedAddress());
        $this->assertSame($this->geometry, $this->geocoderResult->getGeometry());
        $this->assertSame($this->types, $this->geocoderResult->getTypes());
        $this->assertSame($this->partialMatch, $this->geocoderResult->isPartialMatch());
    }

    public function testAddressComponentsWithoutType()
    {
        $addressComponent = $this->getMockBuilder('Ivory\GoogleMap\Services\Geocoding\Result\GeocoderAddressComponent')
            ->disableOriginalConstructor()
            ->getMock();

        $addressComponents = array($addressComponent);

        $this->geocoderResult->setAddressComponents($addressComponents);

        $this->assertSame($addressComponents, $this->geocoderResult->getAddressComponents());
    }

    public function testAddressComponentsWithType()
    {
        $addressComponent = $this->getMockBuilder('Ivory\GoogleMap\Services\Geocoding\Result\GeocoderAddressComponent')
            ->disableOriginalConstructor()
            ->getMock();

        $addressComponent
            ->expects($this->any())
            ->method('getTypes')
            ->will($this->returnValue(array('foo')));

        $addressComponents = array($addressComponent);

        $this->geocoderResult->setAddressComponents($addressComponents);

        $this->assertSame($addressComponents, $this->geocoderResult->getAddressComponents('foo'));
        $this->assertEmpty($this->geocoderResult->getAddressComponents('bar'));
    }

    public function testFormattedAddressWithValidValue()
    {
        $this->geocoderResult->setFormattedAddress('formatted_address');

        $this->assertSame('formatted_address', $this->geocoderResult->getFormattedAddress());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder result formatted address must be a string value.
     */
    public function testFormattedAddressWithInvalidValue()
    {
        $this->geocoderResult->setFormattedAddress(true);
    }

    public function testGeometry()
    {
        $geometry = $this->getMockBuilder('Ivory\GoogleMap\Services\Geocoding\Result\GeocoderGeometry')
            ->disableOriginalConstructor()
            ->getMock();

        $this->geocoderResult->setGeometry($geometry);

        $this->assertSame($geometry, $this->geocoderResult->getGeometry());
    }

    public function testPartialMatchWithValidValue()
    {
        $this->geocoderResult->setPartialMatch(false);

        $this->assertFalse($this->geocoderResult->isPartialMatch());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder result partial match flag must be a boolean value.
     */
    public function testPartialMatchWithInvalidValue()
    {
        $this->geocoderResult->setPartialMatch('foo');
    }

    public function testTypeWithValidValue()
    {
        $types = array('type_1', 'type_2');
        $this->geocoderResult->setTypes($types);

        $this->assertSame($types, $this->geocoderResult->getTypes());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder result type must be a string value.
     */
    public function testTypeWithInvalidValue()
    {
        $this->geocoderResult->addType(true);
    }
}
