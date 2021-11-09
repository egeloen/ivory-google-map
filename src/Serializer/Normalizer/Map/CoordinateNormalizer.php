<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Map;

use Ivory\GoogleMap\Base\Coordinate;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class CoordinateNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): Coordinate
    {
        $coordinate = new Coordinate();

        $coordinate->setLatitude($data['lat']);
        $coordinate->setLongitude($data['lng']);

        return $coordinate;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return Coordinate::class === $type;
    }
}