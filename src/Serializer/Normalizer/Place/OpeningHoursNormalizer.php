<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Place;

use Ivory\GoogleMap\Service\Place\Base\OpeningHours;
use Ivory\GoogleMap\Service\Place\Base\Period;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class OpeningHoursNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): OpeningHours
    {
        $openingHours = new OpeningHours();

        $openingHours->setOpenNow($data['open_now']);
        if (array_key_exists('periods', $data)) {
            foreach ($data['periods'] as $periodData) {
                $openingHours->addPeriod($this->denormalizer->denormalize($periodData, Period::class, $format, $context));
            }
        }
        if (array_key_exists('weekday_text', $data)) {
        foreach ($data['weekday_text'] as $weekdayText) {
            $openingHours->addWeekdayText($weekdayText);
        }
        }

        return $openingHours;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return OpeningHours::class === $type;
    }
}