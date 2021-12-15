<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Direction\Response\Transit;

use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\Base\Time;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitDetails;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitLine;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitStop;

class DetailsNormalizer extends Normalizer
{
    public function denormalize($data, $type, $format = null, array $context = []): DirectionTransitDetails
    {
        $details = new DirectionTransitDetails();

        $this->setIfPresent('headsign', $data, [$details, 'setHeadSign']);
        $this->setIfPresent('headway', $data, [$details, 'setHeadWay']);
        $this->setIfPresent('num_stops', $data, [$details, 'setNumStops']);
        $this->setIfPresentDenormalize('departure_stop', $data, [$details, 'setDepartureStop'], DirectionTransitStop::class, $format, $context);
        $this->setIfPresentDenormalize('arrival_stop', $data, [$details, 'setArrivalStop'], DirectionTransitStop::class, $format, $context);
        $this->setIfPresentDenormalize('departure_time', $data, [$details, 'setDepartureTime'], Time::class, $format, $context);
        $this->setIfPresentDenormalize('arrival_time', $data, [$details, 'setArrivalTime'], Time::class, $format, $context);
        $this->setIfPresentDenormalize('line', $data, [$details, 'setLine'], DirectionTransitLine::class, $format, $context);

        return $details;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return DirectionTransitDetails::class === $type;
    }
}