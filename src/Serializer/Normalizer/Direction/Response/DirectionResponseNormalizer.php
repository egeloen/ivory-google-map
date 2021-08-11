<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Direction\Response;

use Ivory\GoogleMap\Service\Direction\Response\DirectionGeocoded;
use Ivory\GoogleMap\Service\Direction\Response\DirectionResponse;
use Ivory\GoogleMap\Service\Direction\Response\DirectionRoute;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class DirectionResponseNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): DirectionResponse
    {
        $directionResponse = new DirectionResponse();

        $directionResponse->setStatus($data['status']);
        foreach ($data['geocoded_waypoints'] as $geocodedWaypointDatum) {
            $directionResponse->addGeocodedWaypoint($this->denormalizer->denormalize($geocodedWaypointDatum, DirectionGeocoded::class, $format, $context));
        }
        foreach ($data['routes'] as $routeDatum) {
            $directionResponse->addRoute($this->denormalizer->denormalize($routeDatum, DirectionRoute::class, $format, $context));
        }

        return $directionResponse;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return DirectionResponse::class === $type;
    }
}