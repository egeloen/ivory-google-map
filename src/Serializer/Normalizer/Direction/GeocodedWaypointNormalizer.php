<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Direction;

use Ivory\GoogleMap\Service\Base\Geometry;
use Ivory\GoogleMap\Service\Direction\Response\DirectionGeocoded;
use Ivory\GoogleMap\Service\Place\Base\OpenClosePeriod;
use Ivory\GoogleMap\Service\Place\Base\OpeningHours;
use Ivory\GoogleMap\Service\Place\Base\Period;
use Ivory\GoogleMap\Service\Place\Base\Place;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class GeocodedWaypointNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): DirectionGeocoded
    {
        $geocodedWaypoint = new DirectionGeocoded();

        if(!empty($data)) {
            $geocodedWaypoint->setStatus($data['geocoder_status']);
            $geocodedWaypoint->setPlaceId($data['place_id']);
            $geocodedWaypoint->setTypes($data['types']);
        }

        return $geocodedWaypoint;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return DirectionGeocoded::class === $type;
    }
}