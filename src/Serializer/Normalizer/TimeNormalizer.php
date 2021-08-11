<?php

namespace Ivory\GoogleMap\Serializer\Normalizer;

use DateTime;
use Ivory\GoogleMap\Service\Base\Time;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class TimeNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): Time
    {
        return new Time(new DateTime('@' . $data['value']), $data['time_zone'], $data['text']);
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return Time::class === $type;
    }
}