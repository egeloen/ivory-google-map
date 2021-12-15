<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Direction\Response\Transit;

use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitAgency;

class AgencyNormalizer extends Normalizer
{
    public function denormalize($data, $type, $format = null, array $context = []): DirectionTransitAgency
    {
        $details = new DirectionTransitAgency();

        $this->setIfPresent('name', $data, [$details, 'setName']);
        $this->setIfPresent('phone', $data, [$details, 'setPhone']);
        $this->setIfPresent('url', $data, [$details, 'setUrl']);

        return $details;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return DirectionTransitAgency::class === $type;
    }
}