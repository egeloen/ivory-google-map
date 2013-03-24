<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\Geocoding;

use Ivory\GoogleMap\Services\Geocoding\GeocoderRequest;

/**
 * Geocoder request test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\Geocoding\GeocoderRequest */
    protected $geocoderRequest;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->geocoderRequest = new GeocoderRequest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->geocoderRequest);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->geocoderRequest->hasAddress());
        $this->assertFalse($this->geocoderRequest->hasCoordinate());
        $this->assertFalse($this->geocoderRequest->hasBound());
        $this->assertFalse($this->geocoderRequest->hasRegion());
        $this->assertFalse($this->geocoderRequest->hasLanguage());
        $this->assertFalse($this->geocoderRequest->hasSensor());
    }

    public function testAddressWithValidValue()
    {
        $this->geocoderRequest->setAddress('foo');

        $this->assertTrue($this->geocoderRequest->hasAddress());
        $this->assertSame('foo', $this->geocoderRequest->getAddress());
    }

    public function testAddressWithNullValue()
    {
        $this->geocoderRequest->setAddress('foo');
        $this->geocoderRequest->setAddress(null);

        $this->assertNull($this->geocoderRequest->getAddress());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder request address must be a string value.
     */
    public function testAddressWithInvalidValue()
    {
        $this->geocoderRequest->setAddress(true);
    }

    public function testCoordinateWithCoordinate()
    {
        $coordinate = $this->getMock('Ivory\GoogleMap\Base\Coordinate');

        $this->geocoderRequest->setCoordinate($coordinate);

        $this->assertTrue($this->geocoderRequest->hasCoordinate());
        $this->assertSame($coordinate, $this->geocoderRequest->getCoordinate());
    }

    public function testCoordinateWithLatitudeAndLongitude()
    {
        $this->geocoderRequest->setCoordinate(1.1, -2.1, false);

        $this->assertSame(1.1, $this->geocoderRequest->getCoordinate()->getLatitude());
        $this->assertSame(-2.1, $this->geocoderRequest->getCoordinate()->getLongitude());
        $this->assertFalse($this->geocoderRequest->getCoordinate()->isNoWrap());
    }

    public function testCoordinateWithNullValue()
    {
        $this->geocoderRequest->setCoordinate(1.1, -2.1);
        $this->geocoderRequest->setCoordinate(null);

        $this->assertNull($this->geocoderRequest->getCoordinate());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The coordinate setter arguments is invalid.
     * The available prototypes are :
     * - function setCoordinate(Ivory\GoogleMap\Base\Coordinate $coordinate = null)
     * - function setCoordinate(double $latitude, double $longitude, boolean $noWrap = true)
     */
    public function testCoordinateWithInvalidValue()
    {
        $this->geocoderRequest->setCoordinate('foo');
    }

    public function testBoundWithBound()
    {
        $bound = $this->getMock('Ivory\GoogleMap\Base\Bound');
        $this->geocoderRequest->setBound($bound);

        $this->assertTrue($this->geocoderRequest->hasBound());
        $this->assertSame($bound, $this->geocoderRequest->getBound());
    }

    public function testBoundWithCoordinates()
    {
        $southWest = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $northEast = $this->getMock('Ivory\GoogleMap\Base\Coordinate');

        $this->geocoderRequest->setBound($southWest, $northEast);

        $this->assertSame($southWest, $this->geocoderRequest->getBound()->getSouthWest());
        $this->assertSame($northEast, $this->geocoderRequest->getBound()->getNorthEast());
    }

    public function testBoundWithLatitudesAndLongitudes()
    {
        $this->geocoderRequest->setBound(-2, -2, 2, 2, true, false);

        $this->assertSame(-2, $this->geocoderRequest->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(-2, $this->geocoderRequest->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($this->geocoderRequest->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(2, $this->geocoderRequest->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(2, $this->geocoderRequest->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($this->geocoderRequest->getBound()->getNorthEast()->isNoWrap());
    }

    public function testBoundWithNullValue()
    {
        $this->geocoderRequest->setBound(-2, -2, 2, 2);
        $this->geocoderRequest->setBound(null);

        $this->assertNull($this->geocoderRequest->getBound());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The bound setter arguments are invalid.
     * The available prototypes are :
     * - function setBound(Ivory\GoogleMap\Base\Bound $bound = null)
     * - function setBound(Ivory\GoogleMap\Base\Coordinate $southWest, Ivory\GoogleMap\Base\Coordinate $northEast)
     * - function setBound(
     *     double $southWestLatitude,
     *     double $southWestLongitude,
     *     double $northEastLatitude,
     *     double $northEastLongitude,
     *     boolean southWestNoWrap = true,
     *     boolean $northEastNoWrap = true
     * )
     */
    public function testBoundWithInvalidValue()
    {
        $this->geocoderRequest->setBound('foo');
    }

    public function testRegionWithValidValue()
    {
        $this->geocoderRequest->setRegion('fr');

        $this->assertTrue($this->geocoderRequest->hasRegion());
        $this->assertSame('fr', $this->geocoderRequest->getRegion());
    }

    public function testRegionWithNullValue()
    {
        $this->geocoderRequest->setRegion('fr');
        $this->geocoderRequest->setRegion(null);

        $this->assertNull($this->geocoderRequest->getRegion());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder request region must be a string with two characters.
     */
    public function testRegionWithInvalidValue()
    {
        $this->geocoderRequest->setRegion('foo');
    }

    public function testLanguageWithValidValue()
    {
        $this->geocoderRequest->setLanguage('pl');

        $this->assertTrue($this->geocoderRequest->hasLanguage());
        $this->assertSame('pl', $this->geocoderRequest->getLanguage());
    }

    public function testLanguageWithNullValue()
    {
        $this->geocoderRequest->setLanguage('pl');
        $this->geocoderRequest->setLanguage(null);

        $this->assertNull($this->geocoderRequest->getLanguage());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder request language must be a string with two characters.
     */
    public function testLanguageWithInvalidValue()
    {
        $this->geocoderRequest->setLanguage('foo');
    }

    public function testSensorWithValidValue()
    {
        $this->geocoderRequest->setSensor(true);

        $this->assertTrue($this->geocoderRequest->hasSensor());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder request sensor flag must be a boolean value.
     */
    public function testSensorWithInvalidValue()
    {
        $this->geocoderRequest->setSensor('foo');
    }

    public function testIsValidWithoutAddressAndCoordinate()
    {
        $this->assertFalse($this->geocoderRequest->isValid());
    }

    public function testIsValidWithAddress()
    {
        $this->geocoderRequest->setAddress('address');

        $this->assertTrue($this->geocoderRequest->isValid());
    }

    public function testIsValidWithCoordinate()
    {
        $this->geocoderRequest->setCoordinate(1, 1);

        $this->assertTrue($this->geocoderRequest->isValid());
    }
}
