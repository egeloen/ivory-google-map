<?php


namespace Ivory\GoogleMap\Serializer\Normalizer\Place\Autocomplete;


use Ivory\GoogleMap\Serializer\Normalizer\Normalizer;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteMatch;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompletePrediction;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteTerm;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class PlaceAutocompletePredictionNormalizer extends Normalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): PlaceAutocompletePrediction
    {
        $prediction = new PlaceAutocompletePrediction();

        $prediction->setPlaceId($data['place_id']);
        $prediction->setDescription($data['description']);

        $typeKey             = $this->getFirstAvailableKey(['type', 'types'], $data);
        $termKey             = $this->getFirstAvailableKey(['term', 'terms'], $data);
        $matchedSubStringKey = $this->getFirstAvailableKey(['matched_substring', 'matched_substrings'], $data);

        foreach ($data[$typeKey] as $type) {
            $prediction->addType($type);
        }

        foreach ($data[$termKey] as $termData) {
            $prediction->addTerm($this->denormalizer->denormalize($termData, PlaceAutocompleteTerm::class), $format, $context);
        }

        foreach ($data[$matchedSubStringKey] as $matchData) {
            $prediction->addMatch($this->denormalizer->denormalize($matchData, PlaceAutocompleteMatch::class), $format, $context);
        }

        return $prediction;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return PlaceAutocompletePrediction::class === $type;
    }
}