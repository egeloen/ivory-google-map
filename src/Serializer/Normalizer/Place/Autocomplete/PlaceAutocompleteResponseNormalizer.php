<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Place\Autocomplete;

use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompletePrediction;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteResponse;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class PlaceAutocompleteResponseNormalizer extends Normalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): PlaceAutocompleteResponse
    {
        $placeAutocompleteResponse = new PlaceAutocompleteResponse();

        $placeAutocompleteResponse->setStatus($data['status']);
        $predictionKey = $this->getFirstAvailableKey(['prediction', 'predictions'], $data);
        if (!is_null($predictionKey)) {
            foreach ($data[$predictionKey] as $predictionData) {
                $placeAutocompleteResponse->addPrediction($this->denormalizer->denormalize($predictionData, PlaceAutocompletePrediction::class, $format, $context));
            }
        }

        return $placeAutocompleteResponse;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return PlaceAutocompleteResponse::class === $type;
    }
}