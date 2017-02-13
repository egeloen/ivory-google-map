<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Base;

use Ivory\GoogleMap\Service\Base\AddressComponent;
use Ivory\GoogleMap\Service\Base\Geometry;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Place
{
    /**
     * @var string|null
     */
    private $id;

    /**
     * @var string|null
     */
    private $placeId;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $formattedAddress;

    /**
     * @var string|null
     */
    private $formattedPhoneNumber;

    /**
     * @var string|null
     */
    private $internationalPhoneNumber;

    /**
     * @var string|null
     */
    private $url;

    /**
     * @var string|null
     */
    private $icon;

    /**
     * @var string|null
     */
    private $scope;

    /**
     * @var int|null
     */
    private $priceLevel;

    /**
     * @var float|null
     */
    private $rating;

    /**
     * @var int|null
     */
    private $utcOffset;

    /**
     * @var string|null
     */
    private $vicinity;

    /**
     * @var string|null
     */
    private $website;

    /**
     * @var Geometry|null
     */
    private $geometry;

    /**
     * @var OpeningHours|null
     */
    private $openingHours;

    /**
     * @var AddressComponent[]
     */
    private $addressComponents = [];

    /**
     * @var Photo[]
     */
    private $photos = [];

    /**
     * @var AlternatePlaceId[]
     */
    private $alternatePlaceIds = [];

    /**
     * @var Review[]
     */
    private $reviews = [];

    /**
     * @var string[]
     */
    private $types = [];

    /**
     * @var bool|null
     */
    private $permanentlyClose;

    /**
     * @return bool
     */
    public function hasId()
    {
        return $this->id !== null;
    }

    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return bool
     */
    public function hasPlaceId()
    {
        return $this->placeId !== null;
    }

    /**
     * @return string|null
     */
    public function getPlaceId()
    {
        return $this->placeId;
    }

    /**
     * @param string|null $placeId
     */
    public function setPlaceId($placeId)
    {
        $this->placeId = $placeId;
    }

    /**
     * @return bool
     */
    public function hasName()
    {
        return $this->name !== null;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function hasFormattedAddress()
    {
        return $this->formattedAddress !== null;
    }

    /**
     * @return string|null
     */
    public function getFormattedAddress()
    {
        return $this->formattedAddress;
    }

    /**
     * @param string|null $formattedAddress
     */
    public function setFormattedAddress($formattedAddress)
    {
        $this->formattedAddress = $formattedAddress;
    }

    /**
     * @return bool
     */
    public function hasFormattedPhoneNumber()
    {
        return $this->formattedPhoneNumber !== null;
    }

    /**
     * @return string|null
     */
    public function getFormattedPhoneNumber()
    {
        return $this->formattedPhoneNumber;
    }

    /**
     * @param string|null $formattedPhoneNumber
     */
    public function setFormattedPhoneNumber($formattedPhoneNumber)
    {
        $this->formattedPhoneNumber = $formattedPhoneNumber;
    }

    /**
     * @return bool
     */
    public function hasInternationalPhoneNumber()
    {
        return $this->internationalPhoneNumber !== null;
    }

    /**
     * @return string|null
     */
    public function getInternationalPhoneNumber()
    {
        return $this->internationalPhoneNumber;
    }

    /**
     * @param string|null $internationalPhoneNumber
     */
    public function setInternationalPhoneNumber($internationalPhoneNumber)
    {
        $this->internationalPhoneNumber = $internationalPhoneNumber;
    }

    /**
     * @return bool
     */
    public function hasUrl()
    {
        return $this->url !== null;
    }

    /**
     * @return string|null
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return bool
     */
    public function hasIcon()
    {
        return $this->icon !== null;
    }

    /**
     * @return string|null
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string|null $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return bool
     */
    public function hasScope()
    {
        return $this->scope !== null;
    }

    /**
     * @return string|null
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param string|null $scope
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
    }

    /**
     * @return bool
     */
    public function hasPriceLevel()
    {
        return $this->priceLevel !== null;
    }

    /**
     * @return int|null
     */
    public function getPriceLevel()
    {
        return $this->priceLevel;
    }

    /**
     * @param int|null $priceLevel
     */
    public function setPriceLevel($priceLevel)
    {
        $this->priceLevel = $priceLevel;
    }

    /**
     * @return bool
     */
    public function hasRating()
    {
        return $this->rating !== null;
    }

    /**
     * @return float|null
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param float|null $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return bool
     */
    public function hasUtcOffset()
    {
        return $this->utcOffset !== null;
    }

    /**
     * @return int|null
     */
    public function getUtcOffset()
    {
        return $this->utcOffset;
    }

    /**
     * @param int|null $utcOffset
     */
    public function setUtcOffset($utcOffset)
    {
        $this->utcOffset = $utcOffset;
    }

    /**
     * @return bool
     */
    public function hasVicinity()
    {
        return $this->vicinity !== null;
    }

    /**
     * @return string|null
     */
    public function getVicinity()
    {
        return $this->vicinity;
    }

    /**
     * @param string|null $vicinity
     */
    public function setVicinity($vicinity)
    {
        $this->vicinity = $vicinity;
    }

    /**
     * @return bool
     */
    public function hasWebsite()
    {
        return $this->website !== null;
    }

    /**
     * @return string|null
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param string|null $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @return bool
     */
    public function hasGeometry()
    {
        return $this->geometry !== null;
    }

    /**
     * @return Geometry|null
     */
    public function getGeometry()
    {
        return $this->geometry;
    }

    /**
     * @param Geometry|null $geometry
     */
    public function setGeometry(Geometry $geometry = null)
    {
        $this->geometry = $geometry;
    }

    /**
     * @return bool
     */
    public function hasOpeningHours()
    {
        return $this->openingHours !== null;
    }

    /**
     * @return OpeningHours|null
     */
    public function getOpeningHours()
    {
        return $this->openingHours;
    }

    /**
     * @param OpeningHours|null $openingHours
     */
    public function setOpeningHours(OpeningHours $openingHours = null)
    {
        $this->openingHours = $openingHours;
    }

    /**
     * @param string|null $type
     *
     * @return bool
     */
    public function hasAddressComponents($type = null)
    {
        $addresses = $this->getAddressComponents($type);

        return !empty($addresses);
    }

    /**
     * @param string|null $type
     *
     * @return AddressComponent[]
     */
    public function getAddressComponents($type = null)
    {
        if ($type === null) {
            return $this->addressComponents;
        }

        $addressComponents = [];

        foreach ($this->addressComponents as $addressComponent) {
            if (in_array($type, $addressComponent->getTypes(), true)) {
                $addressComponents[] = $addressComponent;
            }
        }

        return $addressComponents;
    }

    /**
     * @param AddressComponent[] $addressComponents
     */
    public function setAddressComponents(array $addressComponents)
    {
        $this->addressComponents = [];
        $this->addAddressComponents($addressComponents);
    }

    /**
     * @param AddressComponent[] $addressComponents
     */
    public function addAddressComponents(array $addressComponents)
    {
        foreach ($addressComponents as $addressComponent) {
            $this->addAddressComponent($addressComponent);
        }
    }

    /**
     * @param AddressComponent $addressComponent
     *
     * @return bool
     */
    public function hasAddressComponent(AddressComponent $addressComponent)
    {
        return in_array($addressComponent, $this->addressComponents, true);
    }

    /**
     * @param AddressComponent $addressComponent
     */
    public function addAddressComponent(AddressComponent $addressComponent)
    {
        if (!$this->hasAddressComponent($addressComponent)) {
            $this->addressComponents[] = $addressComponent;
        }
    }

    /**
     * @param AddressComponent $addressComponent
     */
    public function removeAddressComponent(AddressComponent $addressComponent)
    {
        unset($this->addressComponents[array_search($addressComponent, $this->addressComponents, true)]);
        $this->addressComponents = array_values($this->addressComponents);
    }

    /**
     * @return bool
     */
    public function hasPhotos()
    {
        return !empty($this->photos);
    }

    /**
     * @return Photo[]
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * @param Photo[] $photos
     */
    public function setPhotos(array $photos)
    {
        $this->photos = [];
        $this->addPhotos($photos);
    }

    /**
     * @param Photo[] $photos
     */
    public function addPhotos(array $photos)
    {
        foreach ($photos as $photo) {
            $this->addPhoto($photo);
        }
    }

    /**
     * @param Photo $photo
     *
     * @return bool
     */
    public function hasPhoto(Photo $photo)
    {
        return in_array($photo, $this->photos, true);
    }

    /**
     * @param Photo $photo
     */
    public function addPhoto(Photo $photo)
    {
        if (!$this->hasPhoto($photo)) {
            $this->photos[] = $photo;
        }
    }

    /**
     * @param Photo $photo
     */
    public function removePhoto(Photo $photo)
    {
        unset($this->photos[array_search($photo, $this->photos, true)]);
        $this->photos = array_values($this->photos);
    }

    /**
     * @return bool
     */
    public function hasAlternatePlaceIds()
    {
        return !empty($this->alternatePlaceIds);
    }

    /**
     * @return AlternatePlaceId[]
     */
    public function getAlternatePlaceIds()
    {
        return $this->alternatePlaceIds;
    }

    /**
     * @param AlternatePlaceId[] $alternatePlaceIds
     */
    public function setAlternatePlaceIds(array $alternatePlaceIds)
    {
        $this->alternatePlaceIds = [];
        $this->addAlternatePlaceIds($alternatePlaceIds);
    }

    /**
     * @param AlternatePlaceId[] $alternatePlaceIds
     */
    public function addAlternatePlaceIds(array $alternatePlaceIds)
    {
        foreach ($alternatePlaceIds as $alternatePlaceId) {
            $this->addAlternatePlaceId($alternatePlaceId);
        }
    }

    /**
     * @param AlternatePlaceId $alternatePlaceId
     *
     * @return bool
     */
    public function hasAlternatePlaceId(AlternatePlaceId $alternatePlaceId)
    {
        return in_array($alternatePlaceId, $this->alternatePlaceIds, true);
    }

    public function addAlternatePlaceId(AlternatePlaceId $alternatePlaceId)
    {
        if (!$this->hasAlternatePlaceId($alternatePlaceId)) {
            $this->alternatePlaceIds[] = $alternatePlaceId;
        }
    }

    /**
     * @param AlternatePlaceId $alternatePlaceId
     */
    public function removeAlternatePlaceId(AlternatePlaceId $alternatePlaceId)
    {
        unset($this->alternatePlaceIds[array_search($alternatePlaceId, $this->alternatePlaceIds, true)]);
        $this->alternatePlaceIds = array_values($this->alternatePlaceIds);
    }

    /**
     * @return bool
     */
    public function hasReviews()
    {
        return !empty($this->reviews);
    }

    /**
     * @return Review[]
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param Review[] $reviews
     */
    public function setReviews(array $reviews)
    {
        $this->reviews = [];
        $this->addReviews($reviews);
    }

    /**
     * @param Review[] $reviews
     */
    public function addReviews(array $reviews)
    {
        foreach ($reviews as $review) {
            $this->addReview($review);
        }
    }

    /**
     * @param Review $review
     *
     * @return bool
     */
    public function hasReview(Review $review)
    {
        return in_array($review, $this->reviews, true);
    }

    /**
     * @param Review $review
     */
    public function addReview(Review $review)
    {
        if (!$this->hasReview($review)) {
            $this->reviews[] = $review;
        }
    }

    /**
     * @param Review $review
     */
    public function removeReview(Review $review)
    {
        unset($this->reviews[array_search($review, $this->reviews, true)]);
        $this->reviews = array_values($this->reviews);
    }

    /**
     * @return bool
     */
    public function hasTypes()
    {
        return !empty($this->types);
    }

    /**
     * @return string[]
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param string[] $types
     */
    public function setTypes(array $types)
    {
        $this->types = [];
        $this->addTypes($types);
    }

    /**
     * @param string[] $types
     */
    public function addTypes(array $types)
    {
        foreach ($types as $type) {
            $this->addType($type);
        }
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    public function hasType($type)
    {
        return in_array($type, $this->types, true);
    }

    /**
     * @param string $type
     */
    public function addType($type)
    {
        if (!$this->hasType($type)) {
            $this->types[] = $type;
        }
    }

    /**
     * @param string $type
     */
    public function removeType($type)
    {
        unset($this->types[array_search($type, $this->types, true)]);
        $this->types = array_values($this->types);
    }

    /**
     * @return bool
     */
    public function hasPermanentlyClose()
    {
        return $this->permanentlyClose !== null;
    }

    /**
     * @return bool|null
     */
    public function isPermanentlyClose()
    {
        return $this->permanentlyClose;
    }

    /**
     * @param bool|null $permanentlyClose
     */
    public function setPermanentlyClose($permanentlyClose)
    {
        $this->permanentlyClose = $permanentlyClose;
    }
}
