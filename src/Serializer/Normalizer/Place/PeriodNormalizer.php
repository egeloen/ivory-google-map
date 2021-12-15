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

class PeriodNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): Period
    {
        $place = new Period();

        $place->setOpen($this->denormalizer->denormalize($data['open'],OpenClosePeriod::class, $format, $context));
        $place->setClose($this->denormalizer->denormalize($data['close'],OpenClosePeriod::class, $format, $context));

        return $place;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return Period::class === $type;
    }
}