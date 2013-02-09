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

use Ivory\GoogleMap\Services\Geocoding\Result\GeocoderAddressComponent;

/**
 * Geocoder address component test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderAddressComponentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\Geocoding\Result\GeocoderAddressComponent */
    protected $geocoderAddressComponent;

    /** @var string */
    protected $longName;

    /** @var string */
    protected $shortName;

    /** @var array */
    protected $types;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->longName = 'long_name';
        $this->shortName = 'short_name';
        $this->types = array('foo', 'bar');

        $this->geocoderAddressComponent = new GeocoderAddressComponent(
            $this->longName,
            $this->shortName,
            $this->types
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->geocoderAddressComponent);
        unset($this->longName);
        unset($this->shortName);
        unset($this->types);
    }

    public function testInitialState()
    {
        $this->assertSame($this->longName, $this->geocoderAddressComponent->getLongName());
        $this->assertSame($this->shortName, $this->geocoderAddressComponent->getShortName());
        $this->assertSame($this->types, $this->geocoderAddressComponent->getTypes());
    }

    public function testLongNameWithValidValue()
    {
        $this->geocoderAddressComponent->setLongName('longname');

        $this->assertSame('longname', $this->geocoderAddressComponent->getLongName());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder address component long name must be a string value.
     */
    public function testLongNameWithInvalidValue()
    {
        $this->geocoderAddressComponent->setLongName(true);
    }

    public function testShortNameWithValidValue()
    {
        $this->geocoderAddressComponent->setShortName('shortname');

        $this->assertSame('shortname', $this->geocoderAddressComponent->getShortName());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder address component short name must be a string value.
     */
    public function testShortNameWithInvalidValue()
    {
        $this->geocoderAddressComponent->setShortName(true);
    }

    public function testTypesWithValidValue()
    {
        $types = array('type1', 'type2');
        $this->geocoderAddressComponent->setTypes($types);

        $this->assertSame($types, $this->geocoderAddressComponent->getTypes());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder address component type must be a string value.
     */
    public function testTypesWithInvalidValue()
    {
        $this->geocoderAddressComponent->addType(true);
    }
}
