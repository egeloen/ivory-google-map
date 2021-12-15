<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Direction;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\Direction\Response\DirectionLeg;
use Ivory\GoogleMap\Service\Direction\Response\DirectionRoute;

class RouteNormalizer extends Normalizer
{
    public function denormalize($data, $type, $format = null, array $context = []): DirectionRoute
    {
        $route = new DirectionRoute();

        $this->setIfPresent('summary',$data, [$route, 'setSummary']);
        $this->setIfPresent('copyrights',$data, [$route, 'setCopyrights']);
        $this->setIfPresent('warnings',$data, [$route, 'setWarnings']);
        $this->setIfPresentDenormalize('bounds', $data, [$route, 'setBound'], Bound::class, $format, $context);
        $this->setIfPresentDenormalize('overview_polyline', $data, [$route, 'setOverviewPolyline'], EncodedPolyline::class, $format, $context);

        foreach ($data['legs'] as $legDatum) {
            $route->addLeg($this->denormalizer->denormalize($legDatum, DirectionLeg::class, $format, $context));
        }
        foreach ($data['waypoint_order'] as $waypointOrderDatum) {
            $route->addWaypointOrder(intval($waypointOrderDatum));
        }

        return $route;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return DirectionRoute::class === $type;
    }
}