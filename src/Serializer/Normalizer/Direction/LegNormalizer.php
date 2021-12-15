<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Direction;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\Base\Distance;
use Ivory\GoogleMap\Service\Base\Duration;
use Ivory\GoogleMap\Service\Base\Time;
use Ivory\GoogleMap\Service\Direction\Response\DirectionLeg;
use Ivory\GoogleMap\Service\Direction\Response\DirectionRoute;
use Ivory\GoogleMap\Service\Direction\Response\DirectionStep;
use Ivory\GoogleMap\Service\Direction\Response\DirectionWaypoint;

class LegNormalizer extends Normalizer
{
    public function denormalize($data, $type, $format = null, array $context = []): DirectionLeg
    {
        $route = new DirectionLeg();

        $this->setIfPresent('start_address',$data, [$route, 'setStartAddress']);
        $this->setIfPresent('end_address',$data, [$route, 'setEndAddress']);
        $this->setIfPresentDenormalize('departure_time', $data, [$route, 'setDepartureTime'], Time::class, $format, $context);
        $this->setIfPresentDenormalize('arrival_time', $data, [$route, 'setArrivalTime'], Time::class, $format, $context);
        $this->setIfPresentDenormalize('start_location', $data, [$route, 'setStartLocation'], Coordinate::class, $format, $context);
        $this->setIfPresentDenormalize('end_location', $data, [$route, 'setEndLocation'], Coordinate::class, $format, $context);
        $this->setIfPresentDenormalize('distance', $data, [$route, 'setDistance'], Distance::class, $format, $context);
        $this->setIfPresentDenormalize('duration', $data, [$route, 'setDuration'], Duration::class, $format, $context);
        $this->setIfPresentDenormalize('duration_in_traffic', $data, [$route, 'setDurationInTraffic'], Duration::class, $format, $context);

        foreach ($data['steps'] as $legDatum) {
            $route->addStep($this->denormalizer->denormalize($legDatum, DirectionStep::class, $format, $context));
        }
        foreach ($data['via_waypoint'] as $waypointDatum) {
            $route->addViaWaypoint($this->denormalizer->denormalize($waypointDatum, DirectionWaypoint::class, $format, $context));
        }

        return $route;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return DirectionLeg::class === $type;
    }
}