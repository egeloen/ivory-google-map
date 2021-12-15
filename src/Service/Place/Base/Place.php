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
    private ?string $id = null;

    private ?string $placeId = null;

    private ?string $name = null;

    private ?string $formattedAddress = null;

    private ?string $formattedPhoneNumber = null;

    private ?string $internationalPhoneNumber = null;

    private ?string $url = null;

    private ?string $icon = null;

    private ?string $scope = null;

    private ?int $priceLevel = null;

    private ?float $rating = null;

    private ?int $utcOffset = null;

    private ?string $vicinity = null;

    private ?string $website = null;

    private ?Geometry $geometry = null;

    private ?OpeningHours $openingHours = null;

    /**
     * @var AddressComponent[]
     */
    private array $addressComponents = [];

    /**
     * @var Photo[]
     */
    private array $photos = [];

    /**
     * @var AlternatePlaceId[]
     */
    private array $alternatePlaceIds = [];

    /**
     * @var Review[]
     */
    private array $reviews = [];

    /**
     * @var string[]
     */
    private array $types = [];

    private ?bool $permanentlyClose = null;

    private ?string $businessStatus = null;

    private ?int $userRatingsTotal = null;

    private ?PlusCode $plusCode = null;

    public function hasId(): bool
    {
        return $this->id !== null;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function hasPlaceId(): bool
    {
        return $this->placeId !== null;
    }

    public function getPlaceId(): ?string
    {
        return $this->placeId;
    }

    /**
     * @param string|null $placeId
     */
    public function setPlaceId($placeId): void
    {
        $this->placeId = $placeId;
    }

    public function hasName(): bool
    {
        return $this->name !== null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function hasFormattedAddress(): bool
    {
        return $this->formattedAddress !== null;
    }

    public function getFormattedAddress(): ?string
    {
        return $this->formattedAddress;
    }

    public function setFormattedAddress(?string $formattedAddress): void
    {
        $this->formattedAddress = $formattedAddress;
    }

    public function hasFormattedPhoneNumber(): bool
    {
        return $this->formattedPhoneNumber !== null;
    }

    public function getFormattedPhoneNumber(): ?string
    {
        return $this->formattedPhoneNumber;
    }

    /**
     * @param string|null $formattedPhoneNumber
     */
    public function setFormattedPhoneNumber($formattedPhoneNumber): void
    {
        $this->formattedPhoneNumber = $formattedPhoneNumber;
    }

    public function hasInternationalPhoneNumber(): bool
    {
        return $this->internationalPhoneNumber !== null;
    }

    public function getInternationalPhoneNumber(): ?string
    {
        return $this->internationalPhoneNumber;
    }

    /**
     * @param string|null $internationalPhoneNumber
     */
    public function setInternationalPhoneNumber($internationalPhoneNumber): void
    {
        $this->internationalPhoneNumber = $internationalPhoneNumber;
    }

    public function hasUrl(): bool
    {
        return $this->url !== null;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    public function hasIcon(): bool
    {
        return $this->icon !== null;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string|null $icon
     */
    public function setIcon($icon): void
    {
        $this->icon = $icon;
    }

    public function hasScope(): bool
    {
        return $this->scope !== null;
    }

    public function getScope(): ?string
    {
        return $this->scope;
    }

    /**
     * @param string|null $scope
     */
    public function setScope($scope): void
    {
        $this->scope = $scope;
    }

    public function hasPriceLevel(): bool
    {
        return $this->priceLevel !== null;
    }

    public function getPriceLevel(): ?int
    {
        return $this->priceLevel;
    }

    /**
     * @param int|null $priceLevel
     */
    public function setPriceLevel($priceLevel): void
    {
        $this->priceLevel = $priceLevel;
    }

    public function hasRating(): bool
    {
        return $this->rating !== null;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    /**
     * @param float|null $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }

    public function hasUtcOffset(): bool
    {
        return $this->utcOffset !== null;
    }

    public function getUtcOffset(): ?int
    {
        return $this->utcOffset;
    }

    /**
     * @param int|null $utcOffset
     */
    public function setUtcOffset($utcOffset): void
    {
        $this->utcOffset = $utcOffset;
    }

    public function hasVicinity(): bool
    {
        return $this->vicinity !== null;
    }

    public function getVicinity(): ?string
    {
        return $this->vicinity;
    }

    /**
     * @param string|null $vicinity
     */
    public function setVicinity($vicinity): void
    {
        $this->vicinity = $vicinity;
    }

    public function hasWebsite(): bool
    {
        return $this->website !== null;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * @param string|null $website
     */
    public function setWebsite($website): void
    {
        $this->website = $website;
    }

    public function hasGeometry(): bool
    {
        return $this->geometry !== null;
    }

    public function getGeometry(): ?Geometry
    {
        return $this->geometry;
    }

    /**
     * @param Geometry|null $geometry
     */
    public function setGeometry(Geometry $geometry = null): void
    {
        $this->geometry = $geometry;
    }

    public function hasOpeningHours(): bool
    {
        return $this->openingHours !== null;
    }

    public function getOpeningHours(): ?OpeningHours
    {
        return $this->openingHours;
    }

    /**
     * @param OpeningHours|null $openingHours
     */
    public function setOpeningHours(OpeningHours $openingHours = null): void
    {
        $this->openingHours = $openingHours;
    }

    /**
     * @param string|null $type
     */
    public function hasAddressComponents($type = null): bool
    {
        $addresses = $this->getAddressComponents($type);

        return !empty($addresses);
    }

    /**
     * @param string|null $type
     *
     * @return AddressComponent[]
     */
    public function getAddressComponents($type = null): array
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
    public function setAddressComponents(array $addressComponents): void
    {
        $this->addressComponents = [];
        $this->addAddressComponents($addressComponents);
    }

    /**
     * @param AddressComponent[] $addressComponents
     */
    public function addAddressComponents(array $addressComponents): void
    {
        foreach ($addressComponents as $addressComponent) {
            $this->addAddressComponent($addressComponent);
        }
    }

    public function hasAddressComponent(AddressComponent $addressComponent): bool
    {
        return in_array($addressComponent, $this->addressComponents, true);
    }

    public function addAddressComponent(AddressComponent $addressComponent): void
    {
        if (!$this->hasAddressComponent($addressComponent)) {
            $this->addressComponents[] = $addressComponent;
        }
    }

    public function removeAddressComponent(AddressComponent $addressComponent): void
    {
        unset($this->addressComponents[array_search($addressComponent, $this->addressComponents, true)]);
        $this->addressComponents = empty($this->addressComponents) ? [] : array_values($this->addressComponents);
    }

    public function hasPhotos(): bool
    {
        return !empty($this->photos);
    }

    /**
     * @return Photo[]
     */
    public function getPhotos(): array
    {
        return $this->photos;
    }

    /**
     * @param Photo[] $photos
     */
    public function setPhotos(array $photos): void
    {
        $this->photos = [];
        $this->addPhotos($photos);
    }

    /**
     * @param Photo[] $photos
     */
    public function addPhotos(array $photos): void
    {
        foreach ($photos as $photo) {
            $this->addPhoto($photo);
        }
    }

    public function hasPhoto(Photo $photo): bool
    {
        return in_array($photo, $this->photos, true);
    }

    public function addPhoto(Photo $photo): void
    {
        if (!$this->hasPhoto($photo)) {
            $this->photos[] = $photo;
        }
    }

    public function removePhoto(Photo $photo): void
    {
        unset($this->photos[array_search($photo, $this->photos, true)]);
        $this->photos = empty($this->photos) ? [] : array_values($this->photos);
    }

    public function hasAlternatePlaceIds(): bool
    {
        return !empty($this->alternatePlaceIds);
    }

    /**
     * @return AlternatePlaceId[]
     */
    public function getAlternatePlaceIds(): array
    {
        return $this->alternatePlaceIds;
    }

    /**
     * @param AlternatePlaceId[] $alternatePlaceIds
     */
    public function setAlternatePlaceIds(array $alternatePlaceIds): void
    {
        $this->alternatePlaceIds = [];
        $this->addAlternatePlaceIds($alternatePlaceIds);
    }

    /**
     * @param AlternatePlaceId[] $alternatePlaceIds
     */
    public function addAlternatePlaceIds(array $alternatePlaceIds): void
    {
        foreach ($alternatePlaceIds as $alternatePlaceId) {
            $this->addAlternatePlaceId($alternatePlaceId);
        }
    }

    public function hasAlternatePlaceId(AlternatePlaceId $alternatePlaceId): bool
    {
        return in_array($alternatePlaceId, $this->alternatePlaceIds, true);
    }

    public function addAlternatePlaceId(AlternatePlaceId $alternatePlaceId): void
    {
        if (!$this->hasAlternatePlaceId($alternatePlaceId)) {
            $this->alternatePlaceIds[] = $alternatePlaceId;
        }
    }

    public function removeAlternatePlaceId(AlternatePlaceId $alternatePlaceId): void
    {
        unset($this->alternatePlaceIds[array_search($alternatePlaceId, $this->alternatePlaceIds, true)]);
        $this->alternatePlaceIds = empty($this->alternatePlaceIds) ? [] : array_values($this->alternatePlaceIds);
    }

    public function hasReviews(): bool
    {
        return !empty($this->reviews);
    }

    /**
     * @return Review[]
     */
    public function getReviews(): array
    {
        return $this->reviews;
    }

    /**
     * @param Review[] $reviews
     */
    public function setReviews(array $reviews): void
    {
        $this->reviews = [];
        $this->addReviews($reviews);
    }

    /**
     * @param Review[] $reviews
     */
    public function addReviews(array $reviews): void
    {
        foreach ($reviews as $review) {
            $this->addReview($review);
        }
    }

    public function hasReview(Review $review): bool
    {
        return in_array($review, $this->reviews, true);
    }

    public function addReview(Review $review): void
    {
        if (!$this->hasReview($review)) {
            $this->reviews[] = $review;
        }
    }

    public function removeReview(Review $review): void
    {
        unset($this->reviews[array_search($review, $this->reviews, true)]);
        $this->reviews = empty($this->reviews) ? [] : array_values($this->reviews);
    }

    public function hasTypes(): bool
    {
        return !empty($this->types);
    }

    /**
     * @return string[]
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    /**
     * @param string[] $types
     */
    public function setTypes(array $types): void
    {
        $this->types = [];
        $this->addTypes($types);
    }

    /**
     * @param string[] $types
     */
    public function addTypes(array $types): void
    {
        foreach ($types as $type) {
            $this->addType($type);
        }
    }

    /**
     * @param string $type
     */
    public function hasType($type): bool
    {
        return in_array($type, $this->types, true);
    }

    /**
     * @param string $type
     */
    public function addType($type): void
    {
        if (!$this->hasType($type)) {
            $this->types[] = $type;
        }
    }

    /**
     * @param string $type
     */
    public function removeType($type): void
    {
        unset($this->types[array_search($type, $this->types, true)]);
        $this->types = empty($this->types) ? [] : array_values($this->types);
    }

    public function hasPermanentlyClose(): bool
    {
        return $this->permanentlyClose !== null;
    }

    public function isPermanentlyClose(): ?bool
    {
        return $this->permanentlyClose;
    }

    /**
     * @param bool|null $permanentlyClose
     */
    public function setPermanentlyClose($permanentlyClose): void
    {
        $this->permanentlyClose = $permanentlyClose;
    }

    public function getBusinessStatus(): ?string
    {
        return $this->businessStatus;
    }

    /**
     * @param string|null $businessStatus
     */
    public function setBusinessStatus(string $businessStatus): void
    {
        $this->businessStatus = $businessStatus;
    }

    public function getUserRatingsTotal(): ?int
    {
        return $this->userRatingsTotal;
    }

    /**
     * @param int|null $userRatingsTotal
     */
    public function setUserRatingsTotal(int $userRatingsTotal): void
    {
        $this->userRatingsTotal = $userRatingsTotal;
    }

    public function getPlusCode(): ?PlusCode
    {
        return $this->plusCode;
    }

    /**
     * @param PlusCode|null $plusCode
     */
    public function setPlusCode(PlusCode $plusCode): void
    {
        $this->plusCode = $plusCode;
    }
}
