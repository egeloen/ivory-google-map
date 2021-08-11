<?php


namespace Ivory\GoogleMap\Serializer\Normalizer\Place\Autocomplete;


use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteTerm;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class PlaceAutocompleteTermNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): PlaceAutocompleteTerm
    {
        $term = new PlaceAutocompleteTerm();

        $term->setValue($data['value']);
        $term->setOffset($data['offset']);

        return $term;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return PlaceAutocompleteTerm::class === $type;
    }
}