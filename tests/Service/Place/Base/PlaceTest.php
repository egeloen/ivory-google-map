<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Base;

use Ivory\GoogleMap\Service\Base\AddressComponent;
use Ivory\GoogleMap\Service\Base\Geometry;
use Ivory\GoogleMap\Service\Place\Base\AlternatePlaceId;
use Ivory\GoogleMap\Service\Place\Base\OpeningHours;
use Ivory\GoogleMap\Service\Place\Base\Photo;
use Ivory\GoogleMap\Service\Place\Base\Place;
use Ivory\GoogleMap\Service\Place\Base\PlaceScope;
use Ivory\GoogleMap\Service\Place\Base\PlaceType;
use Ivory\GoogleMap\Service\Place\Base\PriceLevel;
use Ivory\GoogleMap\Service\Place\Base\Review;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Place
     */
    private $result;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->result = new Place();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->result->hasId());
        $this->assertNull($this->result->getId());
        $this->assertFalse($this->result->hasPlaceId());
        $this->assertNull($this->result->getPlaceId());
        $this->assertFalse($this->result->hasName());
        $this->assertNull($this->result->getName());
        $this->assertFalse($this->result->hasFormattedAddress());
        $this->assertNull($this->result->getFormattedAddress());
        $this->assertFalse($this->result->hasFormattedPhoneNumber());
        $this->assertNull($this->result->getFormattedPhoneNumber());
        $this->assertFalse($this->result->hasInternationalPhoneNumber());
        $this->assertNull($this->result->getInternationalPhoneNumber());
        $this->assertFalse($this->result->hasUrl());
        $this->assertNull($this->result->getUrl());
        $this->assertFalse($this->result->hasIcon());
        $this->assertNull($this->result->getIcon());
        $this->assertFalse($this->result->hasScope());
        $this->assertNull($this->result->getScope());
        $this->assertFalse($this->result->hasPriceLevel());
        $this->assertNull($this->result->getPriceLevel());
        $this->assertFalse($this->result->hasRating());
        $this->assertNull($this->result->getRating());
        $this->assertFalse($this->result->hasUtcOffset());
        $this->assertNull($this->result->getUtcOffset());
        $this->assertFalse($this->result->hasVicinity());
        $this->assertNull($this->result->getVicinity());
        $this->assertFalse($this->result->hasWebsite());
        $this->assertNull($this->result->getWebsite());
        $this->assertFalse($this->result->hasGeometry());
        $this->assertNull($this->result->getGeometry());
        $this->assertFalse($this->result->hasOpeningHours());
        $this->assertNull($this->result->getOpeningHours());
        $this->assertFalse($this->result->hasAddressComponents());
        $this->assertEmpty($this->result->getAddressComponents());
        $this->assertFalse($this->result->hasPhotos());
        $this->assertEmpty($this->result->getPhotos());
        $this->assertFalse($this->result->hasAlternatePlaceIds());
        $this->assertEmpty($this->result->getAlternatePlaceIds());
        $this->assertFalse($this->result->hasReviews());
        $this->assertEmpty($this->result->getReviews());
        $this->assertFalse($this->result->hasTypes());
        $this->assertEmpty($this->result->getTypes());
        $this->assertFalse($this->result->hasPermanentlyClose());
        $this->assertNull($this->result->isPermanentlyClose());
    }

    public function testId()
    {
        $this->result->setId($id = 'foo');

        $this->assertTrue($this->result->hasId());
        $this->assertSame($id, $this->result->getId());
    }

    public function testPlaceId()
    {
        $this->result->setPlaceId($placeId = 'foo');

        $this->assertTrue($this->result->hasPlaceId());
        $this->assertSame($placeId, $this->result->getPlaceId());
    }

    public function testName()
    {
        $this->result->setName($name = 'foo');

        $this->assertTrue($this->result->hasName());
        $this->assertSame($name, $this->result->getName());
    }

    public function testFormattedAddress()
    {
        $this->result->setFormattedAddress($formattedAddress = 'foo');

        $this->assertTrue($this->result->hasFormattedAddress());
        $this->assertSame($formattedAddress, $this->result->getFormattedAddress());
    }

    public function testFormattedPhoneNumber()
    {
        $this->result->setFormattedPhoneNumber($formattedPhoneNumber = 'foo');

        $this->assertTrue($this->result->hasFormattedPhoneNumber());
        $this->assertSame($formattedPhoneNumber, $this->result->getFormattedPhoneNumber());
    }

    public function testInternationalPhoneNumber()
    {
        $this->result->setInternationalPhoneNumber($internationalPhoneNumber = 'foo');

        $this->assertTrue($this->result->hasInternationalPhoneNumber());
        $this->assertSame($internationalPhoneNumber, $this->result->getInternationalPhoneNumber());
    }

    public function testUrl()
    {
        $this->result->setUrl($url = 'url');

        $this->assertTrue($this->result->hasUrl());
        $this->assertSame($url, $this->result->getUrl());
    }

    public function testIcon()
    {
        $this->result->setIcon($icon = 'foo');

        $this->assertTrue($this->result->hasIcon());
        $this->assertSame($icon, $this->result->getIcon());
    }

    public function testScope()
    {
        $this->result->setScope($scope = PlaceScope::GOOGLE);

        $this->assertTrue($this->result->hasScope());
        $this->assertSame($scope, $this->result->getScope());
    }

    public function testPriceLevel()
    {
        $this->result->setPriceLevel($priceLevel = PriceLevel::MODERATE);

        $this->assertTrue($this->result->hasPriceLevel());
        $this->assertSame($priceLevel, $this->result->getPriceLevel());
    }

    public function testRating()
    {
        $this->result->setRating($rating = 3.2);

        $this->assertTrue($this->result->hasRating());
        $this->assertSame($rating, $this->result->getRating());
    }

    public function testUtcOffset()
    {
        $this->result->setUtcOffset($utcOffset = 100);

        $this->assertTrue($this->result->hasUtcOffset());
        $this->assertSame($utcOffset, $this->result->getUtcOffset());
    }

    public function testVicinity()
    {
        $this->result->setVicinity($vicinity = 'foo');

        $this->assertTrue($this->result->hasVicinity());
        $this->assertSame($vicinity, $this->result->getVicinity());
    }

    public function testWebsite()
    {
        $this->result->setWebsite($website = 'website');

        $this->assertTrue($this->result->hasWebsite());
        $this->assertSame($website, $this->result->getWebsite());
    }

    public function testGeometry()
    {
        $this->result->setGeometry($geometry = $this->createGeometryMock());

        $this->assertTrue($this->result->hasGeometry());
        $this->assertSame($geometry, $this->result->getGeometry());
    }

    public function testOpeningHours()
    {
        $this->result->setOpeningHours($openingHours = $this->createOpeningHoursMock());

        $this->assertTrue($this->result->hasOpeningHours());
        $this->assertSame($openingHours, $this->result->getOpeningHours());
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

    public function testSetPhotos()
    {
        $this->result->setPhotos($photos = [$photo = $this->createPhotoMock()]);
        $this->result->setPhotos($photos);

        $this->assertTrue($this->result->hasPhotos());
        $this->assertTrue($this->result->hasPhoto($photo));
        $this->assertSame($photos, $this->result->getPhotos());
    }

    public function testAddPhotos()
    {
        $this->result->setPhotos($firstPhotos = [$this->createPhotoMock()]);
        $this->result->addPhotos($secondPhotos = [$this->createPhotoMock()]);

        $this->assertTrue($this->result->hasPhotos());
        $this->assertSame(array_merge($firstPhotos, $secondPhotos), $this->result->getPhotos());
    }

    public function testAddPhoto()
    {
        $this->result->addPhoto($photo = $this->createPhotoMock());

        $this->assertTrue($this->result->hasPhotos());
        $this->assertTrue($this->result->hasPhoto($photo));
        $this->assertSame([$photo], $this->result->getPhotos());
    }

    public function testRemovePhoto()
    {
        $this->result->addPhoto($photo = $this->createPhotoMock());
        $this->result->removePhoto($photo);

        $this->assertFalse($this->result->hasPhotos());
        $this->assertFalse($this->result->hasPhoto($photo));
        $this->assertEmpty($this->result->getPhotos());
    }

    public function testSetAlternatePlaceIds()
    {
        $alternatePlaceIds = [$alternatePlaceId = $this->createAlternatePlaceIdMock()];

        $this->result->setAlternatePlaceIds($alternatePlaceIds);
        $this->result->setAlternatePlaceIds($alternatePlaceIds);

        $this->assertTrue($this->result->hasAlternatePlaceIds());
        $this->assertTrue($this->result->hasAlternatePlaceId($alternatePlaceId));
        $this->assertSame($alternatePlaceIds, $this->result->getAlternatePlaceIds());
    }

    public function testAddAlternatePlaceIds()
    {
        $this->result->setAlternatePlaceIds($firstAlternatePlaceIds = [$this->createAlternatePlaceIdMock()]);
        $this->result->addAlternatePlaceIds($secondAlternatePlaceIds = [$this->createAlternatePlaceIdMock()]);

        $this->assertTrue($this->result->hasAlternatePlaceIds());
        $this->assertSame(
            array_merge($firstAlternatePlaceIds, $secondAlternatePlaceIds),
            $this->result->getAlternatePlaceIds()
        );
    }

    public function testAddAlternatePlaceId()
    {
        $this->result->addAlternatePlaceId($alternatePlaceId = $this->createAlternatePlaceIdMock());

        $this->assertTrue($this->result->hasAlternatePlaceIds());
        $this->assertTrue($this->result->hasAlternatePlaceId($alternatePlaceId));
        $this->assertSame([$alternatePlaceId], $this->result->getAlternatePlaceIds());
    }

    public function testRemoveAlternatePlaceId()
    {
        $this->result->addAlternatePlaceId($alternatePlaceId = $this->createAlternatePlaceIdMock());
        $this->result->removeAlternatePlaceId($alternatePlaceId);

        $this->assertFalse($this->result->hasAlternatePlaceIds());
        $this->assertFalse($this->result->hasAlternatePlaceId($alternatePlaceId));
        $this->assertEmpty($this->result->getAlternatePlaceIds());
    }

    public function testSetReviews()
    {
        $this->result->setReviews($reviews = [$review = $this->createReviewMock()]);
        $this->result->setReviews($reviews);

        $this->assertTrue($this->result->hasReviews());
        $this->assertTrue($this->result->hasReview($review));
        $this->assertSame($reviews, $this->result->getReviews());
    }

    public function testAddReviews()
    {
        $this->result->setReviews($firstReviews = [$this->createReviewMock()]);
        $this->result->addReviews($secondReviews = [$this->createReviewMock()]);

        $this->assertTrue($this->result->hasReviews());
        $this->assertSame(
            array_merge($firstReviews, $secondReviews),
            $this->result->getReviews()
        );
    }

    public function testAddReview()
    {
        $this->result->addReview($review = $this->createReviewMock());

        $this->assertTrue($this->result->hasReviews());
        $this->assertTrue($this->result->hasReview($review));
        $this->assertSame([$review], $this->result->getReviews());
    }

    public function testRemoveReview()
    {
        $this->result->addReview($review = $this->createReviewMock());
        $this->result->removeReview($review);

        $this->assertFalse($this->result->hasReviews());
        $this->assertFalse($this->result->hasReview($review));
        $this->assertEmpty($this->result->getReviews());
    }

    public function testSetTypes()
    {
        $this->result->setTypes($types = [$type = PlaceType::AIRPORT]);
        $this->result->setTypes($types);

        $this->assertTrue($this->result->hasTypes());
        $this->assertTrue($this->result->hasType($type));
        $this->assertSame($types, $this->result->getTypes());
    }

    public function testAddTypes()
    {
        $this->result->setTypes($firstTypes = [PlaceType::AIRPORT]);
        $this->result->addTypes($secondTypes = [PlaceType::ART_GALLERY]);

        $this->assertTrue($this->result->hasTypes());
        $this->assertSame(array_merge($firstTypes, $secondTypes), $this->result->getTypes());
    }

    public function testAddType()
    {
        $this->result->addType($type = PlaceType::AIRPORT);

        $this->assertTrue($this->result->hasTypes());
        $this->assertTrue($this->result->hasType($type));
        $this->assertSame([$type], $this->result->getTypes());
    }

    public function testRemoveType()
    {
        $this->result->addType($type = PlaceType::AIRPORT);
        $this->result->removeType($type);

        $this->assertFalse($this->result->hasTypes());
        $this->assertFalse($this->result->hasType($type));
        $this->assertEmpty($this->result->getTypes());
    }

    public function testPermanentlyClose()
    {
        $this->result->setPermanentlyClose(true);

        $this->assertTrue($this->result->hasPermanentlyClose());
        $this->assertTrue($this->result->isPermanentlyClose());
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

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|OpeningHours
     */
    private function createOpeningHoursMock()
    {
        return $this->createMock(OpeningHours::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Photo
     */
    private function createPhotoMock()
    {
        return $this->createMock(Photo::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|AlternatePlaceId
     */
    private function createAlternatePlaceIdMock()
    {
        return $this->createMock(AlternatePlaceId::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Review
     */
    private function createReviewMock()
    {
        return $this->createMock(Review::class);
    }
}
