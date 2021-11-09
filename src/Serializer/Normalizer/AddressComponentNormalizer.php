<?php

namespace Ivory\GoogleMap\Serializer\Normalizer;

use Ivory\GoogleMap\Service\Base\AddressComponent;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class AddressComponentNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): AddressComponent
    {
        $addressComponent = new AddressComponent();

        $addressComponent->setLongName($data['long_name']);
        $addressComponent->setShortName($data['short_name']);
        $addressComponent->setTypes($data['types']);

        return $addressComponent;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return AddressComponent::class === $type;
    }
}