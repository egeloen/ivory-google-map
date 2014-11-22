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

use Ivory\GoogleMap\Services\Geocoding\GeocoderResult;

/**
 * Geocoder result test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderResultTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\Geocoding\GeocoderResult */
    private $geocoderResult;

    /** @var array */
    private $addressComponents;

    /** @var string */
    private $formattedAddress;

    /** @var \Ivory\GoogleMap\Services\Geocoding\GeocoderGeometry|\PHPUnit_Framework_MockObject_MockObject */
    private $geometry;

    /** @var boolean */
    private $partialMatch;

    /** @var array */
    private $types;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->geocoderResult = new GeocoderResult(
            $this->addressComponents = array($this->createGeocoderAddressComponentMock()),
            $this->formattedAddress = 'formattedAddress',
            $this->geometry = $this->createGeocoderGeometryMock(),
            $this->types = array('type'),
            $this->partialMatch = true
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
        $this->assertTrue($this->geocoderResult->hasAddressComponents());
        $this->assertSame($this->addressComponents, $this->geocoderResult->getAddressComponents());

        $this->assertSame($this->formattedAddress, $this->geocoderResult->getFormattedAddress());
        $this->assertSame($this->geometry, $this->geocoderResult->getGeometry());

        $this->assertTrue($this->geocoderResult->hasTypes());
        $this->assertSame($this->types, $this->geocoderResult->getTypes());

        $this->assertTrue($this->geocoderResult->hasPartialMatch());
        $this->assertSame($this->partialMatch, $this->geocoderResult->isPartialMatch());
    }

    public function testSetAddressComponents()
    {
        $this->geocoderResult->setAddressComponents($addressComponents = array($this->createGeocoderAddressComponentMock()));

        $this->assertAddressComponents($addressComponents);
    }

    public function testAddAddressComponents()
    {
        $this->geocoderResult->setAddressComponents($addressComponents = array($this->createGeocoderAddressComponentMock()));
        $this->geocoderResult->addAddressComponents($newAddressComponents = array($this->createGeocoderAddressComponentMock()));

        $this->assertAddressComponents(array_merge($addressComponents, $newAddressComponents));
    }

    public function testRemoveAddressComponents()
    {
        $this->geocoderResult->setAddressComponents($addressComponents = array($this->createGeocoderAddressComponentMock()));
        $this->geocoderResult->removeAddressComponents($addressComponents);

        $this->assertNoAddressComponents();
    }

    public function testResetAddressComponents()
    {
        $this->geocoderResult->setAddressComponents(array($this->createGeocoderAddressComponentMock()));
        $this->geocoderResult->resetAddressComponents();

        $this->assertNoAddressComponents();
    }

    public function testAddAddressComponent()
    {
        $this->geocoderResult->addAddressComponent($addressComponent = $this->createGeocoderAddressComponentMock());

        $this->assertAddressComponent($addressComponent);
    }

    public function testAddAddressComponentUnicity()
    {
        $this->geocoderResult->resetAddressComponents();
        $this->geocoderResult->addAddressComponent($addressComponent = $this->createGeocoderAddressComponentMock());
        $this->geocoderResult->addAddressComponent($addressComponent);

        $this->assertAddressComponents(array($addressComponent));
    }

    public function testRemoveAddressComponent()
    {
        $this->geocoderResult->addAddressComponent($addressComponent = $this->createGeocoderAddressComponentMock());
        $this->geocoderResult->removeAddressComponent($addressComponent);

        $this->assertNoAddressComponent($addressComponent);
    }

    public function testSetFormattedAddress()
    {
        $this->geocoderResult->setFormattedAddress($formattedAddress = 'foo');

        $this->assertSame($formattedAddress, $this->geocoderResult->getFormattedAddress());
    }

    public function testSetGeometry()
    {
        $this->geocoderResult->setGeometry($geometry = $this->createGeocoderGeometryMock());

        $this->assertSame($geometry, $this->geocoderResult->getGeometry());
    }

    public function testSetPartialMatch()
    {
        $this->geocoderResult->setPartialMatch(false);

        $this->assertTrue($this->geocoderResult->hasPartialMatch());
        $this->assertFalse($this->geocoderResult->isPartialMatch());
    }

    public function testResetPartialMatch()
    {
        $this->geocoderResult->setPartialMatch(false);
        $this->geocoderResult->setPartialMatch(null);

        $this->assertFalse($this->geocoderResult->hasPartialMatch());
        $this->assertNull($this->geocoderResult->isPartialMatch());
    }

    public function testSetTypes()
    {
        $this->geocoderResult->setTypes($types = array('foo'));

        $this->assertTypes($types);
    }

    public function testAddTypes()
    {
        $this->geocoderResult->setTypes($types = array('foo'));
        $this->geocoderResult->addTypes($newTypes = array('bar'));

        $this->assertTypes(array_merge($types, $newTypes));
    }

    public function testRemoveTypes()
    {
        $this->geocoderResult->setTypes($types = array('foo'));
        $this->geocoderResult->removeTypes($types);

        $this->assertNoTypes();
    }

    public function testResetTypes()
    {
        $this->geocoderResult->setTypes(array('foo'));
        $this->geocoderResult->resetTypes();

        $this->assertNoTypes();
    }

    public function testAddType()
    {
        $this->geocoderResult->addType($type = 'foo');

        $this->assertType($type);
    }

    public function testAddTypeUnicity()
    {
        $this->geocoderResult->resetTypes();
        $this->geocoderResult->addType($type = 'foo');
        $this->geocoderResult->addType($type);

        $this->assertTypes(array($type));
    }

    public function testRemoveType()
    {
        $this->geocoderResult->addType($type = 'foo');
        $this->geocoderResult->removeType($type);

        $this->assertNoType($type);
    }

    /**
     * Asserts there are address components.
     *
     * @param array $addressComponents The address components.
     */
    private function assertAddressComponents($addressComponents)
    {
        $this->assertInternalType('array', $addressComponents);

        $this->assertTrue($this->geocoderResult->hasAddressComponents());
        $this->assertSame($addressComponents, $this->geocoderResult->getAddressComponents());

        foreach ($addressComponents as $addressComponent) {
            $this->assertAddressComponent($addressComponent);
        }
    }

    /**
     * Asserts there is a address component.
     *
     * @param \Ivory\GoogleMap\Services\Geocoding\GeocoderAddressComponent $addressComponent The address component.
     */
    private function assertAddressComponent($addressComponent)
    {
        $this->assertGeocoderAddressComponentInstance($addressComponent);
        $this->assertTrue($this->geocoderResult->hasAddressComponent($addressComponent));
    }

    /**
     * Asserts there are no address components.
     */
    private function assertNoAddressComponents()
    {
        $this->assertFalse($this->geocoderResult->hasAddressComponents());
        $this->assertEmpty($this->geocoderResult->getAddressComponents());
    }

    /**
     * Asserts there is no address component.
     *
     * @param \Ivory\GoogleMap\Services\Geocoding\GeocoderAddressComponent $addressComponent The address component.
     */
    private function assertNoAddressComponent($addressComponent)
    {
        $this->assertGeocoderAddressComponentInstance($addressComponent);
        $this->assertFalse($this->geocoderResult->hasAddressComponent($addressComponent));
    }

    /**
     * Asserts there are types.
     *
     * @param array $types The types.
     */
    private function assertTypes($types)
    {
        $this->assertInternalType('array', $types);

        $this->assertTrue($this->geocoderResult->hasTypes());
        $this->assertSame($types, $this->geocoderResult->getTypes());

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
        $this->assertTrue($this->geocoderResult->hasType($type));
    }

    /**
     * Asserts there are no types.
     */
    private function assertNoTypes()
    {
        $this->assertFalse($this->geocoderResult->hasTypes());
        $this->assertEmpty($this->geocoderResult->getTypes());
    }

    /**
     * Asserts there is no type.
     *
     * @param string $type The type.
     */
    private function assertNoType($type)
    {
        $this->assertFalse($this->geocoderResult->hasType($type));
    }
}
