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

use Ivory\GoogleMap\Service\Geocoder\GeocoderAddressComponent;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderAddressComponentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GeocoderAddressComponent
     */
    private $addressComponent;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->addressComponent = new GeocoderAddressComponent();
    }

    public function testInitialState()
    {
        $this->assertFalse($this->addressComponent->hasLongName());
        $this->assertNull($this->addressComponent->getLongName());
        $this->assertFalse($this->addressComponent->hasShortName());
        $this->assertNull($this->addressComponent->getShortName());
        $this->assertFalse($this->addressComponent->hasTypes());
        $this->assertEmpty($this->addressComponent->getTypes());
    }

    public function testLongName()
    {
        $this->addressComponent->setLongName($longName = 'foo');

        $this->assertTrue($this->addressComponent->hasLongName());
        $this->assertSame($longName, $this->addressComponent->getLongName());
    }

    public function testResetLongName()
    {
        $this->addressComponent->setLongName('foo');
        $this->addressComponent->setLongName(null);

        $this->assertFalse($this->addressComponent->hasLongName());
        $this->assertNull($this->addressComponent->getLongName());
    }

    public function testShortName()
    {
        $this->addressComponent->setShortName($shortName = 'foo');

        $this->assertTrue($this->addressComponent->hasShortName());
        $this->assertSame($shortName, $this->addressComponent->getShortName());
    }

    public function testResetShortName()
    {
        $this->addressComponent->setShortName('foo');
        $this->addressComponent->setShortName(null);

        $this->assertFalse($this->addressComponent->hasShortName());
        $this->assertNull($this->addressComponent->getShortName());
    }

    public function testSetTypes()
    {
        $this->addressComponent->setTypes($types = [$type = 'type']);
        $this->addressComponent->setTypes($types);

        $this->assertTrue($this->addressComponent->hasTypes());
        $this->assertTrue($this->addressComponent->hasType($type));
        $this->assertSame($types, $this->addressComponent->getTypes());
    }

    public function testAddTypes()
    {
        $this->addressComponent->setTypes($firstTypes = ['first_type']);
        $this->addressComponent->addTypes($secondTypes = ['second_type']);

        $this->assertTrue($this->addressComponent->hasTypes());
        $this->assertSame(array_merge($firstTypes, $secondTypes), $this->addressComponent->getTypes());
    }

    public function testAddType()
    {
        $this->addressComponent->addType($type = 'type');

        $this->assertTrue($this->addressComponent->hasTypes());
        $this->assertTrue($this->addressComponent->hasType($type));
        $this->assertSame([$type], $this->addressComponent->getTypes());
    }

    public function testRemoveType()
    {
        $this->addressComponent->addType($type = 'type');
        $this->addressComponent->removeType($type);

        $this->assertFalse($this->addressComponent->hasTypes());
        $this->assertFalse($this->addressComponent->hasType($type));
        $this->assertEmpty($this->addressComponent->getTypes());
    }
}
