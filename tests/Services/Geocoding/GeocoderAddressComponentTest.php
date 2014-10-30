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

use Ivory\GoogleMap\Services\Geocoding\GeocoderAddressComponent;

/**
 * Geocoder address component test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderAddressComponentTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\Geocoding\GeocoderAddressComponent */
    private $geocoderAddressComponent;

    /** @var string */
    private $longName;

    /** @var string */
    private $shortName;

    /** @var array */
    private $types;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->geocoderAddressComponent = new GeocoderAddressComponent(
            $this->longName = 'long_name',
            $this->shortName = 'short_name',
            $this->types = array('type')
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

    public function testSetLongName()
    {
        $this->geocoderAddressComponent->setLongName($longName = 'foo');

        $this->assertSame($longName, $this->geocoderAddressComponent->getLongName());
    }

    public function testSetShortName()
    {
        $this->geocoderAddressComponent->setShortName($shortName = 'foo');

        $this->assertSame($shortName, $this->geocoderAddressComponent->getShortName());
    }

    public function testSetTypes()
    {
        $this->geocoderAddressComponent->setTypes($types = array('foo'));

        $this->assertTypes($types);
    }

    public function testAddTypes()
    {
        $this->geocoderAddressComponent->setTypes($types = array('foo'));
        $this->geocoderAddressComponent->addTypes($newTypes = array('bar'));

        $this->assertTypes(array_merge($types, $newTypes));
    }

    public function testRemoveTypes()
    {
        $this->geocoderAddressComponent->setTypes($types = array('foo'));
        $this->geocoderAddressComponent->removeTypes($types);

        $this->assertNoTypes();
    }

    public function testResetTypes()
    {
        $this->geocoderAddressComponent->setTypes(array('foo'));
        $this->geocoderAddressComponent->resetTypes();

        $this->assertNoTypes();
    }

    public function testAddType()
    {
        $this->geocoderAddressComponent->addType($type = 'foo');

        $this->assertType($type);
    }

    public function testAddTypeUnicity()
    {
        $this->geocoderAddressComponent->resetTypes();
        $this->geocoderAddressComponent->addType($type = 'foo');
        $this->geocoderAddressComponent->addType($type);

        $this->assertTypes(array($type));
    }

    public function testRemoveType()
    {
        $this->geocoderAddressComponent->addType($type = 'foo');
        $this->geocoderAddressComponent->removeType($type);

        $this->assertNoType($type);
    }

    /**
     * Asserts there are types.
     *
     * @param array $types The types.
     */
    private function assertTypes($types)
    {
        $this->assertInternalType('array', $types);

        $this->assertTrue($this->geocoderAddressComponent->hasTypes());
        $this->assertSame($types, $this->geocoderAddressComponent->getTypes());

        foreach ($types as $type) {
            $this->assertType($type);
        }
    }

    /**
     * Asserts there is a type.
     *
     * @param string $type The type.
     */
    private function assertType($type)
    {
        $this->assertTrue($this->geocoderAddressComponent->hasType($type));
    }

    /**
     * Asserts there are no types.
     */
    private function assertNoTypes()
    {
        $this->assertFalse($this->geocoderAddressComponent->hasTypes());
        $this->assertEmpty($this->geocoderAddressComponent->getTypes());
    }

    /**
     * Asserts there is no type.
     *
     * @param string $type The type.
     */
    private function assertNoType($type)
    {
        $this->assertFalse($this->geocoderAddressComponent->hasType($type));
    }
}
