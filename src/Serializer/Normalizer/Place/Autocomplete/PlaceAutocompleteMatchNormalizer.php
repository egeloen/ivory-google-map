<?php


namespace Ivory\GoogleMap\Serializer\Normalizer\Place\Autocomplete;


use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteMatch;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class PlaceAutocompleteMatchNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): PlaceAutocompleteMatch
    {
        $term = new PlaceAutocompleteMatch();

        $term->setLength($data['length']);
        $term->setOffset($data['offset']);

        return $term;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return PlaceAutocompleteMatch::class === $type;
    }
}