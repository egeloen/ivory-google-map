<?php

namespace Ivory\GoogleMap\Serializer\Normalizer;

use Ivory\GoogleMap\Service\Base\AddressComponent;
use Ivory\GoogleMap\Service\Base\Distance;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class DistanceNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): Distance
    {
        return new Distance(floatval($data['value']), $data['text']);
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return Distance::class === $type;
    }
}