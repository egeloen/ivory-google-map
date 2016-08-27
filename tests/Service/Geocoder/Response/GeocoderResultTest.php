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

use Ivory\GoogleMap\Service\Base\AddressComponent;
use Ivory\GoogleMap\Service\Base\Geometry;
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
        $this->assertFalse($this->result->hasAddressComponents());
        $this->assertEmpty($this->result->getAddressComponents());
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

    public function testSetAddressComponents()
    {
        $addressComponents = [$addressComponent = $this->createAddressComponentMock()];

        $this->result->setAddressComponents($addressComponents);
        $this->result->setAddressComponents($addressComponents);

        $this->assertTrue($this->result->hasAddressComponents());
        $this->assertTrue($this->result->hasAddressComponent($addressComponent));
        $this->assertSame($addressComponents, $this->result->getAddressComponents());
    }

    public function testAddAddressComponents()
    {
        $this->result->setAddressComponents($firstAddressComponents = [$this->createAddressComponentMock()]);
        $this->result->addAddressComponents($secondAddressComponents = [$this->createAddressComponentMock()]);

        $this->assertTrue($this->result->hasAddressComponents());
        $this->assertSame(
            array_merge($firstAddressComponents, $secondAddressComponents),
            $this->result->getAddressComponents()
        );
    }

    public function testAddAddressComponent()
    {
        $this->result->addAddressComponent($addressComponent = $this->createAddressComponentMock());

        $this->assertTrue($this->result->hasAddressComponents());
        $this->assertTrue($this->result->hasAddressComponent($addressComponent));
        $this->assertSame([$addressComponent], $this->result->getAddressComponents());
    }

    public function testRemoveAddressComponent()
    {
        $this->result->addAddressComponent($addressComponent = $this->createAddressComponentMock());
        $this->result->removeAddressComponent($addressComponent);

        $this->assertFalse($this->result->hasAddressComponents());
        $this->assertFalse($this->result->hasAddressComponent($addressComponent));
        $this->assertEmpty($this->result->getAddressComponents());
    }

    public function testTypedAddressComponents()
    {
        $addressComponent = $this->createAddressComponentMock();
        $addressComponent
            ->expects($this->exactly(4))
            ->method('getTypes')
            ->will($this->returnValue([$type = 'foo']));

        $this->result->setAddressComponents($addressComponents = [$addressComponent]);

        $this->assertTrue($this->result->hasAddressComponents($type));
        $this->assertSame($addressComponents, $this->result->getAddressComponents($type));
        $this->assertFalse($this->result->hasAddressComponents('bar'));
        $this->assertEmpty($this->result->getAddressComponents('bar'));
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
     * @return \PHPUnit_Framework_MockObject_MockObject|AddressComponent
     */
    private function createAddressComponentMock()
    {
        return $this->createMock(AddressComponent::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Geometry
     */
    private function createGeometryMock()
    {
        return $this->createMock(Geometry::class);
    }
}
