<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Direction\Response\Transit;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitAgency;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitLine;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitStop;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitVehicle;

class LineNormalizer extends Normalizer
{
    public function denormalize($data, $type, $format = null, array $context = []): DirectionTransitLine
    {
        $details = new DirectionTransitLine();

        $this->setIfPresent('name', $data, [$details, 'setName']);
        $this->setIfPresent('short_name', $data, [$details, 'setShortName']);
        $this->setIfPresent('color', $data, [$details, 'setColor']);
        $this->setIfPresent('url', $data, [$details, 'setUrl']);
        $this->setIfPresent('icon', $data, [$details, 'setIcon']);
        $this->setIfPresent('text_color', $data, [$details, 'setTextColor']);
        $this->setIfPresentDenormalize('vehicle', $data, [$details, 'setVehicle'], DirectionTransitVehicle::class, $format, $context);

        foreach ($data['agencies'] as $agencyDatum) {
            $details->addAgency($this->denormalizer->denormalize($agencyDatum, DirectionTransitAgency::class, $format, $context));
        }

        return $details;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return DirectionTransitLine::class === $type;
    }
}