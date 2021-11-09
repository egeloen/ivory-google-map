<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Direction\Response;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\Direction\Response\DirectionWaypoint;

class DirectionResponseWaypointNormalizer extends Normalizer
{

    public function denormalize($data, $type, $format = null, array $context = []): DirectionWaypoint
    {
        $waypoint = new DirectionWaypoint();

        $this->setIfPresent('step_index', $data, [$waypoint, 'setStepIndex']);
        $this->setIfPresent('step_interpolation', $data, [$waypoint, 'setStepInterpolation']);
        $this->setIfPresentDenormalize('location', $data, [$waypoint, 'setLocation'],Coordinate::class, $format, $context);

        return $waypoint;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return DirectionWaypoint::class === $type;
    }
}