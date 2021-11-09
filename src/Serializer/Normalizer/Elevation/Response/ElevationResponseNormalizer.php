<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Elevation\Response;

use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResponse;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResult;

class ElevationResponseNormalizer extends Normalizer
{
    public function denormalize($data, $type, $format = null, array $context = []): ElevationResponse
    {
        $elevationResponse = new ElevationResponse();

        $elevationResponse->setStatus($data['status']);
        foreach($data['results'] as $elevationResultData) {
            $elevationResponse->addResult($this->denormalizer->denormalize($elevationResultData, ElevationResult::class, $format, $context));
        }

        return $elevationResponse;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return ElevationResponse::class === $type;
    }
}