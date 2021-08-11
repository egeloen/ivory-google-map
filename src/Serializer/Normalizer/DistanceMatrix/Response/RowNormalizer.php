<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\DistanceMatrix\Response;

use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixElement;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixResponse;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixRow;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResponse;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResult;

class RowNormalizer extends Normalizer
{
    public function denormalize($data, $type, $format = null, array $context = []): DistanceMatrixRow
    {
        $row = new DistanceMatrixRow();

        foreach($data['elements'] as $elementDatum) {
            $row->addElement($this->denormalizer->denormalize($elementDatum, DistanceMatrixElement::class, $format, $context));
        }

        return $row;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return DistanceMatrixRow::class === $type;
    }
}