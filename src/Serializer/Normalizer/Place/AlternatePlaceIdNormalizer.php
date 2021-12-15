<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Place;

use Ivory\GoogleMap\Service\Base\Geometry;
use Ivory\GoogleMap\Service\Place\Base\AlternatePlaceId;
use Ivory\GoogleMap\Service\Place\Base\OpenClosePeriod;
use Ivory\GoogleMap\Service\Place\Base\OpeningHours;
use Ivory\GoogleMap\Service\Place\Base\Period;
use Ivory\GoogleMap\Service\Place\Base\Place;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class AlternatePlaceIdNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): AlternatePlaceId
    {
        $place = new AlternatePlaceId();

        $place->setOpen($this->denormalizer->denormalize($data['open'],OpenClosePeriod::class, $format, $context));
        $place->setClose($this->denormalizer->denormalize($data['close'],OpenClosePeriod::class, $format, $context));

        return $place;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return AlternatePlaceId::class === $type;
    }
}