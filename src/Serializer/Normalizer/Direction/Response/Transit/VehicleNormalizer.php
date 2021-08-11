<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Direction\Response\Transit;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitStop;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitVehicle;

class VehicleNormalizer extends Normalizer
{
    public function denormalize($data, $type, $format = null, array $context = []): DirectionTransitVehicle
    {
        $vehicle = new DirectionTransitVehicle();

        $this->setIfPresent('name', $data, [$vehicle, 'setName']);
        $this->setIfPresent('icon', $data, [$vehicle, 'setIcon']);
        $this->setIfPresent('type', $data, [$vehicle, 'setType']);
        $this->setIfPresent('localIcon', $data, [$vehicle, 'setLocalIcon']);

        return $vehicle;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return DirectionTransitVehicle::class === $type;
    }
}