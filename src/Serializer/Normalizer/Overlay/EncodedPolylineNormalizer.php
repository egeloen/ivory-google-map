<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Overlay;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\Direction\Response\DirectionRoute;

class EncodedPolylineNormalizer extends Normalizer
{
    public function denormalize($data, $type, $format = null, array $context = []): EncodedPolyline
    {
        return new EncodedPolyline($data['points']);
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return EncodedPolyline::class === $type;
    }
}