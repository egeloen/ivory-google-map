<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Timezone\Response;

use Ivory\GoogleMap\Service\Place\Base\Place;
use Ivory\GoogleMap\Service\Place\Detail\Response\PlaceDetailResponse;
use Ivory\GoogleMap\Service\TimeZone\Response\TimeZoneResponse;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class TimezoneResponseNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): TimeZoneResponse
    {
        $term = new TimeZoneResponse();

        $term->setStatus($data['status']);
        $term->setTimeZoneId($data['timeZoneId']);
        $term->setTimeZoneName($data['timeZoneName']);
        $term->setDstOffset($data['dstOffset']);
        $term->setRawOffset($data['rawOffset']);

        return $term;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return TimeZoneResponse::class === $type;
    }
}