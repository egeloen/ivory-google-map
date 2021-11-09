<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Place\Response;

use Ivory\GoogleMap\Service\Place\Base\Place;
use Ivory\GoogleMap\Service\Place\Search\Response\PlaceSearchResponse;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class PlaceSearchResponseNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): PlaceSearchResponse
    {
        $term = new PlaceSearchResponse();

        $term->setStatus($data['status']);
        $term->setHtmlAttributions($data['html_attributions']);
        foreach ($data['results'] as $resultData) {
            $term->addResult($this->denormalizer->denormalize($resultData, Place::class, $format, $context));
        }

        return $term;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return PlaceSearchResponse::class === $type;
    }
}