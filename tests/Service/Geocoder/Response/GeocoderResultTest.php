<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Geocoder\Response;

use Ivory\GoogleMap\Service\Geocoder\Response\GeocoderAddress;
use Ivory\GoogleMap\Service\Geocoder\Response\GeocoderGeometry;
use Ivory\GoogleMap\Service\Geocoder\Response\GeocoderResult;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GeocoderResult
     */
    private $result;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->result = new GeocoderResult();
    }

    public function testInitialState()
    {
        $this->assertFalse($this->result->hasPlaceId());
        $this->assertNull($this->result->getPlaceId());
        $this->assertFalse($this->result->hasAddresses());
        $this->assertEmpty($this->result->getAddresses());
        $this->assertFalse($this->result->hasFormattedAddress());
        $this->assertNull($this->result->getFormattedAddress());
        $this->assertFalse($this->result->hasPostcodeLocalities());
        $this->assertEmpty($this->result->getPostcodeLocalities());
        $this->assertFalse($this->result->hasGeometry());
        $this->assertNull($this->result->getGeometry());
        $this->assertFalse($this->result->hasTypes());
        $this->assertEmpty($this->result->getTypes());
        $this->assertFalse($this->result->hasPartialMatch());
        $this->assertNull($this->result->isPartialMatch());
    }

    public function testPlaceId()
    {
        $this->result->setPlaceId($placeId = 'id');

        $this->assertTrue($this->result->hasPlaceId());
        $this->assertSame($placeId, $this->result->getPlaceId());
    }

    public function testSetAddresses()
    {
        $this->result->setAddresses($addresses = [$address = $this->createAddressMock()]);
        $this->result->setAddresses($addresses);

        $this->assertTrue($this->result->hasAddresses());
        $this->assertTrue($this->result->hasAddress($address));
        $this->assertSame($addresses, $this->result->getAddresses());
    }

    public function testAddAddresses()
    {
        $this->result->setAddresses($firstAddresses = [$this->createAddressMock()]);
        $this->result->addAddresses($secondAddresses = [$this->createAddressMock()]);

        $this->assertTrue($this->result->hasAddresses());
        $this->assertSame(array_merge($firstAddresses, $secondAddresses), $this->result->getAddresses());
    }

    public function testAddAddress()
    {
        $this->result->addAddress($address = $this->createAddressMock());

        $this->assertTrue($this->result->hasAddresses());
        $this->assertTrue($this->result->hasAddress($address));
        $this->assertSame([$address], $this->result->getAddresses());
    }

    public function testRemoveAddress()
    {
        $this->result->addAddress($address = $this->createAddressMock());
        $this->result->removeAddress($address);

        $this->assertFalse($this->result->hasAddresses());
        $this->assertFalse($this->result->hasAddress($address));
        $this->assertEmpty($this->result->getAddresses());
    }

    public function testTypedAddresses()
    {
        $address = $this->createAddressMock();
        $address
            ->expects($this->exactly(4))
            ->method('getTypes')
            ->will($this->returnValue([$type = 'foo']));

        $this->result->setAddresses($addresses = [$address]);

        $this->assertTrue($this->result->hasAddresses($type));
        $this->assertSame($addresses, $this->result->getAddresses($type));
        $this->assertFalse($this->result->hasAddresses('bar'));
        $this->assertEmpty($this->result->getAddresses('bar'));
    }

    public function testFormattedAddress()
    {
        $this->result->setFormattedAddress($formattedAddress = 'foo');

        $this->assertTrue($this->result->hasFormattedAddress());
        $this->assertSame($formattedAddress, $this->result->getFormattedAddress());
    }

    public function testResetFormattedAddress()
    {
        $this->result->setFormattedAddress('foo');
        $this->result->setFormattedAddress(null);

        $this->assertFalse($this->result->hasFormattedAddress());
        $this->assertNull($this->result->getFormattedAddress());
    }

    public function testSetPostcodeLocalities()
    {
        $this->result->setPostcodeLocalities($postcodeLocalities = [$postcodeLocality = '59800']);
        $this->result->setPostcodeLocalities($postcodeLocalities);

        $this->assertTrue($this->result->hasPostcodeLocalities());
        $this->assertTrue($this->result->hasPostcodeLocality($postcodeLocality));
        $this->assertSame($postcodeLocalities, $this->result->getPostcodeLocalities());
    }

    public function testAddPostcodeLocalities()
    {
        $this->result->setPostcodeLocalities($firstPostcodeLocalities = ['59800']);
        $this->result->addPostcodeLocalities($secondPostcodeLocalities = ['62000']);

        $this->assertTrue($this->result->hasPostcodeLocalities());
        $this->assertSame(array_merge($firstPostcodeLocalities, $secondPostcodeLocalities), $this->result->getPostcodeLocalities());
    }

    public function testAddPostcodeLocality()
    {
        $this->result->addPostcodeLocality($postcodeLocality = '59800');

        $this->assertTrue($this->result->hasPostcodeLocalities());
        $this->assertTrue($this->result->hasPostcodeLocality($postcodeLocality));
        $this->assertSame([$postcodeLocality], $this->result->getPostcodeLocalities());
    }

    public function testRemovePostcodeLocality()
    {
        $this->result->addPostcodeLocality($postcodeLocality = '59800');
        $this->result->removePostcodeLocality($postcodeLocality);

        $this->assertFalse($this->result->hasPostcodeLocalities());
        $this->assertFalse($this->result->hasPostcodeLocality($postcodeLocality));
        $this->assertEmpty($this->result->getPostcodeLocalities());
    }

    public function testGeometry()
    {
        $this->result->setGeometry($geometry = $this->createGeometryMock());

        $this->assertTrue($this->result->hasGeometry());
        $this->assertSame($geometry, $this->result->getGeometry());
    }

    public function testResetGeometry()
    {
        $this->result->setGeometry($this->createGeometryMock());
        $this->result->setGeometry(null);

        $this->assertFalse($this->result->hasGeometry());
        $this->assertNull($this->result->getGeometry());
    }

    public function testPartialMatch()
    {
        $this->result->setPartialMatch(true);

        $this->assertTrue($this->result->hasPartialMatch());
        $this->assertTrue($this->result->isPartialMatch());
    }

    public function testResetPartialMatch()
    {
        $this->result->setPartialMatch(true);
        $this->result->setPartialMatch(null);

        $this->assertFalse($this->result->hasPartialMatch());
        $this->assertNull($this->result->isPartialMatch());
    }

    public function testSetTypes()
    {
        $this->result->setTypes($types = [$type = 'foo']);
        $this->result->setTypes($types);

        $this->assertTrue($this->result->hasTypes());
        $this->assertTrue($this->result->hasType($type));
        $this->assertSame($types, $this->result->getTypes());
    }

    public function testAddTypes()
    {
        $this->result->setTypes($firstTypes = ['foo']);
        $this->result->addTypes($secondTypes = ['bar']);

        $this->assertTrue($this->result->hasTypes());
        $this->assertSame(array_merge($firstTypes, $secondTypes), $this->result->getTypes());
    }

    public function testAddType()
    {
        $this->result->addType($type = 'foo');

        $this->assertTrue($this->result->hasTypes());
        $this->assertTrue($this->result->hasType($type));
        $this->assertSame([$type], $this->result->getTypes());
    }

    public function testRemoveType()
    {
        $this->result->addType($type = 'foo');
        $this->result->removeType($type);

        $this->assertFalse($this->result->hasTypes());
        $this->assertFalse($this->result->hasType($type));
        $this->assertEmpty($this->result->getTypes());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|GeocoderAddress
     */
    private function createAddressMock()
    {
        return $this->createMock(GeocoderAddress::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|GeocoderGeometry
     */
    private function createGeometryMock()
    {
        return $this->createMock(GeocoderGeometry::class);
    }
}
