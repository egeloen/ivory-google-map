<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Place;

use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\Base\AddressComponent;
use Ivory\GoogleMap\Service\Base\Geometry;
use Ivory\GoogleMap\Service\Place\Base\AlternatePlaceId;
use Ivory\GoogleMap\Service\Place\Base\OpeningHours;
use Ivory\GoogleMap\Service\Place\Base\Photo;
use Ivory\GoogleMap\Service\Place\Base\Place;
use Ivory\GoogleMap\Service\Place\Base\PlusCode;
use Ivory\GoogleMap\Service\Place\Base\Review;

class PlaceNormalizer extends Normalizer
{
    public function denormalize($data, $type, $format = null, array $context = []): Place
    {
        $place = new Place();

        $place->setPlaceId($data['place_id']);
        $place->setName($data['name']);
        $this->setIfPresent('formatted_address', $data, [$place, 'setFormattedAddress']);
        $this->setIfPresent('formatted_phone_number', $data, [$place, 'setFormattedPhoneNumber']);
        $this->setIfPresent('international_phone_number', $data, [$place, 'setInternationalPhoneNumber']);
        $this->setIfPresent('url', $data, [$place, 'setUrl']);
        $this->setIfPresent('icon', $data, [$place, 'setIcon']);
        $this->setIfPresent('scope', $data, [$place, 'setScope']);
        $this->setIfPresent('price_level', $data, [$place, 'setPriceLevel']);
        $this->setIfPresent('utc_offset', $data, [$place, 'setUtcOffset']);
        $this->setIfPresent('vicinity', $data, [$place, 'setVicinity']);
        $this->setIfPresent('website', $data, [$place, 'setWebsite']);
        $this->setIfPresent('types', $data, [$place, 'setTypes']);
        $this->setIfPresentFloat('rating', $data, [$place, 'setRating']);
        $this->setIfPresent('business_status', $data, [$place, 'setBusinessStatus']);
        $this->setIfPresentDenormalize('geometry', $data, [$place, 'setGeometry'], Geometry::class, $format, $context);
        $this->setIfPresentDenormalize('opening_hours', $data, [$place, 'setOpeningHours'], OpeningHours::class, $format, $context);
        $this->setIfPresentDenormalize('plus_code', $data, [$place, 'setPlusCode'], PlusCode::class, $format, $context);
        $this->setIfPresent('price_level', $data, [$place, 'setPriceLevel']);
        if (array_key_exists('address_components', $data)) {
            foreach ($data['address_components'] as $addressComponentData) {
                $place->addAddressComponent($this->denormalizer->denormalize($addressComponentData, AddressComponent::class, $format, $context));
            }
        }
        if (array_key_exists('photos', $data)) {
            foreach ($data['photos'] as $photoData) {
                $place->addPhoto($this->denormalizer->denormalize($photoData, Photo::class, $format, $context));
            }
        }
        if (array_key_exists('alternate_place_ids', $data)) {
            foreach ($data['alternate_place_ids'] as $alternatePlaceId) {
                $place->addAlternatePlaceId($this->denormalizer->denormalize($alternatePlaceId, AlternatePlaceId::class, $format, $context));
            }
        }
        if (array_key_exists('reviews', $data)) {
            foreach ($data['reviews'] as $reviewData) {
                $place->addReview($this->denormalizer->denormalize($reviewData, Review::class, $format, $context));
            }
        }

        return $place;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return Place::class === $type;
    }

}