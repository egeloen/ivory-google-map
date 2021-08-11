<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Place;

use Ivory\GoogleMap\Service\Place\Base\PlusCode;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class PlusCodeNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): PlusCode
    {
        $plusCode = new PlusCode();

        $plusCode->setCompoundCode($data['compound_code']);
        $plusCode->setGlobalCode($data['global_code']);

        return $plusCode;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return PlusCode::class === $type;
    }
}