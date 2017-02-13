<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Base;

use Ivory\GoogleMap\Service\Base\AddressComponent;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AddressComponentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AddressComponent
     */
    private $address;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->address = new AddressComponent();
    }

    public function testInitialState()
    {
        $this->assertFalse($this->address->hasLongName());
        $this->assertNull($this->address->getLongName());
        $this->assertFalse($this->address->hasShortName());
        $this->assertNull($this->address->getShortName());
        $this->assertFalse($this->address->hasTypes());
        $this->assertEmpty($this->address->getTypes());
    }

    public function testLongName()
    {
        $this->address->setLongName($longName = 'foo');

        $this->assertTrue($this->address->hasLongName());
        $this->assertSame($longName, $this->address->getLongName());
    }

    public function testResetLongName()
    {
        $this->address->setLongName('foo');
        $this->address->setLongName(null);

        $this->assertFalse($this->address->hasLongName());
        $this->assertNull($this->address->getLongName());
    }

    public function testShortName()
    {
        $this->address->setShortName($shortName = 'foo');

        $this->assertTrue($this->address->hasShortName());
        $this->assertSame($shortName, $this->address->getShortName());
    }

    public function testResetShortName()
    {
        $this->address->setShortName('foo');
        $this->address->setShortName(null);

        $this->assertFalse($this->address->hasShortName());
        $this->assertNull($this->address->getShortName());
    }

    public function testSetTypes()
    {
        $this->address->setTypes($types = [$type = 'type']);
        $this->address->setTypes($types);

        $this->assertTrue($this->address->hasTypes());
        $this->assertTrue($this->address->hasType($type));
        $this->assertSame($types, $this->address->getTypes());
    }

    public function testAddTypes()
    {
        $this->address->setTypes($firstTypes = ['first_type']);
        $this->address->addTypes($secondTypes = ['second_type']);

        $this->assertTrue($this->address->hasTypes());
        $this->assertSame(array_merge($firstTypes, $secondTypes), $this->address->getTypes());
    }

    public function testAddType()
    {
        $this->address->addType($type = 'type');

        $this->assertTrue($this->address->hasTypes());
        $this->assertTrue($this->address->hasType($type));
        $this->assertSame([$type], $this->address->getTypes());
    }

    public function testRemoveType()
    {
        $this->address->addType($type = 'type');
        $this->address->removeType($type);

        $this->assertFalse($this->address->hasTypes());
        $this->assertFalse($this->address->hasType($type));
        $this->assertEmpty($this->address->getTypes());
    }
}
