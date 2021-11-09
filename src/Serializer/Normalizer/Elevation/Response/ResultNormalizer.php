<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Elevation\Response;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResult;

class ResultNormalizer extends Normalizer
{
    public function denormalize($data, $type, $format = null, array $context = []): ElevationResult
    {
        $result = new ElevationResult();

        $this->setIfPresent('elevation', $data, [$result, 'setElevation']);
        $this->setIfPresentFloat('resolution', $data, [$result, 'setResolution']);
        $this->setIfPresentDenormalize('location', $data, [$result, 'setLocation'], Coordinate::class, $format, $context);

        return $result;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return ElevationResult::class === $type;
    }
}