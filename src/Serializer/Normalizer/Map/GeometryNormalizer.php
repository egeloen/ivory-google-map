<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Map;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\Base\Geometry;

class GeometryNormalizer extends Normalizer
{
    public function denormalize($data, $type, $format = null, array $context = []): Geometry
    {
        $place = new Geometry();

        $this->setIfPresent('location_type', $data, [$place, 'setLocationType']);
        $this->setIfPresentDenormalize('location', $data, [$place, 'setLocation'], Coordinate::class, $format, $context);
        $this->setIfPresentDenormalize('viewport', $data, [$place, 'setViewport'], Bound::class, $format, $context);
        $this->setIfPresentDenormalize('bounds', $data, [$place, 'setBound'], Bound::class, $format, $context);

        return $place;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return Geometry::class === $type;
    }
}