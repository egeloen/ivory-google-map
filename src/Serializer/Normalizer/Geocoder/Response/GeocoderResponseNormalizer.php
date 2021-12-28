<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Geocoder\Response;

use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\Geocoder\Response\GeocoderResponse;
use Ivory\GoogleMap\Service\Geocoder\Response\GeocoderResult;

class GeocoderResponseNormalizer extends Normalizer
{
    public function denormalize($data, $type, $format = null, array $context = []): GeocoderResponse
    {
        $geocoderResponse = new GeocoderResponse();

        $geocoderResponse->setStatus($data['status']);
        foreach ($data['results'] as $geocodeResultDatum) {
            $geocoderResponse->addResult($this->denormalizer->denormalize($geocodeResultDatum, GeocoderResult::class, $format, $context));
        }

        return $geocoderResponse;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return GeocoderResponse::class === $type;
    }
}