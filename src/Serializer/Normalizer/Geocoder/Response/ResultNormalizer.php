<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Geocoder\Response;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\Base\AddressComponent;
use Ivory\GoogleMap\Service\Base\Geometry;
use Ivory\GoogleMap\Service\Geocoder\Response\GeocoderResult;

class ResultNormalizer extends Normalizer
{
    public function denormalize($data, $type, $format = null, array $context = []): GeocoderResult
    {
        $result = new GeocoderResult();

        $this->setIfPresent('place_id', $data, [$result, 'setPlaceId']);
        $this->setIfPresent('formatted_address', $data, [$result, 'setFormattedAddress']);
        $this->setIfPresent('postcode_localities', $data, [$result, 'setPostcodeLocalities']);
        $this->setIfPresent('types', $data, [$result, 'setTypes']);
        $this->setIfPresent('partial_match', $data, [$result, 'setPartialMatch']);
        $this->setIfPresentDenormalize('geometry', $data, [$result, 'setGeometry'], Geometry::class, $format, $context);

        if (array_key_exists('address_components', $data)) {
            foreach ($data['address_components'] as $addressComponentData) {
                $result->addAddressComponent($this->denormalizer->denormalize($addressComponentData, AddressComponent::class, $format, $context));
            }
        }

        return $result;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return GeocoderResult::class === $type;
    }
}