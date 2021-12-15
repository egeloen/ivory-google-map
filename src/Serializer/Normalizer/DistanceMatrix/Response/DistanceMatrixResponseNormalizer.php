<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\DistanceMatrix\Response;

use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixResponse;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixRow;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResponse;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResult;

class DistanceMatrixResponseNormalizer extends Normalizer
{
    public function denormalize($data, $type, $format = null, array $context = []): DistanceMatrixResponse
    {
        $distanceMatrixResponse = new DistanceMatrixResponse();

        $this->setIfPresent('status', $data, [$distanceMatrixResponse, 'setStatus']);
        $this->setIfPresent('origin_addresses', $data, [$distanceMatrixResponse, 'setOrigins']);
        $this->setIfPresent('destination_addresses', $data, [$distanceMatrixResponse, 'setDestinations']);
        foreach($data['rows'] as $elevationResultData) {
            $distanceMatrixResponse->addRow($this->denormalizer->denormalize($elevationResultData, DistanceMatrixRow::class, $format, $context));
        }

        return $distanceMatrixResponse;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return DistanceMatrixResponse::class === $type;
    }
}