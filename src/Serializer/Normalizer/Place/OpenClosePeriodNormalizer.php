<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Place;

use Ivory\GoogleMap\Service\Base\Geometry;
use Ivory\GoogleMap\Service\Place\Base\OpenClosePeriod;
use Ivory\GoogleMap\Service\Place\Base\OpeningHours;
use Ivory\GoogleMap\Service\Place\Base\Period;
use Ivory\GoogleMap\Service\Place\Base\Place;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class OpenClosePeriodNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): OpenClosePeriod
    {
        $place = new OpenClosePeriod();

        $place->setDay($data['day']);
        $place->setTime($data['time']);

        return $place;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return OpenClosePeriod::class === $type;
    }
}