<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Direction\Response\Transit;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitStop;

class StopNormalizer extends Normalizer
{
    public function denormalize($data, $type, $format = null, array $context = []): DirectionTransitStop
    {
        $details = new DirectionTransitStop();

        $this->setIfPresent('name', $data, [$details, 'setName']);
        $this->setIfPresentDenormalize('location', $data, [$details, 'setLocation'], Coordinate::class, $format, $context);

        return $details;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return DirectionTransitStop::class === $type;
    }
}