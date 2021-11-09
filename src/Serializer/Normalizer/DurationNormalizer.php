<?php

namespace Ivory\GoogleMap\Serializer\Normalizer;

use Ivory\GoogleMap\Service\Base\AddressComponent;
use Ivory\GoogleMap\Service\Base\Distance;
use Ivory\GoogleMap\Service\Base\Duration;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class DurationNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): Duration
    {
        return new Duration(floatval($data['value']), $data['text']);
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return Duration::class === $type;
    }
}