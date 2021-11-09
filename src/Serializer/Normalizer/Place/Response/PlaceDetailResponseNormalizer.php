<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Place\Response;

use Ivory\GoogleMap\Service\Place\Base\Place;
use Ivory\GoogleMap\Service\Place\Detail\Response\PlaceDetailResponse;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class PlaceDetailResponseNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): PlaceDetailResponse
    {
        $term = new PlaceDetailResponse();

        $term->setStatus($data['status']);
        $term->setResult($this->denormalizer->denormalize($data['result'], Place::class, $format, $context));

        return $term;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return PlaceDetailResponse::class === $type;
    }
}