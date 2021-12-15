<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\DistanceMatrix\Response;

use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\Base\Distance;
use Ivory\GoogleMap\Service\Base\Duration;
use Ivory\GoogleMap\Service\Base\Fare;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixElement;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixResponse;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixRow;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResponse;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResult;

class ElementNormalizer extends Normalizer
{
    public function denormalize($data, $type, $format = null, array $context = []): DistanceMatrixElement
    {
        $element = new DistanceMatrixElement();

        $this->setIfPresent('status',$data,[$element,'setStatus']);
        $this->setIfPresentDenormalize('distance',$data,[$element,'setDistance'],Distance::class, $format, $context);
        $this->setIfPresentDenormalize('duration',$data,[$element,'setDuration'],Duration::class, $format, $context);
        $this->setIfPresentDenormalize('duration_in_traffic',$data,[$element,'setDurationInTraffic'],Duration::class, $format, $context);
        $this->setIfPresentDenormalize('fare',$data,[$element,'setFare'],Fare::class, $format, $context);

        return $element;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return DistanceMatrixElement::class === $type;
    }
}