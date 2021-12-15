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
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitDetails;

class StepNormalizer extends Normalizer
{
    public function denormalize($data, $type, $format = null, array $context = []): DirectionStep
    {
        $step = new DirectionStep();

        $this->setIfPresent('html_instructions',$data, [$step, 'setInstructions']);
        $this->setIfPresent('travel_mode',$data, [$step, 'setTravelMode']);
        $this->setIfPresentDenormalize('start_location', $data, [$step, 'setStartLocation'], Coordinate::class, $format, $context);
        $this->setIfPresentDenormalize('end_location', $data, [$step, 'setEndLocation'], Coordinate::class, $format, $context);
        $this->setIfPresentDenormalize('distance', $data, [$step, 'setDistance'], Distance::class, $format, $context);
        $this->setIfPresentDenormalize('duration', $data, [$step, 'setDuration'], Duration::class, $format, $context);
        $this->setIfPresentDenormalize('polyline', $data, [$step, 'setEncodedPolyline'], EncodedPolyline::class, $format, $context);
        $this->setIfPresentDenormalize('transit_details', $data, [$step, 'setTransitDetails'], DirectionTransitDetails::class, $format, $context);

        return $step;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return DirectionStep::class === $type;
    }
}