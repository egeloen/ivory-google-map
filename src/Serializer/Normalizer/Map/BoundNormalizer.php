<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Map;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class BoundNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): Bound
    {
        $coordinate = new Bound();

        $coordinate->setNorthEast($this->denormalizer->denormalize($data['northeast'], Coordinate::class, $format, $context));
        $coordinate->setSouthWest($this->denormalizer->denormalize($data['southwest'], Coordinate::class, $format, $context));

        return $coordinate;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return Bound::class === $type;
    }
}